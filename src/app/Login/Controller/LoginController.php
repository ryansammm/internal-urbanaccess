<?php

namespace App\Login\Controller;

use App\Login\Model\Login;
use Config\AppPermissions;
use Config\RolePermissions;
use Core\GlobalFunc;
use PDOException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class LoginController extends GlobalFunc
{
    public $conn;
    public $model;

    public function __construct()
    {
        $this->model = new Login();
        $globalFunc = new GlobalFunc();
        $this->conn = $globalFunc->conn;
    }

    public function index(Request $request)
    {
        // if ($request->getSession()->get('username') != null) {
        //     return new RedirectResponse("/minat");
        // }

        $errors = $request->getSession()->getFlashBag()->get('errors', []);  //parameter kedua untuk default value
        return $this->render_template('admin/master/index', ['errors' => $errors]); // parameter pertama key, paramater kedua value
    }

    public function login(Request $request)
    {

        $id_role = $request->request->get('idRole');
        $username = $request->request->get('username');
        $password = $request->request->get('password');
        try {
            $sql = "SELECT * FROM users LEFT JOIN roles ON roles.idRole = users.idRole WHERE username = '$username' ";
            // dd($sql);

            $query = $this->conn->prepare($sql);
            $query->execute();
            $data = $query->fetch();

            if ($data != false) {

                if (password_verify($password, $data['password'])) {

                    $request->getSession()->set('idUser', $data['idUser']);
                    $request->getSession()->set('idRole', $data['idRole']);
                    $request->getSession()->set('aliasRole', $data['aliasRole']);
                    $request->getSession()->set('namaUser', $data['namaUser']);
                    $request->getSession()->set('username', $data['username']);
                    $request->getSession()->set('namaRole', $data['namaRole']);
                    $_SESSION['idRole'] = $data['idRole'];

                    $role_permissions = new RolePermissions();
                    $data_role_permissions = $role_permissions->getRolePermissions($data['idRole']);
                    $app_permissions = new AppPermissions();
                    $data_app_permission = $app_permissions->getOnePermission($data_role_permissions[0]);
                    $urlTujuan = $data['aliasRole'] == 'admin' ? '/minat' : $data_app_permission['url'];

                    return header("Location: ".$urlTujuan);
                } else {

                    $request->getSession()->getFlashBag()->add('errors', 'Password salah!');

                    return header("Location: /admin");
                }
            } else {

                $request->getSession()->getFlashBag()->add('errors', 'Akun tidak ditemukan!');

                return header("Location: /admin");
            }
        } catch (PDOException $e) {

            echo $e->getMessage();
        }
    }

    public function logout(Request $request)
    {
        $request->getSession()->invalidate();
        return header("Location: /admin");
    }
}
