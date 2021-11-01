<?php

namespace App\Instalasi\Controller;

use App\Instalasi\Model\Instalasi;
use App\Media\Model\Media;
use App\RegistrasiUser\Model\InternetUserRegistrasi;
use App\Roles\Model\Roles;
use App\UserManagement\Model\UserManagement;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class InstalasiController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Instalasi();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll();
        // dd($datas);

        $internet_user_registrasi = new InternetUserRegistrasi();
        $data_internet_user_registrasi = $internet_user_registrasi->selectAll("WHERE statusRegistrasi = ''");
        // dd($data_internet_user_registrasi);


        return $this->render_template('admin/master/instalasi/index', ['datas' => $datas, 'data_internet_user_registrasi' => $data_internet_user_registrasi]);
    }

    public function create(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }




        return $this->render_template('admin/master/instalasi/create', []);
    }

    public function detail(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);
        // dd($datas);


        return $this->render_template('admin/master/user-management/detail', ['datas' => $datas]);
    }

    public function store(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();
        $id = $request->attributes->get('id');
        // dd($datas, $id);


        $internet_user_registrasi = new InternetUserRegistrasi();
        // $status = '2';
        // $internet_user_registrasi_status = $internet_user_registrasi->statusRegistrasi($id, $status);
        // dd($internet_user_registrasi_status);


        $instalasi_create = $this->model->create($datas, $id);


        return new RedirectResponse('/instalasi');
    }


    public function status(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();
        $id = $request->attributes->get('id');

        $internet_user_registrasi = new InternetUserRegistrasi();
        $status = '2';
        $internet_user_registrasi_status = $internet_user_registrasi->statusRegistrasi($id, $status);

        return new RedirectResponse('/instalasi');
    }

    public function get(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');

        $data_instalasi = $this->model->selectOne("WHERE noRegistrasi = '" . $id . "'");
        // $data_survey['biayaInstalasi'] =  number_format($data_survey['biayaInstalasi'], 0, "", ".");
        // dd($data_survey);


        $data_instalasi['tglInstalasi'] = date('d-m-Y', strtotime($data_instalasi['tglInstalasi']));
        // dd($data_survey);

        return new JsonResponse($data_instalasi);
    }

    public function edit(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        // dd($detail);

        $roles = new Roles();
        $data_roles = $roles->selectAll("WHERE idRole = '" . $detail['idRole'] . "'");
        // dd($data_roles);



        return $this->render_template('admin/master/user-management/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $request->request->all();
        $id = $request->attributes->get('id');
        // dd($datas, $id);


        $instalasi_create = $this->model->update($datas, $id);

        return new RedirectResponse('/instalasi');
    }

    public function delete(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $delete = $this->model->delete($id);



        return new RedirectResponse('/user-management');
    }

    public function dokumentasiStore(Request $request)
    {
        // if ($this->session->get('username') == null) {
        //     return new RedirectResponse("/admin");
        // }
        $datas = $request->request->all();
        // dd($_FILES);
        $id = $request->attributes->get('id');
        // dd($id);

        $media = new Media();
        $media->create($_FILES['file'], $id, '1', 'dokumentasi-instalasi');


        return new JsonResponse([]);
    }

    public function dokumentasi(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);


        return $this->render_template('admin/master/instalasi/dokumentasi', ['id' => $id]);
    }
}
