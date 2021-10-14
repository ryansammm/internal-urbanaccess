<?php

namespace App\Provinsi\Controller;

use App\Chronology\Model\Chronology;
use App\Provinsi\Model\Provinsi;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class ProvinsiController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Provinsi();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/provinsi/index', ['datas' => $datas]); 
    }
      public function create(Request $request)
    {
        return $this->render_template('admin/master/provinsi/create'); 
    }

    public function store(Request $request)
    {
        $create = $this->model->create($request->request);

        return new RedirectResponse('/provinsi');
    }

    public function get(Request $request)
    {
        $id = $request->attributes->get('id');
        $data = $this->model->selectOne($id);

        return new JsonResponse($data);
    }

    public function edit(Request $request)
    {
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);

        return $this->render_template('admin/master/provinsi/edit', ['detail' => $detail]);   
    }

    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);

        return new RedirectResponse('/provinsi');
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        return new RedirectResponse('/provinsi');
    }
}
