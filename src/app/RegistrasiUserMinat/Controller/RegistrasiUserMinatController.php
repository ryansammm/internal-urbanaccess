<?php

namespace App\RegistrasiUserMinat\Controller;

use App\Chronology\Model\Chronology;
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
use App\Invoice\Model\Invoice;
use App\Kabupaten\Model\Kabupaten;
use App\Kecamatan\Model\Kecamatan;
use App\Kelurahan\Model\Kelurahan;
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
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $minat = new Minat();
        $data_minat = $minat->selectAll("WHERE status = 6");
        // dd($data_minat);



        foreach ($data_minat as $key => $value) {
            if ($value['namaLayanan'] == 'UrbanLite') {
                $data_minat[$key]['link'] = '/urban-lite/';
            } elseif ($value['namaLayanan'] == 'UrbanMax') {
                $data_minat[$key]['link'] = '/urban-max/';
            } elseif ($value['namaLayanan'] == 'UrbanUltimate') {
                $data_minat[$key]['link'] = '/urban-ultimate/';
            }
        }

        // dd($data_minat);

        return $this->render_template('admin/master/registrasi-user-minat/index', ['data_minat' => $data_minat]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $minat = new Minat();
        $data_minat = $minat->selectOne($id);
        // dd($data_minat);

        $kode_form = uniqid();

        $minat_layanan = new MinatLayanan();
        $data_minat_layanan = $minat_layanan->selectOne("WHERE idMinat = '" . $id . "'");
        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();
        // dd($data_minat_layanan);

        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();
        $kabupaten = new Kabupaten();
        $data_kabupaten = $kabupaten->selectAll("WHERE idProvinsi = '" . $data_minat['idProvinsi'] . "'");
        $kecamatan = new Kecamatan();
        $data_kecamatan = $kecamatan->selectAll("WHERE idKabupaten = '" . $data_minat['idKabupaten'] . "'");
        $kelurahan = new Kelurahan();
        $data_kelurahan = $kelurahan->selectAll("WHERE idKecamatan = '" . $data_minat['idKecamatan'] . "'");
        // dd($data_kelurahan);

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


        return $this->render_template('admin/master/registrasi-user-minat/create', ['provinsi' => $data_provinsi, 'data_sales' => $data_sales, 'layanan' => $layanan, 'layanan_detail' => $layanan_detail, 'data_minat' => $data_minat, 'data_minat_layanan' => $data_minat_layanan, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_user_requset_survey' => $data_user_requset_survey, 'data_vendor' => $data_vendor, 'kode_form' => $kode_form, 'data_kabupaten' => $data_kabupaten, 'data_kecamatan' => $data_kecamatan, 'data_kelurahan' => $data_kelurahan]);
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();


        /* ---------------------------- Nomor Registrasi ---------------------------- */
        $noRegistrasi = $this->noRegistrasi($datas);
        $datas['noRegistrasi'] = $noRegistrasi;
        /* -------------------------------------------------------------------------- */


        $datas['statusRegistrasi'] = '4';


        /* ---------------------------- Registrasi Create --------------------------- */
        $internet_user_registrasi_create = $this->model->create($datas);


        /* ---------------------------- Layanan Internet ---------------------------- */
        $layananInternet = new LayananInternet;
        $dataLayananInternet = $layananInternet->selectOne("WHERE idLayananinternet = '" . $datas['idLayanan'] . "'");
        $layananInternetDetail = new LayananInternetDetail;
        $dataLayananInternetDetail = $layananInternetDetail->selectOne("WHERE idLayananinternetdetail = '" . $datas['idLayanandetail'] . "'");

        $internet_user_layanan = new InternetUserLayanan();

        $data_internet_layanan = [
            'biayaregistrasiLayanan' => $dataLayananInternet['biayaregistrasi'],
            'biayabulananLayanan' => $dataLayananInternetDetail['biayabulanan'],
            'biayadasarregistrasiLayanan' => $dataLayananInternet['biayadasarregistrasiLayanan'],
            'biayadasarbulananLayanan' => $dataLayananInternetDetail['biayadasarbulanan'],
            'ppnbiayaregistrasi' => $dataLayananInternet['ppn'],
            'ppnbiayabulanan' => $dataLayananInternetDetail['ppn'],
        ];
        $internetUserLayananCreate = $internet_user_layanan->create($noRegistrasi, $data_internet_layanan, $datas);
        /* -------------------------------- Fee Sales ------------------------------- */
        $fee_sales = new FeeSales();
        $fee_sales_create = $fee_sales->create($noRegistrasi, $datas);


        /* ------------------------------- Kontak User ------------------------------ */
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        $group_kontak = new GroupKontak();

        // Telepon
        $data_group_kontak_telp = [
            'idRelation' => $noRegistrasi,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp);

        // Whatsapp
        $data_group_kontak_whatsapp = [
            'idRelation' => $noRegistrasi,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp);

        // Email
        $data_group_kontak_email = [
            'idRelation' => $noRegistrasi,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email);
        /* -------------------------------------------------------------------------- */


        /* --------------------------- Foto dan Nomor KTP --------------------------- */
        $media = new Media();
        $media->create($_FILES['fileKTP'], $noRegistrasi, '1', 'foto-ktp');

        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas_ktp = $legalitas->singkatanLegalitas("ktp")['idLegalitas'];

        $file_ktp = $_FILES['fileKTP'];
        $legalitas_ktp_create = [
            'idRelation' => $noRegistrasi,
            'idLegalitas' => $data_legalitas_ktp,
            'isiLegalitas' => $datas['nikUserRegistrasi']
        ];
        $group_persyaratan_ktp_create = $group_legalitas->create($legalitas_ktp_create);
        /* -------------------------------------------------------------------------- */


        /* --------------------------- Foto dan Nomor NPWP -------------------------- */
        $media->create($_FILES['fileNPWP'], $noRegistrasi, '1', 'foto-legalitas-user');
        $data_legalitas_npwp = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        $file_npwp = $_FILES['fileNPWP'];
        $legalitas_npwp_create = [
            'idRelation' => $noRegistrasi,
            'idLegalitas' => $data_legalitas_npwp,
            'isiLegalitas' => $datas['noNPWP']
        ];
        $group_persyaratan_ktp_create = $group_legalitas->create($legalitas_npwp_create);
        /* -------------------------------------------------------------------------- */


        /* ----------------------------- Form Registrasi ---------------------------- */
        $media->create($_FILES['fileForm'], $noRegistrasi, '1', 'file-form');
        /* -------------------------------------------------------------------------- */


        /* ---------------------------- Alamat Pemasangan --------------------------- */
        $internet_user_alamat = new InternetUserAlamat();
        $data_alamat_pemasangan = [
            'alamat' => $datas['alamatPemasangan'],
            'rt' => $datas['rtPemasangan'],
            'rw' => $datas['rwPemasangan'],
            'idProvinsi' => $datas['idProvinsiPemasangan'],
            'idKabupaten' => $datas['idKabupatenPemasangan'],
            'idKecamatan' => $datas['idKecamatanPemasangan'],
            'idKelurahan' => $datas['idKelurahanPemasangan'],
            'kodepos' => $datas['kodeposPemasangan'],
            'koordinat' => $datas['koordinatPemasangan'],
            'jenisAlamat' => 'pemasangan',
        ];
        $create_alamat_pemasangan = $internet_user_alamat->create($noRegistrasi, $data_alamat_pemasangan);
        /* -------------------------------------------------------------------------- */


        /* ---------------------------- Alamat Penagihan ---------------------------- */
        $data_alamat_penagihan = [
            'alamat' => $datas['alamatPenagihan'],
            'rt' => $datas['rtPenagihan'],
            'rw' => $datas['rwPenagihan'],
            'idProvinsi' => $datas['idProvinsiPenagihan'],
            'idKabupaten' => $datas['idKabupatenPenagihan'],
            'idKecamatan' => $datas['idKecamatanPenagihan'],
            'idKelurahan' => $datas['idKelurahanPenagihan'],
            'kodepos' => $datas['kodeposPenagihan'],
            'koordinat' => $datas['koordinatPenagihan'],
            'jenisAlamat' => 'penagihan',
        ];
        $create_alamat_penagihan = $internet_user_alamat->create($noRegistrasi, $data_alamat_penagihan);
        /* -------------------------------------------------------------------------- */


        /* --------------------------------- Invoice -------------------------------- */
        $invoice = new Invoice();
        $invoice_create = $invoice->create($noRegistrasi, $datas);
        /* -------------------------------------------------------------------------- */


        /* ---------------------------- Data PIC Keuangan --------------------------- */
        $pic_vendor = new PIC();
        $group_pic_vendor = new GroupPIC();

        $data_pic_keuangan = [
            'nikPic' =>  $datas['nikPicKeuangan'],
            'namaPic' =>  $datas['namaPicKeuangan'],
            'jenisPic' => 'keuangan',
            'statusPic' => '1'
        ];
        $pic_vendor_create = $pic_vendor->create($data_pic_keuangan);

        $group_pic_vendor_data = [
            'nikPic' => $datas['nikPicKeuangan'],
            'idRelation' => $noRegistrasi
        ];
        $group_pic_vendor_create = $group_pic_vendor->create($group_pic_vendor_data);

        $group_kontak_pic_vendor_telp = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPICKeuangan']
        ];
        $create_kontak_pic_vendor_telp_create = $group_kontak->create($group_kontak_pic_vendor_telp);

        $group_kontak_pic_vendor_wa = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPICKeuangan']
        ];
        $create_kontak_pic_vendor_wa_create = $group_kontak->create($group_kontak_pic_vendor_wa);

        $group_kontak_pic_vendor_email = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPICKeuangan']
        ];
        $create_kontak_pic_vendor_email_create = $group_kontak->create($group_kontak_pic_vendor_email);
        /* -------------------------------------------------------------------------- */


        /* ----------------------------- Data PIC Teknis ---------------------------- */
        $data_pic_teknis = [
            'nikPic' =>  $datas['nikPicTeknis'],
            'namaPic' =>  $datas['namaPicTeknis'],
            'jenisPic' => 'teknis',
            'statusPic' => '1'
        ];
        $pic_vendor_create_teknis = $pic_vendor->create($data_pic_teknis);

        $group_pic_vendor_data_teknis = [
            'nikPic' => $datas['nikPicTeknis'],
            'idRelation' => $noRegistrasi
        ];
        $group_pic_vendor_create_teknis = $group_pic_vendor->create($group_pic_vendor_data_teknis);

        $group_kontak_pic_vendor_telp_teknis = [
            'idRelation' => $pic_vendor_create_teknis,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPICTeknis']
        ];
        $create_kontak_pic_vendor_telp_create_teknis = $group_kontak->create($group_kontak_pic_vendor_telp_teknis);

        $group_kontak_pic_vendor_wa_teknis = [
            'idRelation' => $pic_vendor_create_teknis,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPICTeknis']
        ];
        $create_kontak_pic_vendor_wa_create_teknis = $group_kontak->create($group_kontak_pic_vendor_wa_teknis);

        $group_kontak_pic_vendor_email_teknis = [
            'idRelation' => $pic_vendor_create_teknis,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPICTeknis']
        ];
        $create_kontak_pic_vendor_email_create_teknis = $group_kontak->create($group_kontak_pic_vendor_email_teknis);
        /* -------------------------------------------------------------------------- */


        /* ------------------------------- Data Vendor ------------------------------ */
        $vendor = new Vendor();
        $data_vendor = $vendor->selectOne($datas['idVendor']);

        $internet_user_vendor = new InternetUserVendor();
        $datas['namaVendor'] = $data_vendor['namaVendor'];
        $internet_user_vendor_create = $internet_user_vendor->create($noRegistrasi, $datas);
        /* -------------------------------------------------------------------------- */


        /* -------------------------- Interner User Layanan ------------------------- */
        $layananInternet = new LayananInternet;
        $dataLayananInternet = $layananInternet->selectOne("WHERE idLayananinternet = '" . $datas . "'");
        $layananInternetDetail = new LayananInternetDetail;
        $dataLayananInternetDetail = $layananInternetDetail->selectOne("WHERE idLayananinternetdetai '" . $datas . "'");
        /* -------------------------------------------------------------------------- */


        /* -------------------------------- Telegram -------------------------------- */
        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Data registrasi atas nama <br>" . $datas['namauserRegistrasi'] . "</br> telah dilengkapi";
        $kirim = $user->telegram($message, $ambilUser['chatId']);
        /* -------------------------------------------------------------------------- */


        /* ------------------------------ Update Status ----------------------------- */
        $kodeMinat = $request->attributes->get('id');
        $status = '7';
        $minat = new Minat();
        $minat_status = $minat->updateStatus($kodeMinat, $status);
        /* -------------------------------------------------------------------------- */


        /* -------------------------------- Kronologi ------------------------------- */
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah melengkapi Data Registrasi User minat pada menu Registrasi User atas nama <b>" . $datas['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $internet_user_registrasi_create, $idUser);
        /* -------------------------------------------------------------------------- */


        return new RedirectResponse('/registrasi-user-minat');
    }



    public function edit(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
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
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $idBank = $request->attributes->get('id');
        $namaBank = $request->request->get('namaBank');

        $update = $this->model->update($idBank, $namaBank);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah mengubah Data Registrasi User minat pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update, $idUser);

        return new RedirectResponse('/registrasi');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $idBank = $request->attributes->get('id');

        $delete = $this->model->delete($idBank);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menghapus Data Registrasi User minat pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete, $idUser);

        return new RedirectResponse('/registrasi');
    }
}
