<?php

namespace App\RegistrasiUser\Controller;

use App\Aktif\Model\Aktif;
use App\Aktivasi\Model\Aktivasi;
use App\Client\Model\Client;
use App\GroupKontak\Model\GroupKontak;
use App\GroupLayanan\Model\GroupLayanan;
use App\GroupLegalitas\Model\GroupLegalitas;
use App\GroupPersyaratan\Model\GroupPersyaratan;
use App\GroupPIC\Model\GroupPIC;
use App\Instalasi\Model\Instalasi;
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
        $datas = $this->model->selectAll("WHERE statusRegistrasi = 4");
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
        // dd($data_minat);

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

        // Nomor Registrasi
        $noRegistrasi = $this->noRegistrasi($datas);

        $datas['noRegistrasi'] = $noRegistrasi;
        // dd($datas);


        // dd($datas);



        $internet_user_registrasi_create = $this->model->create($datas);

        $internet_user_alamat = new InternetUserAlamat();
        $internet_user_alamat_create = $internet_user_alamat->create($noRegistrasi, $datas);

        $internet_user_layanan = new InternetUserLayanan();
        $internet_user_layanan_create = $internet_user_layanan->create($noRegistrasi, $datas);
        // dd($internet_user_layanan_create);

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
        $media->create($_FILES['fileNPWP'], $noRegistrasi, '1', 'foto-legalitas-user');


        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Data user atas nama " . $datas['namauserRegistrasi'] . " dengan nomor registrasi " . $datas['noRegistrasi'] . " berhasil ditambahkan";
        $kirim = $user->telegram($message, $ambilUser['chatId']);

        return new RedirectResponse('/registrasi-user');
    }


    public function edit(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        // dd($id);

        $internet_user_layanan = new InternetUserLayanan();
        $data_internet_user_layanan = $internet_user_layanan->selectOne($id);
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

        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak Vendor
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $detail['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_telp);

        // Group Kontak PIC
        $data_kontak_telp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_email_pic);

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


        return $this->render_template('admin/master/registrasi/edit', ['detail' => $detail, 'data_internet_user_layanan' => $data_internet_user_layanan, 'provinsi' => $data_provinsi, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_kontak_telp_pic' => $data_kontak_telp_pic, 'data_kontak_whatsapp_pic' => $data_kontak_whatsapp_pic, 'data_kontak_email_pic' => $data_kontak_email_pic, 'data_legalitas_vendor' => $data_legalitas_vendor, 'npwp' => $npwp, 'data_internet_user_vendor' => $data_internet_user_vendor, 'layanan' => $layanan, 'layanan_detail' => $layanan_detail, 'data_sales' => $data_sales, 'data_vendor' => $data_vendor, 'data_instalasi' => $data_instalasi, 'data_aktivasi' => $data_aktivasi, 'data_aktif' => $data_aktif]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);
        $detail = $this->model->selectOne($id);
        $datas = $request->request->all();


        $update = $this->model->update($id, $datas);
        $id_pic = $detail['nikPic'];

        $internet_user_layanan = new InternetUserLayanan();
        $internet_user_layanan_update = $internet_user_layanan->update($id, $datas);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();

        // Update with delete method
        $delete_kontak = $group_kontak->delete("WHERE idRelation = '" . $id . "'");
        $delete_kontak_pic = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        // create kontak Vendor
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

        // create kontak PIC
        $data_group_kontak_telp_pic = [
            'idRelation' => $detail['nikPic'],
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPIC']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp_pic);

        $data_group_kontak_whatsapp_pic = [
            'idRelation' => $detail['nikPic'],
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPIC']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp_pic);

        $data_group_kontak_email_pic = [
            'idRelation' => $detail['nikPic'],
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPIC']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email_pic);



        $internet_user_alamat = new InternetUserAlamat();
        $internet_user_alamat_update = $internet_user_alamat->update($id, $datas);

        // PIC
        // create pic internal
        $pic = new PIC();
        $pic_delete = $pic->delete("WHERE nikPic = '" . $detail['nikPic'] . "'");
        $datas['statusPic'] = '1';
        $pic_create = $pic->create($datas);

        // create group pic vendor
        $group_pic = new GroupPIC();
        $group_pic_delete = $group_pic->delete("WHERE nikPic = '" . $detail['nikPic'] . "'");
        $group_pic_data = [
            'nikPic' => $datas['nikPic'],
            'idRelation' => $id
        ];
        $group_pic_create = $group_pic->create($group_pic_data);

        // Legalitas
        $legalitas = new Legalitas();

        // Group Legalitas
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_delete_vendor = $group_legalitas->delete("WHERE idRelation = '" . $id . "'");

        // Media Vendor
        if ($_FILES['fileNPWP']['name'] != '') {
            $media = new Media();
            // select existing foto item
            $selectItem = $media->selectOneMedia("WHERE idRelation = '$id'");
            // delete existing foto item
            $deleteFotoItem = $media->delete($selectItem['idMedia']);
            // delete file foto item
            $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $media->create($_FILES['fileNPWP'], $update, '1', 'foto-legalitas-user');
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

        $delete = $this->model->delete($id);

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
        $data_internet_user_layanan = $internet_user_layanan->selectOne($id);
        // dd($data_internet_user_layanan);

        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak Vendor
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $datas['noRegistrasi'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_telp);

        // Group Kontak PIC
        $data_kontak_telp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_telp_pic);

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        // Group Legalitas Vendor
        $data_legalitas_vendor = $group_legalitas->selectOne("WHERE idRelation  = '" .  $id . "' AND idLegalitas = '" . $data_legalitas . "'");
        // dd($data_legalitas_vendor);

        $media = new Media();

        // Media Vendor
        $path_media_dokumentasi = $media->selectALLMedia("WHERE idRelation = '" .  $id . "' AND jenisdokumenMedia = 'dokumentasi'");
        // dd($path_media_dokumentasi);

        $npwp = $media->selectOneMedia("WHERE idRelation = '" .  $id . "'");

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

        return $this->render_template('admin/master/registrasi/detail', ['datas' => $datas, 'data_internet_user_layanan' => $data_internet_user_layanan, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_kontak_telp_pic' => $data_kontak_telp_pic, 'data_kontak_whatsapp_pic' => $data_kontak_whatsapp_pic, 'data_kontak_email_pic' => $data_kontak_email_pic, 'data_provinsi' => $data_provinsi, 'data_legalitas_vendor' => $data_legalitas_vendor, 'npwp' => $npwp, 'data_internet_user_vendor' => $data_internet_user_vendor, 'data_instalasi' => $data_instalasi, 'data_aktivasi' => $data_aktivasi, 'data_aktif' => $data_aktif, 'path_media_dokumentasi' => $path_media_dokumentasi]);
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
}
