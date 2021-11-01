<?php

namespace App\Aktivasi\Controller;

use App\Aktivasi\Model\Aktivasi;
use App\InternetUserLayanan\Model\InternetUserLayanan;
use App\LayananInternet\Model\LayananInternet;
use App\LayananInternetDetail\Model\LayananInternetDetail;
use App\Media\Model\Media;
use App\RegistrasiUser\Model\InternetUserRegistrasi;
use App\Roles\Model\Roles;
use App\UserManagement\Model\UserManagement;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AktivasiController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Aktivasi();
        parent::beginSession();
    }

    public function index(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll();

        $internet_user_registrasi = new InternetUserRegistrasi();
        $data_internet_user_registrasi = $internet_user_registrasi->selectAll("WHERE statusRegistrasi = 2");
        // dd($data_internet_user_registrasi);

        return $this->render_template('admin/master/aktivasi/index', ['datas' => $datas, 'data_internet_user_registrasi' => $data_internet_user_registrasi]);
    }

    public function create(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);

        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();

        $internet_user_layanan = new InternetUserLayanan();
        $data_internet_user_layanan = $internet_user_layanan->selectOne($id);

        return $this->render_template('admin/master/aktivasi/create', ['id' => $id, 'layanan' => $layanan, 'data_internet_user_layanan' => $data_internet_user_layanan, 'layanan_detail' => $layanan_detail]);
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
        // dd($datas);
        $id = $request->attributes->get('id');
        // dd($id);

        $internet_user_registrasi = new InternetUserRegistrasi();
        $status = '3';
        $internet_user_registrasi_status = $internet_user_registrasi->statusRegistrasi($id, $status);

        $aktivasi_create = $this->model->create($datas, $datas['nomorRegistrasi']);


        return new RedirectResponse('/aktivasi/dokumentasi/' . $id);
    }

    public function dokumentasi(Request $request)
    {
        if ($this->session->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);

        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();
        $data_layanan_detail = new LayananInternetDetail();
        $layanan_detail = $data_layanan_detail->selectAll();

        $internet_user_layanan = new InternetUserLayanan();
        $data_internet_user_layanan = $internet_user_layanan->selectOne($id);

        return $this->render_template('admin/master/aktivasi/dokumentasi', ['id' => $id, 'layanan' => $layanan, 'data_internet_user_layanan' => $data_internet_user_layanan, 'layanan_detail' => $layanan_detail]);
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
        $media->create($_FILES['file'], $id, '1', 'dokumentasi-aktivasi');


        return new JsonResponse([]);
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
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $datas = $request->request->all();
        $update = $this->model->update($id, $datas);


        return new RedirectResponse('/vendor');
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
}
