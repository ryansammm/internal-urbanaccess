<?php

namespace App\Kelurahan\Controller;

use App\Chronology\Model\Chronology;
use App\Kecamatan\Model\Kecamatan;
use App\Kelurahan\Model\Kelurahan;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class KelurahanController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Kelurahan();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/kelurahan/index', ['datas' => $datas]); 
    }

    public function create(Request $request)
    {
        $kecamatan = new Kecamatan();
        $data_kecamatan = $kecamatan->selectAll();
       
       return $this->render_template('admin/master/kelurahan/create', ['kecamatan' => $data_kecamatan]);
    }

    public function store(Request $request)
    {
        $create = $this->model->create($request->request);

        return new RedirectResponse('/kelurahan');
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
        $kecamatan = new Kecamatan();
        $data_kecamatan = $kecamatan->selectAll();

        return $this->render_template('admin/master/kelurahan/edit', ['detail' => $detail, 'kecamatan' => $data_kecamatan]);
    }

    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);

        return new RedirectResponse('/kelurahan');
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        return new RedirectResponse('/kelurahan');
    }
}
