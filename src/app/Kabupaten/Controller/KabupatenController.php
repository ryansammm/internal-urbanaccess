<?php

namespace App\Kabupaten\Controller;

use App\Chronology\Model\Chronology;
use App\Kabupaten\Model\Kabupaten;
use App\Provinsi\Model\Provinsi;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class KabupatenController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Kabupaten();
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/kabupaten/index', ['datas' => $datas]); 
    }

    public function create(Request $request)
    {
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

       
       return $this->render_template('admin/master/kabupaten/create', ['provinsi' => $data_provinsi]);
    }

    public function store(Request $request)
    {
        $create = $this->model->create($request->request);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menambahkan kabupaten  pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create, $idUser);

        return new RedirectResponse('/kabupaten');
    }

    public function get(Request $request)
    {
        $foreign_key = $request->attributes->get('id');
        $data = $this->model->get($foreign_key);

        return new JsonResponse($data);
    }

    public function edit(Request $request)
    {
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $provinsi = new Provinsi();
        $data_provinsi = $provinsi->selectAll();

        return $this->render_template('admin/master/kabupaten/edit', ['detail' => $detail, 'provinsi' => $data_provinsi]);   
    }

    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah memperbaharui kabupaten  pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update, $idUser);

        return new RedirectResponse('/kabupaten');
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menghapus kabupaten  pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete, $idUser);

        return new RedirectResponse('/kabupaten');
    }
}
