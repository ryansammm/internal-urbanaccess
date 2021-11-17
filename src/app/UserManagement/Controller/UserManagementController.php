<?php

namespace App\UserManagement\Controller;

use App\Chronology\Model\Chronology;
use App\Roles\Model\Roles;
use App\UserManagement\Model\UserManagement;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class UserManagementController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new UserManagement();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll();

        return $this->render_template('admin/master/user-management/index', ['datas' => $datas]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $role = new Roles();
        $data_role = $role->selectAll("WHERE idRole != 'admin-010'");

        return $this->render_template('admin/master/user-management/create', ['roles' => $data_role]);
    }

    public function detail(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $datas = $this->model->selectOne($id);
        // dd($datas);


        return $this->render_template('admin/master/user-management/detail', ['datas' => $datas]);
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();

        $pass1 = $datas['password'];
        $pass2 = $datas['konfirmasiPassowrd'];

        if ($pass1 == $pass2) {
            $create_user_management = $this->model->create($datas);
        } else {
            return new RedirectResponse("/user-management/create");
            die();
        }

        // dd($pass1, $pass2);
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menambah Data User Management pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $create_user_management , $idUser);


        return new RedirectResponse('/user-management');
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
        $detail = $this->model->selectOne($id);
        // dd($detail);

        $roles = new Roles();
        $data_roles = $roles->selectAll("WHERE idRole = '" . $detail['idRole'] . "'");
        // dd($data_roles);



        return $this->render_template('admin/master/user-management/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $datas = $request->request->all();
        $update = $this->model->update($id, $datas);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah mengubah Data User Management pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update , $idUser);

        return new RedirectResponse('/vendor');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $delete = $this->model->delete($id);

        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama." telah menghapus Data User Management pada tanggal ".date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete , $idUser);

        return new RedirectResponse('/user-management');
    }
}
