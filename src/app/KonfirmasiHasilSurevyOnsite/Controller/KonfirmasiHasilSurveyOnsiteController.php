<?php

namespace App\KonfirmasiHasilSurevyOnsite\Controller;

use App\Chronology\Model\Chronology;
use App\InputHasilSurveyOnsite\Model\InputHasilSurveyOnsite;
use App\InternetUserLayanan\Model\InternetUserLayanan;
use App\KonfirmasiHasilSurveyOnsite\Model\KonfirmasiHasilSurveyOnsite;
use App\LayananInternet\Model\LayananInternet;
use App\LayananInternetDetail\Model\LayananInternetDetail;
use App\Media\Model\Media;
use App\Minat\Model\Minat;
use App\MinatLayanan\Model\MinatLayanan;
use App\Users\Model\Users;
use App\Vendor\Model\Vendor;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class KonfirmasiHasilSurveyOnsiteController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new KonfirmasiHasilSurveyOnsite();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll("WHERE jenisSurvey = 2 AND tanggalHasil = 0000-00-00");
        // dd($datas);


        $vendor = new Vendor();
        $data_vendor = $vendor->selectAll();

        $layanan_internet_detail = new LayananInternetDetail();
        $data_layanan_internet_detail = $layanan_internet_detail->selectAll();
        // dd($data_layanan_internet_detail);

        return $this->render_template('admin/master/konfirmasi-hasil-survey-onsite/index', ['datas' => $datas, 'data_vendor' => $data_vendor, 'data_layanan_internet_detail' => $data_layanan_internet_detail]);
    }



    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/input-hasil-survey-onsite/create');
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $create = $this->model->create($request->request);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menambah input hasil survey onsite pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create, $idUser);

        return new RedirectResponse('/input-hasil-survey-onsite/dokumentasi/{id}');
    }

    public function get(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $data = $this->model->selectOne($id);

        return new JsonResponse($data);
    }

    public function edit(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);

        return $this->render_template('admin/master/input-hasil-survey-onsite/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $datas = $request->request->all();
        $detail = $this->model->selectOne("WHERE jenisSurvey = 2 AND id = '" . $id . "'");

        // dd($detail);

        $minat = new Minat();
        $data_minat = $minat->selectOne($detail['kodeMinat']);

        $minat_layanan = new MinatLayanan();
        $data_minat_layanan = $minat_layanan->selectOne("WHERE idMinat = '" . $detail['kodeMinat'] . "'");

        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));

        $nama_sales =  $_SESSION['_sf2_attributes']['namaUser'];

        $group_data = [
            'tanggalHasil' =>  $datas['tanggalHasil'],
            'jarak' => $datas['jarak'],
            'keterangan' => $datas['keterangan'],
        ];
        $input_survey_onsite_update = $this->model->update($id, $group_data);

        $status = '6';
        $minat = new Minat();
        $minat_status = $minat->updateStatus($detail['kodeMinat'], $status);


        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));

        $message = urlencode("Berikut hasil survey on site. \n \nTanggal Hasil : \n" . date('d F Y', strtotime($datas['tanggalHasil'])) . "\n\nSales :\n" . $nama_sales . "\n\nPIC :\n" . $data_minat['namapemohon'] . "\n\nAlamat : \n" . $data_minat['alamat'] . " RT." . $data_minat['rt'] . " RW." . $data_minat['rw'] . " Kel." . $data_minat['nameKelurahan'] . ", Kec." .  $data_minat['nameKecamatan'] . ", Kab." .  substr(strstr($data_minat['nameKabupaten'], " "), 1)  . "\n\nPerkiraan koordinat : \n " . $data_minat['latitude'] . "," . $data_minat['longtitude']  . "\n\nLayanan : \n" . $data_minat_layanan['namaLayanan'] . " " .  $data_minat_layanan['kecepatan'] . " Mbps\n  \nJarak : \n" . $datas['jarak']) . "m";

        $kirim = $user->telegram($message, $ambilUser['chatId']);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah memperbaharui input hasil survey onsite pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $input_survey_onsite_update, $idUser);

        return new RedirectResponse('/input-hasil-survey-onsite/dokumentasi/' . $id);
    }

    public function dokumentasi(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);

        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();

        $internet_user_layanan = new InternetUserLayanan();
        $data_internet_user_layanan = $internet_user_layanan->selectOne($id);

        return $this->render_template('admin/master/input-hasil-survey-onsite/dokumentasi', ['id' => $id, 'layanan' => $layanan, 'data_internet_user_layanan' => $data_internet_user_layanan, 'layanan_detail' => $layanan_detail]);
    }

    public function dokumentasiStore(Request $request)
    {
        // if ($request->getSession()->get('username') == null) {
        //     return new RedirectResponse("/admin");
        // }
        $datas = $request->request->all();
        // dd($_FILES);
        $id = $request->attributes->get('id');
        // dd($id);

        $media = new Media();
        $media->create($_FILES['file'], $id, '1', 'dokumentasi-onsite');


        return new JsonResponse([]);
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menambah Data Minat pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete, $idUser);

        return new RedirectResponse('/input-hasil-survey-onsite');
    }
}
