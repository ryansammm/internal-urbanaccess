<?php

namespace App\RegistrasiUser\Controller;

use App\Chronology\Model\Chronology;
use App\Aktif\Model\Aktif;
use App\Aktivasi\Model\Aktivasi;
use App\Client\Model\Client;
use App\FeeSales\Model\FeeSales;
use App\GroupKontak\Model\GroupKontak;
use App\GroupLayanan\Model\GroupLayanan;
use App\GroupLegalitas\Model\GroupLegalitas;
use App\GroupPersyaratan\Model\GroupPersyaratan;
use App\GroupPIC\Model\GroupPIC;
use App\Instalasi\Model\Instalasi;
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


class RegistrasiUserController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new InternetUserRegistrasi();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll("WHERE statusRegistrasi = 4 AND internetuseralamat.jenisAlamat = 'pemasangan'");
        // dd($datas);




        foreach ($datas as $key => $value) {
            if ($value['statusRegistrasi'] == '1') {
                $datas[$key]['tercoverText'] = 'Registrasi';
            } else if ($value['statusRegistrasi'] == '2') {
                $datas[$key]['tercoverText'] = 'Instalasi';
            } else if ($value['statusRegistrasi'] == '3') {
                $datas[$key]['tercoverText'] = 'Aktivasi';
            } else if ($value['statusRegistrasi'] == '4') {
                $datas[$key]['tercoverText'] = 'Aktif';
            }
        }


        // $status_registrasi = '';
        // foreach ($datas as $key => $value) {
        //     if ($datas['statusRegistrasi'] == '1') {
        //         $status_registrasi = 'Registrasi';
        //     } elseif ($datas['statusRegistrasi'] == '2') {
        //         $status_registrasi = 'Instalasi';
        //     } elseif ($datas['statusRegistrasi'] == '3') {
        //         $status_registrasi = 'Aktivasi';
        //     } elseif ($datas['statusRegistrasi'] == '4') {
        //         $status_registrasi = 'Aktif';
        //     }
        // }

        return $this->render_template('admin/master/registrasi/index', ['datas' => $datas]);
    }


    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');

        $minat = new Minat();
        $data_minat = $minat->selectAll($id);
        // dd($data_minat);

        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();
        // dd($layanan_detail[1]['idLayananinternetdetail']);

        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $reseller = new Reseller();
        $nama_reseller = $reseller->selectAll();
        $sales_perorangan = new SalesPerorangan();
        $nama_sales_perorangan = $sales_perorangan->selectAll();

        $data_sales = array_merge($nama_reseller, $nama_sales_perorangan);

        $vendor = new Vendor();
        $data_vendor = $vendor->selectAll();

        $kode_form = uniqid();
        $user_id = uniqid();

        // dd($data_user_requset_survey);

        return $this->render_template('admin/master/registrasi/create', ['provinsi' => $data_provinsi, 'data_sales' => $data_sales, 'layanan' => $layanan, 'layanan_detail' => $layanan_detail, 'data_vendor' => $data_vendor, 'data_minat' => $data_minat, 'kode_form' => $kode_form, 'user_id' => $user_id]);
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();

        // dd($datas);


        $noRegistrasi = $datas['noRegistrasi'];

        $datas['statusRegistrasi'] = '4';

        /* ---------------------------- Registrasi Create --------------------------- */
        $internet_user_registrasi_create = $this->model->create($datas);


        /* -------------------------- Internet User Layanan ------------------------- */
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
        /* -------------------------------------------------------------------------- */


        /* -------------------------------- Fee Sales ------------------------------- */
        $fee_sales = new FeeSales();
        $fee_sales_create = $fee_sales->create($noRegistrasi, $datas);

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


        /* ----------------------------- Data Instalasi ----------------------------- */
        $instalasi = new Instalasi();
        $instalasi_create = $instalasi->create($datas, $noRegistrasi);
        /* -------------------------------------------------------------------------- */


        /* ------------------------------ Data Aktivasi ----------------------------- */
        $aktivasi = new Aktivasi();
        $aktivasi_create = $aktivasi->create($datas, $noRegistrasi);
        /* -------------------------------------------------------------------------- */


        /* ------------------------------ Data Billing ------------------------------ */
        $aktif = new Aktif();
        $aktif_create = $aktif->create($datas, $noRegistrasi);
        /* -------------------------------------------------------------------------- */


        /* ------------------------------ Bot Telegram ------------------------------ */
        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Data user atas nama " . $datas['namauserRegistrasi'] . " dengan nomor registrasi " . $datas['noRegistrasi'] . " berhasil ditambahkan";
        $kirim = $user->telegram($message, $ambilUser['chatId']);
        /* -------------------------------------------------------------------------- */


        /* ------------------------------- Chronology ------------------------------- */
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menambah data Registrasi User atas nama <b>" . $datas['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $internet_user_registrasi_create, $idUser);
        /* -------------------------------------------------------------------------- */

        return new RedirectResponse('/registrasi-user/dokumentasi-instalasi/' . $noRegistrasi);
    }


    public function edit(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        // dd($detail);

        $internet_user_layanan = new InternetUserLayanan();
        $data_internet_user_layanan = $internet_user_layanan->selectOne($id);
        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();
        // dd($data_internet_user_layanan);

        $feesales = new FeeSales();
        $data_feesales = $feesales->selectOne("WHERE idUser = '" . $id . "'");

        // Alamat
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $alamat_user = new InternetUserAlamat();
        $alamat_pemasangan = $alamat_user->selectOne("WHERE noregistrasi = '" . $id . "' AND jenisAlamat = 'pemasangan'");
        $alamat_penagihan = $alamat_user->selectOne("WHERE noregistrasi = '" . $id . "' AND jenisAlamat = 'penagihan'");

        $provinsi = new Provinsi();
        $kabupaten = new Kabupaten();
        $kecamatan = new Kecamatan();
        $kelurahan = new Kelurahan();

        // Alamat Pemasangan
        $data_provinsi_pemasangan = $provinsi->selectAll();
        $data_kabupaten_pemasangan = $kabupaten->selectAll("WHERE idProvinsi = '" . $alamat_pemasangan['idProvinsi'] . "'");
        $data_kecamatan_pemasangan = $kecamatan->selectAll("WHERE idKabupaten = '" . $alamat_pemasangan['idKabupaten'] . "'");
        $data_kelurahan_pemasangan = $kelurahan->selectAll("WHERE idKecamatan = '" . $alamat_pemasangan['idKecamatan'] . "'");

        // Alamat Penagihan
        $data_provinsi_penagihan = $provinsi->selectAll();
        $data_kabupaten_penagihan = $kabupaten->selectAll("WHERE idProvinsi = '" . $alamat_penagihan['idProvinsi'] . "'");
        $data_kecamatan_penagihan = $kecamatan->selectAll("WHERE idKabupaten = '" . $alamat_penagihan['idKabupaten'] . "'");
        $data_kelurahan_penagihan = $kelurahan->selectAll("WHERE idKecamatan = '" . $alamat_penagihan['idKecamatan'] . "'");
        // dd($alamat_penagihan, $data_kabupaten_penagihan);

        $invoice = new Invoice();
        $data_invoice = $invoice->selectOne("WHERE noRegistrasi = '" . $id . "'");
        // dd($data_invoice);

        $reseller = new Reseller();
        $nama_reseller = $reseller->selectAll();
        $sales_perorangan = new SalesPerorangan();
        $nama_sales_perorangan = $sales_perorangan->selectAll();

        $data_sales = array_merge($nama_reseller, $nama_sales_perorangan);

        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        $pic = new PIC();
        $group_pic = new GroupPIC();
        $data_group_pic_keuangan = $group_pic->selectOneJoin("WHERE idRelation = '" . $id . "' AND jenisPic = 'keuangan'");
        $data_group_pic_teknis = $group_pic->selectOneJoin("WHERE idRelation = '" . $id . "' AND jenisPic = 'teknis'");
        // dd($data_group_pic_teknis);

        // Group Kontak Vendor
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $detail['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_email . "'");


        // Group Kontak PIC Keuangan
        $data_kontak_telp_pic_keuangan = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_keuangan['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic_keuangan = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_keuangan['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic_keuangan = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_keuangan['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_telp_pic_keuangan);

        // Group Kontak PIC Teknis
        $data_kontak_telp_pic_teknis = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_teknis['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic_teknis = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_teknis['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic_teknis = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_teknis['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");


        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        // Group Legalitas Vendor
        $data_legalitas_vendor = $group_legalitas->selectOne("WHERE idRelation  = '" .  $id . "' AND idLegalitas = '" . $data_legalitas . "'");
        // dd($data_legalitas_vendor);

        $media = new Media();

        // Media Vendor
        $npwp = $media->selectOneMedia("WHERE idRelation = '" .  $id . "'");

        $internet_user_vendor = new InternetUserVendor();
        $data_internet_user_vendor = $internet_user_vendor->selectOne($id);
        // dd($data_internet_user_vendor);

        $vendor = new Vendor();
        $data_vendor = $vendor->selectAll();

        $instalasi = new Instalasi();
        $data_instalasi = $instalasi->selectOne("WHERE noRegistrasi = '" . $id . "'");
        // dd($data_instalasi);

        $aktivasi = new Aktivasi();
        $data_aktivasi = $aktivasi->selectOne("WHERE idRelation = '" . $id . "'");
        // dd($data_aktivasi);

        $aktif = new Aktif();
        $data_aktif = $aktif->selectOne("WHERE idRelation = '" . $id . "'");
        // dd($data_aktif);


        return $this->render_template('admin/master/registrasi/edit', ['detail' => $detail, 'data_internet_user_layanan' => $data_internet_user_layanan, 'data_provinsi_pemasangan' => $data_provinsi_pemasangan, 'data_kabupaten_pemasangan' => $data_kabupaten_pemasangan, 'data_kecamatan_pemasangan' => $data_kecamatan_pemasangan, 'data_kelurahan_pemasangan' => $data_kelurahan_pemasangan, 'data_provinsi_penagihan' => $data_provinsi_penagihan, 'data_kabupaten_penagihan' => $data_kabupaten_penagihan, 'data_kecamatan_penagihan' => $data_kecamatan_penagihan, 'data_kelurahan_penagihan' => $data_kelurahan_penagihan, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_kontak_telp_pic_keuangan' => $data_kontak_telp_pic_keuangan, 'data_kontak_whatsapp_pic_keuangan' => $data_kontak_whatsapp_pic_keuangan, 'data_kontak_email_pic_keuangan' => $data_kontak_email_pic_keuangan, 'data_legalitas_vendor' => $data_legalitas_vendor, 'npwp' => $npwp, 'data_internet_user_vendor' => $data_internet_user_vendor, 'layanan' => $layanan, 'layanan_detail' => $layanan_detail, 'data_sales' => $data_sales, 'data_vendor' => $data_vendor, 'data_instalasi' => $data_instalasi, 'data_aktivasi' => $data_aktivasi, 'data_aktif' => $data_aktif, 'alamat_pemasangan' => $alamat_pemasangan, 'alamat_penagihan' => $alamat_penagihan, 'data_invoice' => $data_invoice, 'data_kontak_telp_pic_teknis' => $data_kontak_telp_pic_teknis, 'data_kontak_whatsapp_pic_teknis' => $data_kontak_whatsapp_pic_teknis, 'data_kontak_email_pic_teknis' => $data_kontak_email_pic_teknis, 'data_group_pic_keuangan' => $data_group_pic_keuangan, 'data_group_pic_teknis' => $data_group_pic_teknis, 'data_feesales' => $data_feesales]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $datas = $request->request->all();

        /* ------------------------ Internet User Registrasi ------------------------ */
        $update = $this->model->update($id, $datas);
        /* -------------------------------------------------------------------------- */


        /* -------------------------- Internet User Layanan ------------------------- */
        $internet_user_layanan = new InternetUserLayanan();
        $internet_user_layanan_update = $internet_user_layanan->update($id, $datas);
        /* -------------------------------------------------------------------------- */


        /* -------------------------------- Fee Sales ------------------------------- */
        $feesales = new FeeSales();
        $feesales_update = $feesales->update($id, $datas);
        /* -------------------------------------------------------------------------- */


        /* ------------------------------- Kontak User ------------------------------ */
        $jeniskontak = new Kontak();
        $group_kontak = new GroupKontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];


        $delete_kontak = $group_kontak->delete("WHERE idRelation = '" . $id . "'");

        $data_group_kontak_telp = [
            'idRelation' => $id,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp);

        $data_group_kontak_whatsapp = [
            'idRelation' => $id,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp);

        $data_group_kontak_email = [
            'idRelation' => $id,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email);
        /* -------------------------------------------------------------------------- */



        $internet_user_alamat = new InternetUserAlamat();
        $data_alamat_pemasangan = $internet_user_alamat->selectOne("WHERE noRegistrasi = '" . $id . "' AND jenisAlamat = 'pemasangan'");
        $data_alamat_penagihan = $internet_user_alamat->selectOne("WHERE noRegistrasi = '" . $id . "' AND jenisAlamat = 'penagihan'");

        // Alamat Pemasangan
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
        $create_alamat_pemasangan = $internet_user_alamat->updateJenis("WHERE noRegistrasi = '" . $id . "' AND jenisAlamat = 'pemasangan'", $data_alamat_pemasangan);

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
        $create_alamat_penagihan = $internet_user_alamat->updateJenis("WHERE noRegistrasi = '" . $id . "' AND jenisAlamat = 'penagihan'", $data_alamat_penagihan);


        // PIC
        $pic = new PIC();
        $group_pic = new GroupPIC();
        $group_pic_keuangan = $group_pic->selectOneJoin("WHERE idRelation = '" . $id . "' AND jenisPic= 'keuangan'");
        $group_pic_teknis = $group_pic->selectOneJoin("WHERE idRelation = '" . $id . "' AND jenisPic= 'teknis'");

        // KEUANGAN
        // pic
        $pic_keuangan_delete = $pic->delete("WHERE nikPic = '" . $detail['nikPicKeuangan'] . "'");
        $data_pic_keuangan = [
            'nikPic' =>  $datas['nikPicKeuangan'],
            'namaPic' =>  $datas['namaPicKeuangan'],
            'jenisPic' => 'keuangan',
            'statusPic' => '1'
        ];
        $pic_keuangan_create = $pic->create($data_pic_keuangan);

        // groupPic
        $group_pic_keuangan_delete = $group_pic->delete("WHERE nikPic = '" . $detail['nikPicKeuangan'] . "'");
        $group_pic_keuangan_data = [
            'nikPic' => $datas['nikPicKeuangan'],
            'idRelation' => $id
        ];
        $group_pic_keuangan_create = $group_pic->create($group_pic_keuangan_data);

        //  kontak
        $delete_kontak_pic_keuangan = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPicKeuangan'] . "'");
        $data_group_kontak_telp_pic_keuangan = [
            'idRelation' => $datas['nikPicKeuangan'],
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPICKeuangan']
        ];
        $create_group_kontak_telp_keuangan = $group_kontak->create($data_group_kontak_telp_pic_keuangan);

        $data_group_kontak_whatsapp_pic_keuangan = [
            'idRelation' => $datas['nikPicKeuangan'],
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPICKeuangan']
        ];
        $create_group_kontak_whatsapp_keuangan = $group_kontak->create($data_group_kontak_whatsapp_pic_keuangan);

        $data_group_kontak_email_pic_keuangan = [
            'idRelation' => $datas['nikPicKeuangan'],
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPICKeuangan']
        ];
        $create_group_kontak_email_keuangan = $group_kontak->create($data_group_kontak_email_pic_keuangan);



        // Teknis
        $pic_teknis_delete = $pic->delete("WHERE nikPic = '" . $detail['nikPicTeknis'] . "'");
        $data_pic_teknis = [
            'nikPic' =>  $datas['nikPicTeknis'],
            'namaPic' =>  $datas['namaPicTeknis'],
            'jenisPic' => 'teknis',
            'statusPic' => '1'
        ];
        $pic_vendor_create_teknis = $pic->create($data_pic_teknis);

        $group_pic_teknis_delete = $group_pic->delete("WHERE nikPic = '" . $detail['nikPicTeknis'] . "'");
        $group_pic_teknis_data = [
            'nikPic' => $datas['nikPicTeknis'],
            'idRelation' => $id
        ];
        $group_pic_teknis_create = $group_pic->create($group_pic_teknis_data);

        //  kontak
        $delete_kontak_pic_teknis = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPicTeknis'] . "'");
        $data_group_kontak_telp_pic_teknis = [
            'idRelation' => $datas['nikPicTeknis'],
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPICTeknis']
        ];
        $create_group_kontak_telp_teknis = $group_kontak->create($data_group_kontak_telp_pic_teknis);

        $data_group_kontak_whatsapp_pic_teknis = [
            'idRelation' => $datas['nikPicTeknis'],
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPICTeknis']
        ];
        $create_group_kontak_whatsapp_teknis = $group_kontak->create($data_group_kontak_whatsapp_pic_teknis);

        $data_group_kontak_email_pic_teknis = [
            'idRelation' => $datas['nikPicTeknis'],
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPICTeknis']
        ];
        $create_group_kontak_email_teknis = $group_kontak->create($data_group_kontak_email_pic_teknis);

        $invoice = new Invoice();
        $invoice_update = $invoice->update($id, $datas, "WHERE noRegistrasi = '" . $id . "'");

        // Legalitas
        $legalitas = new Legalitas();

        // Group Legalitas
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_delete_vendor = $group_legalitas->delete("WHERE idRelation = '" . $id . "'");

        if ($_FILES['fileForm']['name'] != '') {
            $media = new Media();
            // select existing foto item
            $selectItemForm = $media->selectOneMedia("WHERE idRelation = '$id' AND jenisdokumenMedia = 'file-form'");
            // delete existing foto item
            $deleteFotoItemForm = $media->delete($selectItemForm['idMedia']);
            // dd($deleteFotoItemForm);
            // delete file foto item
            $deleteFileForm = $media->deleteFile($selectItemForm['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $media->create($_FILES['fileForm'], $update, '1', 'file-form');
        }

        // Media Vendor
        if ($_FILES['fileNPWP']['name'] != '') {
            $media = new Media();
            // select existing foto item
            $selectItem = $media->selectOneMedia("WHERE idRelation = '$id' AND jenisdokumenMedia = 'foto-legalitas-user'");
            // delete existing foto item
            $deleteFotoItem = $media->delete($selectItem['idMedia']);
            // delete file foto item
            $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $media->create($_FILES['fileNPWP'], $update, '1', 'foto-legalitas-user');
        }

        if ($_FILES['fileKTP']['name'] != '') {
            $media = new Media();
            // select existing foto item
            $selectItemKtp = $media->selectOneMedia("WHERE idRelation = '$id' AND jenisdokumenMedia = 'foto-ktp'");
            // delete existing foto item
            $deleteFotoItemKtp = $media->delete($selectItemKtp['idMedia']);
            // delete file foto item
            $deleteFileFotoItamKtp = $media->deleteFile($selectItemKtp['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $media->create($_FILES['fileKTP'], $update, '1', 'foto-ktp');
        }



        $legalitas_vendor_create = [
            'idRelation' => $id,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWP']
        ];
        $group_persyaratan_vendor_npwp_create = $group_legalitas->create($legalitas_vendor_create);

        $instalasi = new Instalasi();
        $instasi_update = $instalasi->update($datas, $id);

        $aktivasi = new Aktivasi();
        $aktivasi_update = $aktivasi->update($id, $datas);

        $aktif = new Aktif();
        $aktif_update = $aktif->update($id, $datas);

        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah memperbaharui data pada menu Data Registrasi User atas nama <b>" . $datas['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $internet_user_layanan_update, $idUser);


        return new RedirectResponse('/registrasi-user');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);
        $detail = $this->model->selectOne($id);
        // dd($detail);

        $delete = $this->model->delete($id);

        $feesales = new FeeSales();
        $feesales_delete = $feesales->delete($id);

        $invoice = new Invoice();
        $invoice_delete = $invoice->delete("WHERE noRegistrasi = '" . $id . "'");

        $internet_user_layanan = new InternetUserLayanan();
        $internet_user_layanan_delete = $internet_user_layanan->delete($id);

        $internet_user_alamat = new InternetUserAlamat();
        $internet_user_alamat_delete = $internet_user_alamat->delete($id);

        $internet_user_vendor = new InternetUserVendor();
        $internet_user_vendor_delete = $internet_user_vendor->delete($id);

        $group_kontak = new GroupKontak();
        $group_kontak_delete = $group_kontak->delete("WHERE idRelation = '" . $id . "'");
        $group_kontak_delete_pic = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        $media = new Media();
        $selectItem = $media->selectOneMedia("WHERE idRelation = '" . $id . "'");
        $deleteFotoItem = $media->delete($selectItem['idMedia']);
        $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

        $group_legalitas = new GroupLegalitas();
        $group_legalitas_delete = $group_legalitas->delete("WHERE idRelation = '" . $id . "'");

        $pic = new PIC();
        $pic_delete = $pic->delete("WHERE nikPic = '" . $detail['nikPic'] . "'");

        $group_pic = new GroupPIC();
        $group_pic_delete = $group_pic->delete("WHERE idRelation = '" . $id . "'");

        $instalasi = new Instalasi();
        $instalasi_delete = $instalasi->delete($id);

        $aktivasi = new Aktivasi();
        $aktivasi_delete = $aktivasi->delete($id);

        $aktif = new Aktif();
        $aktif_delete = $aktif->delete($id);

        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah menghapus data pada Menu Data Registrasi User atas nama <b>" . $detail['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $id, $idUser);


        return new RedirectResponse('/registrasi-user');
    }

    public function detail(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);
        // dd($datas);

        $internet_user_layanan = new InternetUserLayanan();
        $data_internet_user_layanan = $internet_user_layanan->selectOneWhere("WHERE idInternetuserregistrasi = '" . $id . "'");
        // dd($data_internet_user_layanan);

        $feesales = new FeeSales();
        $data_feesales = $feesales->selectOne("WHERE idUser = '" . $id . "'");
        // dd($data_feesales);

        $provinsi = new Provinsi();
        $alamat_user = new InternetUserAlamat();
        $alamat_pemasangan = $alamat_user->selectOne("WHERE noregistrasi = '" . $id . "' AND jenisAlamat = 'pemasangan'");
        $alamat_penagihan = $alamat_user->selectOne("WHERE noregistrasi = '" . $id . "' AND jenisAlamat = 'penagihan'");
        // dd($alamat_pemasangan);

        $invoice = new Invoice();
        $data_invoice = $invoice->selectOne("WHERE noRegistrasi = '" . $id . "'");

        if ($data_invoice['pengirimaninvoice'] == '1') {
            $data_invoice['statusText'] = 'Softcopy';
        } else if ($data_invoice['pengirimaninvoice'] == '2') {
            $data_invoice['statusText'] = 'Hardcopy';
        } else if ($data_invoice['pengirimaninvoice'] == '3') {
            $data_invoice['statusText'] = 'Softcopy & Hardcopy';
        }
        // dd($data_invoice);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        $pic = new PIC();
        $group_pic = new GroupPIC();
        $data_group_pic_keuangan = $group_pic->selectOneJoin("WHERE idRelation = '" . $id . "' AND jenisPic = 'keuangan'");
        $data_group_pic_teknis = $group_pic->selectOneJoin("WHERE idRelation = '" . $id . "' AND jenisPic = 'teknis'");
        // dd($data_group_pic_keuangan);

        // Group Kontak Vendor
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $datas['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_telp);

        // Group Kontak PIC Keuangan
        $data_kontak_telp_pic_keuangan = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_keuangan['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic_keuangan = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_keuangan['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic_keuangan = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_keuangan['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_telp_pic_keuangan);

        // Group Kontak PIC Teknis
        $data_kontak_telp_pic_teknis = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_teknis['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic_teknis = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_teknis['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic_teknis = $group_kontak->selectOne("WHERE idRelation = '" . $data_group_pic_teknis['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        // Group Legalitas Vendor
        $data_legalitas_vendor = $group_legalitas->selectOne("WHERE idRelation  = '" .  $id . "' AND idLegalitas = '" . $data_legalitas . "'");
        // dd($data_legalitas_vendor);

        $media = new Media();

        // Media Vendor
        $path_media_dokumentasi_aktivasi = $media->selectALLMedia("WHERE idRelation = '" .  $id . "' AND jenisdokumenMedia = 'dokumentasi-aktivasi'");
        $path_media_dokumentasi_instalasi = $media->selectALLMedia("WHERE idRelation = '" .  $id . "' AND jenisdokumenMedia = 'dokumentasi-instalasi'");
        // $path_media_dokumentasi_onsite = $media->selectALLMedia("WHERE idRelation = '" .  $id . "' AND jenisdokumenMedia = 'dokumentasi-onsite'");
        // dd($path_media_dokumentasi_onsite);

        $npwp = $media->selectOneMedia("WHERE idRelation = '" .  $id . "' AND jenisdokumenMedia = 'foto-legalitas-user'");
        $ktp = $media->selectOneMedia("WHERE idRelation = '" .  $id . "' AND jenisdokumenMedia = 'foto-ktp' ");
        $form = $media->selectOneMedia("WHERE idRelation = '" .  $id . "' AND jenisdokumenMedia = 'file-form' ");
        // dd($ktp);

        // Media Vendor

        $internet_user_vendor = new InternetUserVendor();
        $data_internet_user_vendor = $internet_user_vendor->selectOne($id);
        // dd($data_internet_user_vendor);

        $instalasi = new Instalasi();
        $data_instalasi = $instalasi->selectOne("WHERE noRegistrasi = '" . $id . "'");
        // dd($data_instalasi);

        $aktivasi = new Aktivasi();
        $data_aktivasi = $aktivasi->selectOne("WHERE idRelation = '" . $id . "'");
        // dd($data_aktivasi);

        $aktif = new Aktif();
        $data_aktif = $aktif->selectOne("WHERE idRelation = '" . $id . "'");
        // dd($data_aktif);

        return $this->render_template('admin/master/registrasi/detail', ['datas' => $datas, 'data_internet_user_layanan' => $data_internet_user_layanan, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_kontak_telp_pic_keuangan' => $data_kontak_telp_pic_keuangan, 'data_kontak_whatsapp_pic_keuangan' => $data_kontak_whatsapp_pic_keuangan, 'data_kontak_email_pic_keuangan' => $data_kontak_email_pic_keuangan, 'data_kontak_telp_pic_teknis' => $data_kontak_telp_pic_teknis, 'data_kontak_whatsapp_pic_teknis' => $data_kontak_whatsapp_pic_teknis, 'data_kontak_email_pic_teknis' => $data_kontak_email_pic_teknis, 'data_legalitas_vendor' => $data_legalitas_vendor, 'npwp' => $npwp, 'data_internet_user_vendor' => $data_internet_user_vendor, 'data_instalasi' => $data_instalasi, 'data_aktivasi' => $data_aktivasi, 'data_aktif' => $data_aktif, 'path_media_dokumentasi_aktivasi' => $path_media_dokumentasi_aktivasi, 'data_feesales' => $data_feesales, 'alamat_pemasangan' => $alamat_pemasangan, 'alamat_penagihan' => $alamat_penagihan, 'data_invoice' => $data_invoice, 'data_group_pic_keuangan' => $data_group_pic_keuangan, 'data_group_pic_teknis' => $data_group_pic_teknis, 'ktp' => $ktp, 'path_media_dokumentasi_instalasi' => $path_media_dokumentasi_instalasi, 'form' => $form]);
    }

    public function status(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();
        $id = $request->attributes->get('id');

        $detail = $this->model->selectOne($id);

        // dd($detail, $id);


        $statusRegistrasi = '2';
        $user_status = $this->model->status($id, $statusRegistrasi);

        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "User atas nama <b>" . $detail['namauserRegistrasi'] . "</b> telah berhasil di <b>aktivasi</b>";
        $kirim = $user->telegram($message, $ambilUser['chatId']);


        return new RedirectResponse('/registrasi-user');
    }



    public function lite(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll(" WHERE namaLayanan = 'UrbanLite'");

        return $this->render_template('admin/master/urban/lite', ['datas' => $datas]);
    }

    public function max(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll(" WHERE namaLayanan = 'UrbanMax'");

        return $this->render_template('admin/master/urban/max', ['datas' => $datas]);
    }

    public function ultimate(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll(" WHERE namaLayanan = 'UrbanUltimate'");


        return $this->render_template('admin/master/urban/ultimate', ['datas' => $datas]);
    }


    public function dokumentasiAktivasi(Request $request)
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

        return $this->render_template('admin/master/registrasi/dokumentasi-aktivasi', ['id' => $id, 'layanan' => $layanan, 'data_internet_user_layanan' => $data_internet_user_layanan, 'layanan_detail' => $layanan_detail]);
    }

    public function dokumentasiInstalasi(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);


        return $this->render_template('admin/master/registrasi/dokumentasi-instalasi', ['id' => $id]);
    }
}
