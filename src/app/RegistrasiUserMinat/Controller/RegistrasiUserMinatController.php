<?php

namespace App\RegistrasiUserMinat\Controller;

use App\Client\Model\Client;
use App\FeeSales\Model\FeeSales;
use App\GroupKontak\Model\GroupKontak;
use App\GroupLayanan\Model\GroupLayanan;
use App\GroupLegalitas\Model\GroupLegalitas;
use App\GroupPersyaratan\Model\GroupPersyaratan;
use App\GroupPIC\Model\GroupPIC;
use App\InternetUserAlamat\Model\InternetUserAlamat;
use App\InternetUserLayanan\Model\InternetUserLayanan;
use App\InternetUserVendor\Model\InternetUserVendor;
use App\Kontak\Model\Kontak;
use App\RegistrasiUser\Model\InternetUserRegistrasi;
use App\LayananInternet\Model\LayananInternet;
use App\LayananInternetDetail\Model\LayananInternetDetail;
use App\Legalitas\Model\Legalitas;
use App\Media\Model\Media;
use App\Minat\Model\Minat;
use App\MinatLayanan\Model\MinatLayanan;
use App\People\Model\People;
use App\PIC\Model\PIC;
use App\Provinsi\Model\Provinsi;
use App\RegistrasiUserMinat\Model\InternetUserRegistrasiMinat;
use App\Reseller\Model\Reseller;
use App\Sales\Model\Sales;
use App\SalesPerorangan\Model\SalesPerorangan;
use App\UserRequestSurvey\Model\UserRequestSurvey;
use App\Users\Model\Users;
use App\Vendor\Model\Vendor;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class RegistrasiUserMinatController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new InternetUserRegistrasiMinat();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $minat = new Minat();
        $data_minat = $minat->selectAll("WHERE status = 6");
        // dd($data_minat);



        return $this->render_template('admin/master/registrasi-user-minat/index', ['data_minat' => $data_minat]);
    }

    public function create(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $minat = new Minat();
        $data_minat = $minat->selectOne($id);

        $kode_form = uniqid();

        $minat_layanan = new MinatLayanan();
        $data_minat_layanan = $minat_layanan->selectOne("WHERE idMinat = '" . $id . "'");
        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();
        // dd($layanan);

        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $reseller = new Reseller();
        $nama_reseller = $reseller->selectAll();
        $sales_perorangan = new SalesPerorangan();
        $nama_sales_perorangan = $sales_perorangan->selectAll();

        $data_sales = array_merge($nama_reseller, $nama_sales_perorangan);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $data_minat['kodeMinat'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $data_minat['kodeMinat'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $data_minat['kodeMinat'] . "' AND idKontak = '" . $id_jenis_email . "'");

        $user_request_survey = new UserRequestSurvey();
        $data_user_requset_survey = $user_request_survey->selectAll("WHERE userrequestsurvey.kodeMinat = '" . $data_minat['kodeMinat'] . "' AND userrequestsurvey.status = 1");

        $vendor = new Vendor();
        $data_vendor = $vendor->selectAll();

        // dd($data_user_requset_survey);


        return $this->render_template('admin/master/registrasi-user-minat/create', ['provinsi' => $data_provinsi, 'data_sales' => $data_sales, 'layanan' => $layanan, 'layanan_detail' => $layanan_detail, 'data_minat' => $data_minat, 'data_minat_layanan' => $data_minat_layanan, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_user_requset_survey' => $data_user_requset_survey, 'data_vendor' => $data_vendor, 'kode_form' => $kode_form]);
    }

    public function store(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();

        $noRegistrasi = $this->noRegistrasi($datas);

        $datas['noRegistrasi'] = $noRegistrasi;
        // dd($datas, $noRegistrasi);

        // dd($datas, $noRegistrasi);


        $fee_sales = new FeeSales();
        $fee_sales_create = $fee_sales->create($datas);


        $internet_user_registrasi_create = $this->model->create($datas);

        $internet_user_alamat = new InternetUserAlamat();
        $internet_user_alamat_create = $internet_user_alamat->create($noRegistrasi, $datas);

        $internet_user_layanan = new InternetUserLayanan();
        $internet_user_layanan_create = $internet_user_layanan->create($noRegistrasi, $datas);

        $vendor = new Vendor();
        $data_vendor = $vendor->selectOne($datas['idVendor']);

        $internet_user_vendor = new InternetUserVendor();
        $datas['namaVendor'] = $data_vendor['namaVendor'];
        $internet_user_vendor_create = $internet_user_vendor->create($noRegistrasi, $datas);


        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        $group_kontak = new GroupKontak();

        // create kontak minat telepon
        $data_group_kontak_telp = [
            'idRelation' => $noRegistrasi,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp);

        // create kontak minat whatsapp
        $data_group_kontak_whatsapp = [
            'idRelation' => $noRegistrasi,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp);

        // create kontak minat email
        $data_group_kontak_email = [
            'idRelation' => $noRegistrasi,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email);

        // create pic internal
        $pic_vendor = new PIC();
        $datas['statusPic'] = '1';
        $pic_vendor_create = $pic_vendor->create($datas);

        // create group pic vendor
        $group_pic_vendor = new GroupPIC();
        $group_pic_vendor_data = [
            'nikPic' => $datas['nikPic'],
            'idRelation' => $noRegistrasi
        ];
        $group_pic_vendor_create = $group_pic_vendor->create($group_pic_vendor_data);

        // kontak telepon pic vendor
        $group_kontak_pic_vendor_telp = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPIC']
        ];
        $create_kontak_pic_vendor_telp_create = $group_kontak->create($group_kontak_pic_vendor_telp);

        // kontak telepon pic vendor
        $group_kontak_pic_vendor_wa = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPIC']
        ];
        $create_kontak_pic_vendor_wa_create = $group_kontak->create($group_kontak_pic_vendor_wa);

        // kontak email pic vendor
        $group_kontak_pic_vendor_email = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPIC']
        ];
        $create_kontak_pic_vendor_email_create = $group_kontak->create($group_kontak_pic_vendor_email);

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        $file_npwp_vendor = $_FILES['fileNPWP'];
        $legalitas_vendor_create = [
            'idRelation' => $noRegistrasi,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWP']
        ];
        $group_persyaratan_vendor_npwp_create = $group_legalitas->create($legalitas_vendor_create);

        $media = new Media();
        $media->create($_FILES['fileKTP'], $noRegistrasi, '1', 'foto-ktp');

        $user = new Users();
        $ambilUser = $user->selectOneUser($this->session->get('idUser'));
        $message = "Data registrasi atas nama <br>" . $datas['namauserRegistrasi'] . "</br> telah dilengkapi";
        $kirim = $user->telegram($message, $ambilUser['chatId']);


        $kodeMinat = $request->attributes->get('id');

        $status = '7';
        $minat = new Minat();
        $minat_status = $minat->updateStatus($kodeMinat, $status);


        return new RedirectResponse('/registrasi-user-minat');
    }



    public function edit(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $idBank = $request->attributes->get('id');

        $detail = $this->model->selectOne($idBank);
        // var_dump($detail);
        // die();

        return $this->render_template('admin/master/registrasi/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $idBank = $request->attributes->get('id');
        $namaBank = $request->request->get('namaBank');

        $update = $this->model->update($idBank, $namaBank);

        return new RedirectResponse('/registrasi');
    }

    public function delete(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $idBank = $request->attributes->get('id');

        $delete = $this->model->delete($idBank);

        return new RedirectResponse('/registrasi');
    }
}
