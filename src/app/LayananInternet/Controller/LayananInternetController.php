<?php

namespace App\LayananInternet\Controller;

use App\Chronology\Model\Chronology;
use App\LayananInternet\Model\LayananInternet;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class LayananInternetController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new LayananInternet();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/layanan-internet/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/layanan-internet/create');
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
        $deskripsi = $nama." telah menambah Layanan Internet pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create , $idUser);

        return new RedirectResponse('/layanan-internet');
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
        $detail = $this->model->selectOne("WHERE idLayananinternet = '" .  $id . "'");

        return $this->render_template('admin/master/layanan-internet/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah mengubah Data Layanan Internet pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update , $idUser);

        return new RedirectResponse('/layanan-internet');
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
        $deskripsi = $nama." telah menghapus Data Layanan Internet pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete , $idUser);

        return new RedirectResponse('/layanan-internet');
    }
}
