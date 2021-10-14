<?php

namespace App\DataUser\Controller;

use App\DataUser\Model\DataUser;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DataUserController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $this->model = new DataUser();
    }

    public function index(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/data-user/index', ['datas' => $datas]);
    }



    public function create(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/data-user/create');
    }

    public function store(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $create = $this->model->create($request->request);

        return new RedirectResponse('/data-user');
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

        return $this->render_template('admin/master/data-user/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);

        return new RedirectResponse('/data-user');
    }

    public function delete(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        return new RedirectResponse('/data-user');
    }
}
