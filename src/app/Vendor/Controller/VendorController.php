<?php

namespace App\Vendor\Controller;

use App\Chronology\Model\Chronology;
use App\GroupKontak\Model\GroupKontak;
use App\GroupLegalitas\Model\GroupLegalitas;
use App\GroupPersyaratan\Model\GroupPersyaratan;
use App\GroupPIC\Model\GroupPIC;
use App\Kontak\Model\Kontak;
use App\Legalitas\Model\Legalitas;
use App\Media\Model\Media;
use App\PIC\Model\PIC;
use App\Provinsi\Model\Provinsi;
use App\Vendor\Model\Vendor;
use App\VendorAlamat\Model\VendorAlamat;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class VendorController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Vendor();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();
        // dd($datas);

        return $this->render_template('admin/master/vendor/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $kodeVendor = uniqid('V-');

        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        return $this->render_template('admin/master/vendor/create', ['kodeVendor' => $kodeVendor, 'provinsi' => $data_provinsi]);
    }

    public function detail(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);
        // dd($datas);

        // Alamat
        $kode_minat = uniqid('M-');
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak Vendor
        $group_kontak = new GroupKontak();
        $data_kontak_telp_vendor = $group_kontak->selectOne("WHERE idRelation = '" . $datas['idVendor'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_vendor = $group_kontak->selectOne("WHERE idRelation = '" . $datas['idVendor'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_vendor = $group_kontak->selectOne("WHERE idRelation = '" . $datas['idVendor'] . "' AND idKontak = '" . $id_jenis_email . "'");

        // Group Kontak PIC
        $data_kontak_telp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        // Group Legalitas Vendor
        $data_legalitas_vendor = $group_legalitas->selectOne("WHERE idRelation  = '" .  $datas['idVendor'] . "' AND idLegalitas = '" . $data_legalitas . "'");

        // Group Legalitas PIC
        $data_legalitas_pic = $group_legalitas->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idLegalitas = '" . $data_legalitas . "'");

        // Media
        $media = new Media();

        // Media Vendor
        $path_media_vendor = $media->selectOneMedia("WHERE idRelation = '" .  $datas['idVendor'] . "'");

        // Media PIC
        $path_media_pic = $media->selectOneMedia("WHERE idRelation = '" .  $datas['nikPic'] . "'");
        // dd($path_media_pic);


        return $this->render_template('admin/master/vendor/detail', ['datas' => $datas, 'kode_minat' => $kode_minat, 'provinsi' => $data_provinsi, 'data_kontak_telp_vendor' => $data_kontak_telp_vendor, 'data_kontak_whatsapp_vendor' => $data_kontak_whatsapp_vendor, 'data_kontak_email_vendor' => $data_kontak_email_vendor, 'data_kontak_telp_pic' => $data_kontak_telp_pic, 'data_kontak_whatsapp_pic' => $data_kontak_whatsapp_pic, 'data_kontak_email_pic' => $data_kontak_email_pic, 'data_legalitas_vendor' => $data_legalitas_vendor, 'data_legalitas_pic' => $data_legalitas_pic, 'path_media_vendor' => $path_media_vendor, 'path_media_pic' => $path_media_pic]);
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();
        // dd($datas);
        // create vendor
        $create_vendor = $this->model->create($datas);

        $kontak = new GroupKontak();
        // kontak telepon vendor
        $group_kontak_vendor_telp = [
            'idRelation' => $create_vendor,
            'idKontak' => $datas['noTelpVendorId'],
            'isiKontak' => $datas['noTelpVendor']
        ];
        $create_kontak_vendor_telp_create = $kontak->create($group_kontak_vendor_telp);

        // kontak telepon vendor
        $group_kontak_vendor_wa = [
            'idRelation' => $create_vendor,
            'idKontak' => $datas['noWaVendorId'],
            'isiKontak' => $datas['noWaVendor']
        ];
        $create_kontak_vendor_wa_create = $kontak->create($group_kontak_vendor_wa);

        // kontak email vendor
        $group_kontak_vendor_email = [
            'idRelation' => $create_vendor,
            'idKontak' => $datas['emailVendorId'],
            'isiKontak' => $datas['emailVendor']
        ];
        $create_kontak_vendor_email_create = $kontak->create($group_kontak_vendor_email);

        // create alamat vendor
        $alamat_vendor = new VendorAlamat();
        $alamat_vendor_create = $alamat_vendor->create($create_vendor, $datas);

        $media = new Media();

        // create pic internal
        $pic_vendor = new PIC();
        $datas['statusPic'] = '1';
        $pic_vendor_create = $pic_vendor->create($datas);

        // create group pic vendor
        $group_pic_vendor = new GroupPIC();
        $group_pic_vendor_data = [
            'nikPic' => $datas['nikPic'],
            'idRelation' => $create_vendor
        ];
        $group_pic_vendor_create = $group_pic_vendor->create($group_pic_vendor_data);

        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // kontak telepon pic vendor
        $group_kontak_pic_vendor_telp = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPIC']
        ];
        $create_kontak_pic_vendor_telp_create = $kontak->create($group_kontak_pic_vendor_telp);

        // kontak telepon pic vendor
        $group_kontak_pic_vendor_wa = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPIC']
        ];
        $create_kontak_pic_vendor_wa_create = $kontak->create($group_kontak_pic_vendor_wa);

        // kontak email pic vendor
        $group_kontak_pic_vendor_email = [
            'idRelation' => $pic_vendor_create,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPIC']
        ];
        $create_kontak_pic_vendor_email_create = $kontak->create($group_kontak_pic_vendor_email);

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        $file_npwp_vendor = $_FILES['fileNPWPVendor'];
        $legalitas_vendor_create = [
            'idRelation' => $create_vendor,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWPVendor']
        ];
        $group_persyaratan_vendor_npwp_create = $group_legalitas->create($legalitas_vendor_create);

        // create legalitas pic vendor
        $file_npwp_pic = $_FILES['fileNPWPPIC'];
        $group_persyaratan_pic_npwp_data = [
            'idRelation' => $pic_vendor_create,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWPPIC']
        ];
        $group_persyaratan_pic_npwp_create = $group_legalitas->create($group_persyaratan_pic_npwp_data);


        $file_upload_pic_npwp_create = $media->create($file_npwp_vendor, $group_persyaratan_vendor_npwp_create, '1', 'foto-legalitas-vendor');
        $file_upload_pic_npwp_create = $media->create($file_npwp_pic, $group_persyaratan_pic_npwp_create, '1', 'foto-legalitas-pic');

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menambah Data Vendor pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create_vendor , $idUser);

        return new RedirectResponse('/vendor');
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
        // dd($detail);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();

        $data_kontak_telp_vendor = $group_kontak->selectOne("WHERE idRelation = '" . $detail['idVendor'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_vendor = $group_kontak->selectOne("WHERE idRelation = '" . $detail['idVendor'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_vendor = $group_kontak->selectOne("WHERE idRelation = '" . $detail['idVendor'] . "' AND idKontak = '" . $id_jenis_email . "'");

        $data_kontak_telp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");

        // Provinsi
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        // Group Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_vendor = $group_legalitas->selectOne("WHERE idRelation  = '" .  $detail['idVendor'] . "' AND idLegalitas = '" . $data_legalitas . "'");
        $group_legalitas_pic = $group_legalitas->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idLegalitas = '" . $data_legalitas . "'");

        return $this->render_template('admin/master/vendor/edit', ['detail' => $detail, 'data_kontak_telp_vendor' => $data_kontak_telp_vendor, 'data_kontak_whatsapp_vendor' => $data_kontak_whatsapp_vendor, 'data_kontak_email_vendor' => $data_kontak_email_vendor, 'data_kontak_telp_pic' => $data_kontak_telp_pic, 'data_kontak_whatsapp_pic' => $data_kontak_whatsapp_pic, 'data_kontak_email_pic' => $data_kontak_email_pic, 'group_legalitas_vendor' => $group_legalitas_vendor, 'group_legalitas_pic' => $group_legalitas_pic, 'data_provinsi' => $data_provinsi]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $datas = $request->request->all();
        $update = $this->model->update($id, $datas);
        $id_pic = $detail['nikPic'];


        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();

        // Update with delete method
        $delete_kontak_vendor = $group_kontak->delete("WHERE idRelation = '" . $detail['idVendor'] . "'");
        $delete_kontak_pic = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        // create kontak Vendor
        $data_group_kontak_telp_vendor = [
            'idRelation' => $detail['idVendor'],
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpVendor']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp_vendor);

        $data_group_kontak_whatsapp_vendor = [
            'idRelation' => $detail['idVendor'],
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaVendor']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp_vendor);

        $data_group_kontak_email_vendor = [
            'idRelation' => $detail['idVendor'],
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailVendor']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email_vendor);

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

        // Vendor Alamat
        $vendor_alamat = new VendorAlamat();
        $vendor_alamat_update = $vendor_alamat->update($id, $datas);

        // Legalitas
        $legalitas = new Legalitas();

        // Group Legalitas
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_delete_vendor = $group_legalitas->delete("WHERE idRelation = '" . $detail['idVendor'] . "'");
        $group_legalitas_delete_pic = $group_legalitas->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        // Media Vendor
        if ($_FILES['fileNPWPVendor']['name'] != '') {
            $media = new Media();
            // select existing foto item
            $selectItem = $media->selectOneMedia("WHERE idRelation = '$id'");
            // delete existing foto item
            $deleteFotoItem = $media->delete($selectItem['idMedia']);
            // delete file foto item
            $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $media->create($_FILES['fileNPWPVendor'], $update, '1', 'foto-legalitas-vendor');
        }

        $legalitas_vendor_create = [
            'idRelation' => $id,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWPVendor']
        ];
        $group_persyaratan_vendor_npwp_create = $group_legalitas->create($legalitas_vendor_create);

        // Media PIC
        if ($_FILES['fileNPWPPIC']['name'] != '') {
            // select existing foto item
            $selectItem = $media->selectOneMedia("WHERE idRelation = '$id_pic'");
            // delete existing foto item
            $deleteFotoItem = $media->delete($selectItem['idMedia']);
            // delete file foto item
            $deleteFileFotoItam = $media->deleteFile($selectItem['pathMedia']);

            $idMedia = uniqid('med');
            $idUser = '1';
            $media->create($_FILES['fileNPWPPIC'], $id_pic, '1', 'foto-legalitas-pic');
        }

        $group_persyaratan_pic_npwp_data = [
            'idRelation' => $id_pic,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWPPIC']
        ];
        $group_persyaratan_pic_npwp_create = $group_legalitas->create($group_persyaratan_pic_npwp_data);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah mengubah Data Vendor pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update , $idUser);

        return new RedirectResponse('/vendor');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $delete = $this->model->delete($id);

        $group_kontak = new GroupKontak();
        $group_kontak_delete_vendor = $group_kontak->delete("WHERE idRelation = '" . $detail['idVendor'] . "'");
        $group_kontak_delete_pic = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        $vendor_alamat = new VendorAlamat();
        $vendor_alamat_delete = $vendor_alamat->delete($id);

        $media = new Media();
        $selectItemVendor = $media->selectOneMedia("WHERE idRelation = '" . $detail['idVendor'] . "'");
        $selectItemPic = $media->selectOneMedia("WHERE idRelation = '" . $detail['nikPic'] . "'");
        // dd($selectItemVendor, $selectItemPic);

        $deleteFotoItemVendor = $media->delete($selectItemVendor['idMedia']);
        $deleteFileFotoItamVendor = $media->deleteFile($selectItemVendor['pathMedia']);

        $deleteFotoItemPic = $media->delete($selectItemPic['idMedia']);
        $deleteFileFotoItamPic = $media->deleteFile($selectItemPic['pathMedia']);

        $group_legalitas = new GroupLegalitas();
        $group_legalitas_delete_vendor = $group_legalitas->delete("WHERE idRelation = '" . $detail['idVendor'] . "'");
        $group_legalitas_delete_pic = $group_legalitas->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        $pic = new PIC();
        $pic_delete = $pic->delete("WHERE nikPic = '" . $detail['nikPic'] . "'");

        $group_pic = new GroupPIC();
        $group_pic_delete = $group_pic->delete("WHERE idRelation = '" . $detail['idVendor'] . "'");

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menghapus Data Vendor pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete , $idUser);

        return new RedirectResponse('/vendor');
    }
}
