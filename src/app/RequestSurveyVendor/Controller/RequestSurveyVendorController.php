<?php

namespace App\RequestSurveyVendor\Controller;

use App\Chronology\Model\Chronology;
use App\GroupKontak\Model\GroupKontak;
use App\InputHasilSoftSurvey\Model\InputHasilSoftSurvey;
use App\Minat\Model\Minat;
use App\MinatLayanan\Model\MinatLayanan;
use App\RequestSurveyVendor\Model\RequestSurveyVendor;
use App\Users\Model\Users;
use App\Vendor\Model\Vendor;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class RequestSurveyVendorController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new RequestSurveyVendor();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll("WHERE status = 1");

        $vendor = new Vendor();
        $data_vendor = $vendor->selectAll();
        // dd($data_vendor);

        return $this->render_template('admin/master/request-survey-vendor/index', ['datas' => $datas, 'data_vendor' => $data_vendor]);
    }



    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/reseller/create');
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $create = $this->model->create($request->request);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menambah Data Request Survey vendor pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create , $idUser);

        return new RedirectResponse('/reseller');
    }

    public function get(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');

        $input_survey = new InputHasilSoftSurvey;
        $data_survey = $input_survey->selectOne("WHERE id = '" . $id . "'");
        // $data_survey['biayaInstalasi'] =  number_format($data_survey['biayaInstalasi'], 0, "", ".");
        // dd($data_survey);


        $data_survey['tanggalRequest'] = date('d-m-Y', strtotime($data_survey['tanggalRequest']));
        $data_survey['tanggalHasil'] = date('d-m-Y', strtotime($data_survey['tanggalHasil']));
        // dd($data_survey);

        return new JsonResponse($data_survey);
    }

    public function getInput(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');

        $input_survey = new InputHasilSoftSurvey;
        $data_survey = $input_survey->selectAllInput("WHERE userrequestsurvey.kodeMinat = '" . $id . "'");
        // dd($data_survey);

        // dd($data_survey);


        return new JsonResponse($data_survey);
    }

    public function edit(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);

        return $this->render_template('admin/master/request-survey-vendor/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();
        $datas_attribute = $request->attributes->get('id');

        $minat = new Minat();
        $data_minat = $minat->selectOne($datas_attribute);
        // dd($data_minat);
        $data_alamat = strtolower($data_minat['alamat'] . " RT." . $data_minat['rt'] . " RW." . $data_minat['rw'] . ", Kel. " . $data_minat['nameKelurahan'] . ", Kec. " . $data_minat['nameKecamatan'] . ", Kab. " . $data_minat['nameKabupaten'] . " " . $data_minat['nameProvinsi'] . ", " . $data_minat['kodepos'] . ", Indonesia");
        $data_alamat = ucwords($data_alamat);

        $group_kontak = new GroupKontak();
        $koordinat = $data_minat['latitude'] . "," . $data_minat['longtitude'];
        $data_group_kontak = $group_kontak->selectOne("WHERE idRelation ='" . $datas_attribute . "' AND idKontak = 1");
        $data_group_kontak_email = $group_kontak->selectOne("WHERE idRelation ='" . $datas['idVendor'] . "' AND idKontak = 3");
        // dd($data_group_kontak_email);

        $minat_layanan = new MinatLayanan();
        $data_minat_layanan = $minat_layanan->selectOne("WHERE idMinat = '" . $datas_attribute . "'");

        // $idVendor = explode(",", $datas['idVendor']);
        // dd($idVendor);



        // dd($data_minat);
        $update = $this->model->update($id, $request->request);

        $tglRequest = date("d-m-Y");
        $id = $request->attributes->get('id');

        $vendor = new Vendor();
        $idVendor = $datas['idVendor'];
        $data_vendor = $vendor->selectOne($idVendor);
        // dd($data_vendor['namaVendor']);
        $data_idVendor = explode(",", $idVendor);

        $status = '2';
        $minat = new Minat();
        $minat_status = $minat->updateStatus($id, $status);

        $input_soft_survey = new InputHasilSoftSurvey();

        $jenisSurvey = '1';

        foreach ($data_idVendor as $key => $value) {
            $group_data = [
                'idVendor' => $value,
                'kodeMinat' => $id,
                'tanggalRequest' => NULL,
                'tanggalHasil' => NULL,
                'hasil' => NULL,
                'jarak' => NULL,
                'biayaInstalasi' => NULL,
                'keterangan' => NULL,
                'jenisSurvey' => $jenisSurvey,

            ];
            $input_soft_survey_create = $input_soft_survey->create($group_data);
        }

        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Request survey untuk <b>" . $data_minat['namapemohon'] . "</b> telah dikirmkan ke vendor <b>" . $data_vendor['namaVendor'] . "</b>";
        $kirim = $user->telegram($message, $ambilUser['chatId']);
        // dd($kirim);

        // $mail_body = preg_replace('/<span class="namaVendor">.+?</span>/im', $data_vendor['namaVendor'], $mail_body);

        // echo getcwd();
        // require './vendor/autoload.php';
        require './plugins/PHPMailer-master/src/PHPMailer.php';
        require './plugins/PHPMailer-master/src/SMTP.php';
        require './plugins/PHPMailer-master/src/Exception.php';
        $vendor = new Vendor();
        $mail = new PHPMailer();


        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah mengubah Data Request Survey vendor pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update , $idUser);

        return new RedirectResponse('/request-survey-vendor');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menghapus Data Request Survey vendor pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete , $idUser);

        return new RedirectResponse('/reseller');
    }
}
