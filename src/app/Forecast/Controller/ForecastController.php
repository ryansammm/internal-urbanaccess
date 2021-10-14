<?php

namespace App\Forecast\Controller;

use App\Forecast\Model\Forecast;
use App\Minat\Model\Minat;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ForecastController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Forecast();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll();

        $minat = new Minat();
        $data_minat = $minat->selectAll();
        // dd($data_minat);

        foreach ($data_minat as $key => $value) {

            if ($value['tercover'] == '1' || $value['tercover'] == NULL) {
                if ($value['status'] == '1') {
                    $data_minat[$key]['statusText'] = 'Prospek';
                } else if ($value['status'] == '2') {
                    $data_minat[$key]['statusText'] = 'Prospek';
                } else if ($value['status'] == '3') {
                    $data_minat[$key]['statusText'] = 'Prospek';
                } else if ($value['status'] == '4') {
                    $data_minat[$key]['statusText'] = 'Prospek';
                } else if ($value['status'] == '5') {
                    $data_minat[$key]['statusText'] = 'Prospek';
                } else if ($value['status'] == '6') {
                    $data_minat[$key]['statusText'] = 'Prospek';
                } else if ($value['status'] == '7') {
                    $data_minat[$key]['statusText'] = 'Closing';
                } else if ($value['status'] == '8') {
                    $data_minat[$key]['statusText'] = 'Prospek';
                } else if ($value['status'] == '9') {
                    $data_minat[$key]['statusText'] = 'Closing';
                } else if ($value['status'] == '10') {
                    $data_minat[$key]['statusText'] = 'Cancel';
                }
            } else {
                $data_minat[$key]['statusText'] = 'Cancel';
            }
        }

        return $this->render_template('admin/master/forecast/index', ['datas' => $datas, 'data_minat' => $data_minat]);
    }



    public function create(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/forecast/create');
    }

    public function store(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $create = $this->model->create($request->request);

        return new RedirectResponse('/forecast');
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

        return $this->render_template('admin/master/forecaste/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $update = $this->model->update($id, $request->request);

        return new RedirectResponse('/forecast');
    }

    public function delete(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        return new RedirectResponse('/forecast');
    }
}
