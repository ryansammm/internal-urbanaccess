<?php

namespace App\Kecamatan\Controller;

use App\Chronology\Model\Chronology;
use App\Kabupaten\Model\Kabupaten;
use App\Kecamatan\Model\Kecamatan;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class KecamatanController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Kecamatan();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/kecamatan/index', ['datas' => $datas]); 
    }

    public function create(Request $request)
    {
        $kabupaten = new Kabupaten();
        $data_kabupaten = $kabupaten->selectAll();
       
       return $this->render_template('admin/master/kabupaten/create', ['kabupaten' => $data_kabupaten]);
    }

    public function store(Request $request)
    {
        $create = $this->model->create($request->request);

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
        $kabupaten = new Kabupaten();
        $data_kabupaten = $kabupaten->selectAll();

        return $this->render_template('admin/master/kabupaten/edit', ['detail' => $detail, 'kabupaten' => $data_kabupaten]);
    }

    public function update(Request $request)
    {
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);

        return new RedirectResponse('/kabupaten');
    }

    public function delete(Request $request)
    {
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        return new RedirectResponse('/kabupaten');
    }
}
