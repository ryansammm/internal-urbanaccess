<?php

namespace App\Client\Controller;

use App\Chronology\Model\Chronology;
use App\Client\Model\Client;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ClientController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Client();
    }

    public function index(Request $request)
    {

        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/registrasi/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/registrasi/create');
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $dataClient = [
            'idRegistrasi' => $request->request->get('nomorRegistrasi'),
            'idLayanan' => $request->request->get('idLayanan'),
            'mediakoneksiRegistrasi' => $request->request->get('mediakoneksiRegistrasi'),
            'biayaRegistrasi' => $request->request->get('biayaRegistrasi'),
            'bulananRegistrasi' => $request->request->get('bulananRegistrasi'),
            'picRegistrasi' => '',
            'alamatpemasanganRegistrasi' => $request->request->get('alamatpemasanganRegistrasi'),
            'idClient' => '',
            'idProvinsi' => $request->request->get('idProvinsi'),
            'idKabupaten' => $request->request->get('idKabupaten'),
            'idKecamatan' => $request->request->get('idKecamatan'),
            'idKelurahan' => $request->request->get('idKelurahan'),
            'fotorumahRegistrasi' => '',
            'idSales' => '',
            'idGrouppersyaratan' => '',
            'tanggalRegistrasi' => $request->request->get('tanggalRegistrasi'),
            'layananTambahan' => $request->request->get('layananTambahan'),
            'isPic' => $request->request->get('isPic')
        ];
        $create = $this->model->create($dataClient);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menambah Data client pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create, $idUser);

        return new RedirectResponse('/registrasi');
    }

    // public function detail(Request $request)
    // {
    //     $idBank = $request->attributes->get('id');
    //     $detail = $this->model->selectOne($idBank);

    //      return $this->render_template('admin/master/registrasi/detail', ['detail' => $detail]);

    // }

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
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah memperbaharui Data client pada tanggal " . date('d M Y H:i:s');
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
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menghapus Data client pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete, $idUser);

        return new RedirectResponse('/registrasi');
    }
}
