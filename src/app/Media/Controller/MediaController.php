<?php

namespace App\Media\Controller;

use App\Media\Model\Media;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class MediaController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Media();
    }

    public function index(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll();
        return $this->render_template('media/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('media/create');
    }
    public function store(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $pathMedia = $request->request->get('pathMedia');
        $idRelation = $request->request->get('idRelation');
        $idEntity = $request->request->get('idEntity');
        $dateCreate = date("Y-m-d");

        $data_test = array(
            'pathMedia' => $pathMedia,
            'idRelation' => $idRelation,
            'idEntity' => $idEntity,
            'dateCreate' => $dateCreate
        );


        // $this->model->create($data_test);

        return header("location:http://kesbangpol.com/media");
    }
    public function ReadOne(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);


        return $this->render_template('media/edit', ['idMedia' => $datas['idMedia'], 'pathMedia' => $datas['pathMedia'], 'idEntity' => $datas['idEntity'], 'idRelation' => $datas['idRelation']]);
    }
    public function update(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->request->get('id');
        $pathMedia = $request->request->get('pathMedia');
        $idEntity = $request->request->get('idEntity');
        $idRelation = $request->request->get('idRelation');


        $id = $request->attributes->get('id');
        $data_test = array(
            'pathMedia' => $pathMedia,
            'idEntity' => $idEntity,
            'idRelation' => $idRelation
            // 'approvalGallery'=> $approvalGallery
        );

        $this->model->update($id, $data_test);

        return header("location:http://kesbangpol.com/media");
    }
    public function delete(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $this->model->delete($id);


        return header("location:http://kesbangpol.com/media");
    }
}
