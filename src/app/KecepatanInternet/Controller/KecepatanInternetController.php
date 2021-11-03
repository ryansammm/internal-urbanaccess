<?php

namespace App\KecepatanInternet\Controller;

use App\Chronology\Model\Chronology;
use App\KecepatanInternet\Model\KecepatanInternet;
use App\LayananInternet\Model\LayananInternet;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class KecepatanInternetController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new KecepatanInternet();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/kecepatan-internet/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $layanan_internet = new LayananInternet();
        $data_layanan_internet = $layanan_internet->selectAll();

        return $this->render_template('admin/master/kecepatan-internet/create', ['layanan_internet' => $data_layanan_internet]);
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
        $deskripsi = $nama . " telah menambahkan data pada menu Kecepatan Iinternet pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create, $idUser);

        return new RedirectResponse('/kecepatan-internet');
    }

    public function get(Request $request)
    {
        $id = $request->attributes->get('id');
        $data = $this->model->selectAll("WHERE layananinternetdetail.idLayananinternet = '$id'");

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
        $layanan_internet = new LayananInternet();
        $data_layanan_internet = $layanan_internet->selectAll();

        return $this->render_template('admin/master/kecepatan-internet/edit', ['detail' => $detail, 'layanan_internet' => $data_layanan_internet]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah memperbaharui data pada menu Kecepatan Internet pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update, $idUser);

        return new RedirectResponse('/kecepatan-internet');
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
        $deskripsi = $nama . " telah menghapus data pada menu Kecepatan Internet pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $id, $idUser);

        return new RedirectResponse('/kecepatan-internet');
    }

    public function biayaGet(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $kecepatan = new KecepatanInternet();
        $get_kecepatan = $kecepatan->selectOne($id);

        return new JsonResponse(['data' => $get_kecepatan]);
    }
}
