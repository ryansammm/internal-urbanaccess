<?php

namespace App\AturTanggalOnsite\Controller;

use App\Chronology\Model\Chronology;
use App\AturTanggalOnsite\Model\AturTanggalOnsite;
use App\InputHasilSoftSurvey\Model\InputHasilSoftSurvey;
use App\Minat\Model\Minat;
use App\Users\Model\Users;
use App\Vendor\Model\Vendor;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AturTanggalOnsiteController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new AturTanggalOnsite();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll("WHERE minat.status = 4 AND userrequestsurvey.status = 1");
        // dd($datas);

        $vendor = new Vendor();
        $data_vendor = $vendor->selectAll();

        return $this->render_template('admin/master/atur-tanggal-onsite/index', ['datas' => $datas, 'data_vendor' => $data_vendor]);
    }



    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/atur-tanggal-onsite/create');
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
        $deskripsi = $nama . " telah menambah atur tanggal onsite pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create, $idUser);

        return new RedirectResponse('/atur-tanggal-onsite');
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

        return $this->render_template('admin/master/atur-tanggal-onsite/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $minat = new Minat();

        $id = $request->attributes->get('id');
        $datas = $request->request->all();

        $detail = $this->model->selectOne("WHERE id = '" . $id . "'");
        $data_minat = $minat->selectOne($detail['kodeMinat']);


        // dd($message, $datas['tanggalRequest']);
        // dd($datas);

        $jenisSurvey = '2';


        $input_soft_survey = new InputHasilSoftSurvey();
        $group_data = [
            'idVendor' => $detail['idVendor'],
            'kodeMinat' => $detail['kodeMinat'],
            'tanggalRequest' => $datas['tanggalRequest'],
            'tanggalHasil' => NULL,
            'hasil' => NULL,
            'jarak' => NULL,
            'biayaInstalasi' => NULL,
            'keterangan' => NULL,
            'jenisSurvey' => $jenisSurvey,
            'status' => NULL,

        ];

        $input_soft_survey_create = $input_soft_survey->create($group_data);
        // dd($input_soft_survey_create);

        $status = '5';
        $minat = new Minat();
        $minat_status = $minat->updateStatus($detail['kodeMinat'], $status);

        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Jadwal survey on site atas nama <b>" . $data_minat['namapemohon'] . "</b> telah dijadwalkan pada tanggal <b>" . date('d F Y', strtotime($datas['tanggalRequest'])) . "</b>";
        $kirim = $user->telegram($message, $ambilUser['chatId']);

        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>".$nama . "</b> telah melakukan setting Tanggal Survey Onsite pada menu Survey On Site atas nama <b>".$data_minat['namapemohon']."</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $input_soft_survey_create, $idUser);
        return new RedirectResponse('/atur-tanggal-onsite');
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
        $deskripsi = $nama . " telah menghapus tanggal onsite pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete, $idUser);


        return new RedirectResponse('/atur-tanggal-onsite');
    }
}
