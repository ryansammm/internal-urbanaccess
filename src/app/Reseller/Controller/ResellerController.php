<?php

namespace App\Reseller\Controller;

use App\Chronology\Model\Chronology;
use App\Bank\Model\Bank;
use App\BankSales\Model\BankSales;
use App\GroupKontak\Model\GroupKontak;
use App\GroupLegalitas\Model\GroupLegalitas;
use App\GroupPIC\Model\GroupPIC;
use App\Kontak\Model\Kontak;
use App\Legalitas\Model\Legalitas;
use App\Media\Model\Media;
use App\PIC\Model\PIC;
use App\Provinsi\Model\Provinsi;
use App\Reseller\Model\Reseller;
use App\SalesAlamat\Model\SalesAlamat;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ResellerController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Reseller();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();
        // dd($datas);

        return $this->render_template('admin/master/reseller/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $bank = new Bank();
        $data_bank = $bank->selectAll();
        // dd($data_bank);

        return $this->render_template('admin/master/reseller/create', ['provinsi' => $data_provinsi, 'data_bank' => $data_bank]);
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        // Data Reseller
        $datas = $request->request->all();
        $create_reseller = $this->model->create($datas);
        $status_alamat_sales = '1';

        // Sales Alamat
        $sales_alamat = new SalesAlamat();
        $sales_alamat_create = $sales_alamat->create($create_reseller, $datas, $status_alamat_sales);

        // ID Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        $kontak = new GroupKontak();
        // kontak telepon vendor
        $group_kontak_vendor_telp = [
            'idRelation' => $create_reseller,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_kontak_vendor_telp_create = $kontak->create($group_kontak_vendor_telp);

        // kontak whatsapp vendor
        $group_kontak_vendor_wa = [
            'idRelation' => $create_reseller,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_kontak_vendor_wa_create = $kontak->create($group_kontak_vendor_wa);

        // kontak email vendor
        $group_kontak_vendor_email = [
            'idRelation' => $create_reseller,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_kontak_vendor_email_create = $kontak->create($group_kontak_vendor_email);

        // Bank
        $bank_sales = new BankSales();
        $bank_sales_create = $bank_sales->create($create_reseller, $datas);

        // PIC
        // create pic internal
        $pic_vendor = new PIC();
        $datas['statusPic'] = '1';
        $pic_vendor_create = $pic_vendor->create($datas);

        // create group pic vendor
        $group_pic_vendor = new GroupPIC();
        $group_pic_vendor_data = [
            'nikPic' => $datas['nikPic'],
            'idRelation' => $create_reseller
        ];
        $group_pic_vendor_create = $group_pic_vendor->create($group_pic_vendor_data);

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

        // create legalitas pic vendor
        $file_npwp_pic = $_FILES['fileNPWPPIC'];
        $group_persyaratan_pic_npwp_data = [
            'idRelation' => $pic_vendor_create,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWPPIC']
        ];
        $group_persyaratan_pic_npwp_create = $group_legalitas->create($group_persyaratan_pic_npwp_data);

        $media = new Media();
        $file_upload_pic_npwp_create = $media->create($file_npwp_pic, $group_persyaratan_pic_npwp_create, '1', 'foto-legalitas-pic');

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menambah Data Reseller pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create_reseller , $idUser);

        return new RedirectResponse('/reseller');
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
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $bank_sales = new BankSales();
        $data_bank_sales = $bank_sales->selectOne("WHERE idRelation= '" . $id . "'");

        $bank = new Bank();
        $data_bank = $bank->selectOne("WHERE idBank = '" . $data_bank_sales['idBank'] . "'");
        // dd($data_bank);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak Sales
        $group_kontak = new GroupKontak();
        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['idSales'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $datas['idSales'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $datas['idSales'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_telp);

        // Group Kontak PIC
        $data_kontak_telp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic = $group_kontak->selectOne("WHERE idRelation = '" . $datas['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");
        // dd($data_kontak_email_pic);

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        // Group Legalitas Vendor
        $data_legalitas_sales = $group_legalitas->selectOne("WHERE idRelation  = '" .  $datas['nikPic'] . "' AND idLegalitas = '" . $data_legalitas . "'");
        // dd($data_legalitas_sales);

        // Media
        $media = new Media();
        $path_media = $media->selectOneMedia("WHERE idRelation = '" .  $datas['nikPic'] . "'");
        // dd($path_media);

        return $this->render_template('admin/master/reseller/detail', ['datas' => $datas, 'data_provinsi' => $data_provinsi, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_kontak_telp_pic' => $data_kontak_telp_pic, 'data_kontak_whatsapp_pic' => $data_kontak_whatsapp_pic, 'data_kontak_email_pic' => $data_kontak_email_pic, 'data_legalitas_sales' => $data_legalitas_sales, 'path_media' => $path_media, 'data_bank' => $data_bank, 'data_bank_sales' => $data_bank_sales]);
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

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();

        $data_kontak_telp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['idSales'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp = $group_kontak->selectOne("WHERE idRelation = '" . $detail['idSales'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email = $group_kontak->selectOne("WHERE idRelation = '" . $detail['idSales'] . "' AND idKontak = '" . $id_jenis_email . "'");

        $data_kontak_telp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_telp . "'");
        $data_kontak_whatsapp_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_whatsapp . "'");
        $data_kontak_email_pic = $group_kontak->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idKontak = '" . $id_jenis_email . "'");

        // Provinsi
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $bank = new Bank();
        $data_bank = $bank->selectAll();

        $bank_sales = new BankSales();
        $data_bank_sales = $bank_sales->selectOne("WHERE idRelation = '" . $detail['idSales'] . "'");
        // dd($data_bank_sales);

        // Group Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_pic = $group_legalitas->selectOne("WHERE idRelation = '" . $detail['nikPic'] . "' AND idLegalitas = '" . $data_legalitas . "'");

        // Media
        $media = new Media();
        $path_media = $media->selectOneMedia("WHERE idRelation = '" .  $detail['nikPic'] . "'");

        return $this->render_template('admin/master/reseller/edit', ['detail' => $detail, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_provinsi' => $data_provinsi, 'group_legalitas_pic' => $group_legalitas_pic, 'data_kontak_telp_pic' => $data_kontak_telp_pic, 'data_kontak_whatsapp_pic' => $data_kontak_whatsapp_pic, 'data_kontak_email_pic' => $data_kontak_email_pic, 'path_media' => $path_media, 'data_bank' => $data_bank, 'data_bank_sales' => $data_bank_sales]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        // dd($detail);
        $datas = $request->request->all();
        $update = $this->model->update($id, $datas);
        $id_pic = $detail['nikPic'];

        $status_alamat_sales = '1';

        // Alamat
        $sales_alamat = new SalesAlamat();
        $sales_alamat_update = $sales_alamat->update($id, $datas, $status_alamat_sales);

        // Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        // Group Kontak
        $group_kontak = new GroupKontak();

        // Delete Kontak Sales
        $delete_kontak = $group_kontak->delete("WHERE idRelation = '" . $detail['idSales'] . "'");

        // Create Kontak Sales
        $data_group_kontak_telp = [
            'idRelation' => $detail['idSales'],
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp);

        $data_group_kontak_whatsapp = [
            'idRelation' => $detail['idSales'],
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp);

        $data_group_kontak_email = [
            'idRelation' => $detail['idSales'],
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email);


        // Delete Kontak PIC
        $delete_kontak_pic = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        // Create Kontak PIC
        $data_group_kontak_telp_pic = [
            'idRelation' => $datas['nikPic'],
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['noTelpPIC']
        ];
        $create_group_kontak_telp = $group_kontak->create($data_group_kontak_telp_pic);

        $data_group_kontak_whatsapp_pic = [
            'idRelation' => $datas['nikPic'],
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['noWaPIC']
        ];
        $create_group_kontak_whatsapp = $group_kontak->create($data_group_kontak_whatsapp_pic);

        $data_group_kontak_email_pic = [
            'idRelation' => $datas['nikPic'],
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailPIC']
        ];
        $create_group_kontak_email = $group_kontak->create($data_group_kontak_email_pic);

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
            'idRelation' => $detail['idSales']
        ];
        $group_pic_create = $group_pic->create($group_pic_data);

        $bank_sales = new BankSales();
        $bank_sales_delete = $bank_sales->delete("WHERE idRelation = '" . $detail['idSales'] . "'");
        $bank_sales_create = $bank_sales->create($detail['idSales'], $datas);

        // Legalitas
        $legalitas = new Legalitas();

        // Group Legalitas
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_delete_pic = $group_legalitas->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        // Media PIC
        if ($_FILES['fileNPWPPIC']['name'] != '') {
            $media = new Media();
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
            'idRelation' => $datas['nikPic'],
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWPPIC']
        ];
        $group_persyaratan_pic_npwp_create = $group_legalitas->create($group_persyaratan_pic_npwp_data);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah mengubah Data Reseller pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update , $idUser);


        return new RedirectResponse('/reseller');
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
        $group_kontak_delete = $group_kontak->delete("WHERE idRelation = '" . $detail['idSales'] . "'");
        $group_kontak_delete_pic = $group_kontak->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        $sales_alamat = new SalesAlamat();
        $sales_alamat_delete = $sales_alamat->delete($id);

        $media = new Media();
        $selectItemPic = $media->selectOneMedia("WHERE idRelation = '" . $detail['nikPic'] . "'");

        $deleteFotoItemPic = $media->delete($selectItemPic['idMedia']);
        $deleteFileFotoItamPic = $media->deleteFile($selectItemPic['pathMedia']);

        $group_legalitas = new GroupLegalitas();
        $group_legalitas_delete_pic = $group_legalitas->delete("WHERE idRelation = '" . $detail['nikPic'] . "'");

        $pic = new PIC();
        $pic_delete = $pic->delete("WHERE nikPic = '" . $detail['nikPic'] . "'");

        $group_pic = new GroupPIC();
        $group_pic_delete = $group_pic->delete("WHERE idRelation = '" . $detail['idSales'] . "'");

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menghapus Data Reseller pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $deletee , $idUser);


        return new RedirectResponse('/reseller');
    }
}
