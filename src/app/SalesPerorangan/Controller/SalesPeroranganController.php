<?php

namespace App\SalesPerorangan\Controller;

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
use App\SalesAlamat\Model\SalesAlamat;
use App\SalesPerorangan\Model\SalesPerorangan;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SalesPeroranganController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new SalesPerorangan();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();
        // dd($datas);

        return $this->render_template('admin/master/sales-perorangan/index', ['datas' => $datas]);
    }



    public function create(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        $bank = new Bank();
        $data_bank = $bank->selectAll();


        return $this->render_template('admin/master/sales-perorangan/create', ['provinsi' => $data_provinsi, 'data_bank' => $data_bank]);
    }

    public function store(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();
        $create_sales_perorangan = $this->model->create($datas);
        $status_alamat_saat_ini = '1';
        $status_alamat_identitas = '2';

        $sales_alamat = new SalesAlamat();
        $sales_alamat_create_saat_ini = $sales_alamat->createSaatIni($create_sales_perorangan, $datas, $status_alamat_saat_ini);
        $sales_alamat_create_identitas = $sales_alamat->createIdentitas($create_sales_perorangan, $datas, $status_alamat_identitas);

        // ID Kontak
        $jeniskontak = new Kontak();
        $id_jenis_telp = $jeniskontak->namaKontak("Telepon")['idKontak'];
        $id_jenis_whatsapp = $jeniskontak->namaKontak("Whatsapp")['idKontak'];
        $id_jenis_email = $jeniskontak->namaKontak("Email")['idKontak'];

        $kontak = new GroupKontak();
        // kontak telepon vendor
        $group_kontak_vendor_telp = [
            'idRelation' => $create_sales_perorangan,
            'idKontak' => $id_jenis_telp,
            'isiKontak' => $datas['telpkontak']
        ];
        $create_kontak_vendor_telp_create = $kontak->create($group_kontak_vendor_telp);

        // kontak whatsapp vendor
        $group_kontak_vendor_wa = [
            'idRelation' => $create_sales_perorangan,
            'idKontak' => $id_jenis_whatsapp,
            'isiKontak' => $datas['whatsappkontak']
        ];
        $create_kontak_vendor_wa_create = $kontak->create($group_kontak_vendor_wa);

        // kontak email vendor
        $group_kontak_vendor_email = [
            'idRelation' => $create_sales_perorangan,
            'idKontak' => $id_jenis_email,
            'isiKontak' => $datas['emailkontak']
        ];
        $create_kontak_vendor_email_create = $kontak->create($group_kontak_vendor_email);

        // Bank
        $bank_sales = new BankSales();
        $bank_sales_create = $bank_sales->create($create_sales_perorangan, $datas);

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        // create legalitas pic vendor
        $file_npwp_pic = $_FILES['fileNPWP'];
        $group_persyaratan_pic_npwp_data = [
            'idRelation' => $create_sales_perorangan,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWP']
        ];
        $group_persyaratan_pic_npwp_create = $group_legalitas->create($group_persyaratan_pic_npwp_data);
        $media = new Media();
        $file_upload_pic_npwp_create = $media->create($file_npwp_pic, $group_persyaratan_pic_npwp_create, '1', 'foto-legalitas-pic');


        return new RedirectResponse('/sales-perorangan');
    }

    public function detail(Request $request)
    {
        if ($this->session->get('username') == null) {
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

        $sales_alamat = new SalesAlamat();
        $data_sales_alamat_saat_ini = $sales_alamat->selectOnePerorangan("WHERE status = 1 AND idSales = '" . $datas['idSales'] . "'");
        $data_sales_alamat_identitas = $sales_alamat->selectOnePerorangan("WHERE status = 2 AND idSales = '" . $datas['idSales'] . "'");
        // dd($data_sales_alamat_saat_ini, $data_sales_alamat_identitas);

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

        // Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];

        // Group Legalitas Vendor
        $data_legalitas_sales = $group_legalitas->selectOne("WHERE idRelation  = '" .  $datas['idSales'] . "' AND idLegalitas = '" . $data_legalitas . "'");

        // Media
        $media = new Media();
        $path_media = $media->selectOneMedia("WHERE idRelation = '" .  $datas['idSales'] . "'");
        // dd($path_media);

        return $this->render_template('admin/master/sales-perorangan/detail', ['datas' => $datas, 'data_provinsi' => $data_provinsi, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_legalitas_sales' => $data_legalitas_sales, 'path_media' => $path_media, 'data_sales_alamat_saat_ini' => $data_sales_alamat_saat_ini, 'data_sales_alamat_identitas' => $data_sales_alamat_identitas, 'data_bank_sales' => $data_bank_sales, 'data_bank' => $data_bank]);
    }

    public function get(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $data = $this->model->selectOne($id);

        return new JsonResponse($data);
    }

    public function edit(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);

        $sales_alamat = new SalesAlamat();
        $data_sales_alamat_saat_ini = $sales_alamat->selectOnePerorangan("WHERE status = 1 AND idSales = '" . $detail['idSales'] . "'");
        $data_sales_alamat_identitas = $sales_alamat->selectOnePerorangan("WHERE status = 2 AND idSales = '" . $detail['idSales'] . "'");
        // dd($data_sales_alamat_identitas);

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

        // Group Legalitas
        $legalitas = new Legalitas();
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_pic = $group_legalitas->selectOne("WHERE idRelation = '" . $detail['idSales'] . "' AND idLegalitas = '" . $data_legalitas . "'");

        // Media
        $media = new Media();
        $path_media = $media->selectOneMedia("WHERE idRelation = '" .  $detail['nikPic'] . "'");

        return $this->render_template('admin/master/sales-perorangan/edit', ['detail' => $detail, 'data_kontak_telp' => $data_kontak_telp, 'data_kontak_whatsapp' => $data_kontak_whatsapp, 'data_kontak_email' => $data_kontak_email, 'data_provinsi' => $data_provinsi, 'group_legalitas_pic' => $group_legalitas_pic, 'data_kontak_telp_pic' => $data_kontak_telp_pic, 'data_kontak_whatsapp_pic' => $data_kontak_whatsapp_pic, 'data_kontak_email_pic' => $data_kontak_email_pic, 'path_media' => $path_media, 'data_sales_alamat_saat_ini' => $data_sales_alamat_saat_ini, 'data_sales_alamat_identitas' => $data_sales_alamat_identitas, 'data_bank' => $data_bank, 'data_bank_sales' => $data_bank_sales]);
    }


    public function update(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        // dd($detail);
        $datas = $request->request->all();
        $update = $this->model->update($id, $datas);

        $status_alamat_saat_ini = '1';
        $status_alamat_identitas = '2';

        $sales_alamat = new SalesAlamat();
        $sales_alamat_create_saat_ini = $sales_alamat->deleteSaatIni("WHERE status = 1 AND idSales = '" . $id . "'");
        $sales_alamat_create_identitas = $sales_alamat->deleteIdentitas("WHERE status = 2 AND idSales = '" . $id . "'");
        $sales_alamat_create_saat_ini = $sales_alamat->createSaatIni($id, $datas, $status_alamat_saat_ini);
        $sales_alamat_create_identitas = $sales_alamat->createIdentitas($id, $datas, $status_alamat_identitas);


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


        $bank_sales = new BankSales();
        $bank_sales_delete = $bank_sales->delete("WHERE idRelation = '" . $detail['idSales'] . "'");
        $bank_sales_create = $bank_sales->create($detail['idSales'], $datas);


        // Legalitas
        $legalitas = new Legalitas();

        // Group Legalitas
        $group_legalitas = new GroupLegalitas();
        $data_legalitas = $legalitas->singkatanLegalitas("npwp")['idLegalitas'];
        $group_legalitas_delete_pic = $group_legalitas->delete("WHERE idRelation = '" . $detail['idSales'] . "'");

        // Media PIC
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
            $media->create($_FILES['fileNPWP'], $id, '1', 'foto-legalitas-pic');
        }

        $group_persyaratan_pic_npwp_data = [
            'idRelation' => $id,
            'idLegalitas' => $data_legalitas,
            'isiLegalitas' => $datas['noNPWP']
        ];
        $group_persyaratan_pic_npwp_create = $group_legalitas->create($group_persyaratan_pic_npwp_data);

        return new RedirectResponse('/sales-perorangan');
    }

    public function delete(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $delete = $this->model->delete($id);

        $group_kontak = new GroupKontak();
        $group_kontak_delete = $group_kontak->delete("WHERE idRelation = '" . $detail['idSales'] . "'");

        $sales_alamat = new SalesAlamat();
        $sales_alamat_create_saat_ini = $sales_alamat->deleteSaatIni("WHERE status = 1 AND idSales = '" . $id . "'");
        $sales_alamat_create_identitas = $sales_alamat->deleteIdentitas("WHERE status = 2 AND idSales = '" . $id . "'");

        $media = new Media();
        $selectItemPic = $media->selectOneMedia("WHERE idRelation = '" . $detail['idSales'] . "'");

        $deleteFotoItemPic = $media->delete($selectItemPic['idMedia']);
        $deleteFileFotoItamPic = $media->deleteFile($selectItemPic['pathMedia']);

        $group_legalitas = new GroupLegalitas();
        $group_legalitas_delete_pic = $group_legalitas->delete("WHERE idRelation = '" . $detail['idSales'] . "'");

        return new RedirectResponse('/sales-perorangan');
    }
}
