<?php

namespace App\InputHasilSoftSurvey\Controller;

use App\Chronology\Model\Chronology;
use App\InputHasilSoftSurvey\Model\InputHasilSoftSurvey;
use App\Minat\Model\Minat;
use App\MinatLayanan\Model\MinatLayanan;
use App\Users\Model\Users;
use App\Vendor\Model\Vendor;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class InputHasilSoftSurveyController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new InputHasilSoftSurvey();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $minat = new Minat();
        $data_minat = $minat->selectAll("WHERE status = 2 ");
        $minat_input_hasil_survey = [];

        foreach ($data_minat as $key => $value) {
            $datas = $this->model->selectAll("WHERE userrequestsurvey.kodeMinat = '" . $value['kodeMinat'] . "'");
            if (count($datas) > 0) {
                $status = false;
                foreach ($datas as $key1 => $value1) {
                    if ($value1['hasil'] == NULL) {
                        $status = true;
                        break;
                    }
                }
                if ($status) {
                    array_push($minat_input_hasil_survey, $value);
                }
            }
        }
        // dd($minat_input_hasil_survey);


        return $this->render_template('admin/master/input-hasil-soft-survey/index', ['minat_input_hasil_survey' => $minat_input_hasil_survey]);
    }



    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/input-hasil-soft-survey/create');
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
        $deskripsi = $nama . " telah menambahkan hasil soft survey pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create, $idUser);

        return new RedirectResponse('/input-hasil-soft-survey');
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

        return $this->render_template('admin/master/input-hasil-soft-survey/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $datas = $request->request->all();
        // dd($datas);


        $nama_sales =  $_SESSION['_sf2_attributes']['namaUser'];

        $data_arr = [];
        $index_arr = [];
        foreach ($datas as $key1 => $value1) {
            $id_vendor = explode('-', $key1)[1];
            if (!in_array($id_vendor, $index_arr)) {
                array_push($index_arr, $id_vendor);
            }
        }
        foreach ($index_arr as $key1 => $value1) {
            $arr_item = [];
            $arr_item['idVendor'] = $value1;
            $arr_item['kodeMinat'] = $id;
            foreach ($datas as $key => $value) {
                $name_input = explode('-', $key)[0];
                $id_vendor = explode('-', $key)[1];
                if ($id_vendor == $value1) {
                    $arr_item[$name_input] = $datas[$name_input . '-' . $id_vendor];
                }
            }
            array_push($data_arr, $arr_item);
        }
        // dd($data_arr);

        foreach ($data_arr as $key => $value) {
            # code...

            $vendor = new Vendor();
            $data_vendor = $vendor->selectOne($value['idVendor']);
            $minat = new Minat();
            $data_minat = $minat->selectOne($id);
            // dd($data_minat);
            $minat_layanan = new MinatLayanan();
            $data_minat_layanan = $minat_layanan->selectOne("WHERE idMinat = '" . $id . "'");

            $user = new Users();
            $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
            $message = urlencode("Berikut hasil survey untuk kebutuhan tersebut. \n \nSales :\n" . $nama_sales . "\n\nPIC :\n" . $data_minat['namapemohon'] . "\n\nAlamat : \n" . $data_minat['alamat'] . " RT." . $data_minat['rt'] . " RW." . $data_minat['rw'] . " Kel." . $data_minat['nameKelurahan'] . ", Kec." .  $data_minat['nameKecamatan'] . ", Kab." .  substr(strstr($data_minat['nameKabupaten'], " "), 1)  . "\n\nPerkiraan koordinat : \n " . $data_minat['latitude'] . "," . $data_minat['longtitude']  . "\n\nLayanan : \n" . $data_minat_layanan['namaLayanan'] . " " .  $data_minat_layanan['kecepatan'] . " Mbps\n\nHasil Mapping : \n" . $value['jarak'] . "m - " . ($value['hasil'] == 1 ? "Tercover" : "Belum Tercover") . "\n\nInstalasi : \nRp." . $value['biayaInstalasi']);
            // dd($message);

            $kirim = $user->telegram($message, $ambilUser['chatId']);
            // dd($kirim);
        }


        // $datas = $request->request->all();
        // $data_arr = [];
        // $index_arr = [];
        // foreach ($datas as $key1 => $value1) {
        //     $id_vendor = explode('-', $key1)[1];
        //     if (!in_array($id_vendor, $index_arr)) {
        //         array_push($index_arr, $id_vendor);
        //     }
        // }
        // foreach ($index_arr as $key1 => $value1) {
        //     $arr_item = [];
        //     $arr_item['idVendor'] = $value1;
        //     $arr_item['kodeMinat'] = $id;
        //     foreach ($datas as $key => $value) {
        //         $name_input = explode('-', $key)[0];
        //         $id_vendor = explode('-', $key)[1];
        //         if ($id_vendor == $value1) {
        //             $arr_item[$name_input] = $datas[$name_input . '-' . $id_vendor];
        //         }
        //     }
        //     array_push($data_arr, $arr_item);
        // }
        // dd($datas, $data_arr);

        foreach ($data_arr as $key => $value) {
            // dd($data_arr);
            $update = $this->model->update($value, "WHERE idVendor =  '" . $value['idVendor'] . "' AND kodeMinat = '" . $id . "'");
        }


        $status = '3';
        $minat = new Minat();
        $minat_status = $minat->updateStatus($id, $status);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menambahkan data hasil Survey Onsite pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update, $idUser);


        return new RedirectResponse('/input-hasil-soft-survey');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        return new RedirectResponse('/input-hasil-soft-survey');
    }
}
