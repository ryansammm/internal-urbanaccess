<?php

namespace App\Instalasi\Controller;

use App\Chronology\Model\Chronology;
use App\Instalasi\Model\Instalasi;
use App\InternetUserAlamat\Model\InternetUserAlamat;
use App\InternetUserVendor\Model\InternetUserVendor;
use App\Media\Model\Media;
use App\RegistrasiUser\Model\InternetUserRegistrasi;
use App\Roles\Model\Roles;
use App\UserManagement\Model\UserManagement;
use App\Users\Model\Users;
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
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll();

        $internet_user_registrasi = new InternetUserRegistrasi();
        $data_internet_user_registrasi = $internet_user_registrasi->selectAllJoin("LEFT JOIN instalasi ON instalasi.noRegistrasi = internetuserregistrasi.noRegistrasi WHERE statusRegistrasi = '' AND jenisAlamat = 'pemasangan' ");
        // dd($data_internet_user_registrasi);


        return $this->render_template('admin/master/instalasi/index', ['datas' => $datas, 'data_internet_user_registrasi' => $data_internet_user_registrasi]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }




        return $this->render_template('admin/master/instalasi/create', []);
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
        $id = $request->attributes->get('id');


        $internet_user_registrasi = new InternetUserRegistrasi();
        $internet_user_registrasi_data = $internet_user_registrasi->selectOneWHere("WHERE noRegistrasi = '" . $id . "'");
        // dd($internet_user_registrasi_data['namauserRegistrasi']);


        // $status = '2';
        // $internet_user_registrasi_status = $internet_user_registrasi->statusRegistrasi($id, $status);
        // dd($internet_user_registrasi_status);


        $instalasi_create = $this->model->create($datas, $id);


        /* --------------------------------- Telebot -------------------------------- */
        $user_registrasi = new InternetUserRegistrasi();
        $user_registrasi_data = $user_registrasi->selectOne($id);
        $user_alamat = new InternetUserAlamat();
        $user_alamat_data = $user_alamat->selectOne("WHERE noRegistrasi ='" . $id . "' AND jenisAlamat = 'pemasangan'");
        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Instalasi pada <b>" .  date('d F Y', strtotime($datas['tglInstalasi'])) . "</b> atas nama <b>" . $user_registrasi_data['namauserRegistrasi'] . "</b> dengan jarak <b>" . $datas['jarak'] . "m</b> pada alamat <b>" . $user_alamat_data['alamat'] . " RT." . $user_alamat_data['rt'] . "/RW." . $user_alamat_data['rt'] . " Kel." . $user_alamat_data['nameKelurahan'] . " Kec." . $user_alamat_data['nameKecamatan'] . " Kab." . $user_alamat_data['nameKabupaten'] . "</b> telah terjadwal.";
        $kirim = $user->telegram($message, $ambilUser['chatId']);
        /* -------------------------------------------------------------------------- */


        /* -------------------------------- Kronologi ------------------------------- */
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah menambahkan data hasil Instalasi pada menu Instalasi atas nama <b>" . $internet_user_registrasi_data['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $instalasi_create, $idUser);
        /* -------------------------------------------------------------------------- */


        return new RedirectResponse('/instalasi');
    }


    public function status(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $request->request->all();
        $id = $request->attributes->get('id');

        $internet_user_registrasi = new InternetUserRegistrasi();
        $internet_user_registrasi_data = $internet_user_registrasi->selectOneWHere("WHERE noRegistrasi = '" . $id . "'");

        $status = '2';
        $internet_user_registrasi_status = $internet_user_registrasi->statusRegistrasi($id, $status);


        $instalasi = new Instalasi();
        $instalasi_data = $instalasi->selectOne("WHERE noRegistrasi = '" . $id . "'");
        // dd($instalasi_data);

        /* --------------------------------- Telebot -------------------------------- */
        $user_registrasi = new InternetUserRegistrasi();
        $user_registrasi_data = $user_registrasi->selectOne($id);
        $user_alamat = new InternetUserAlamat();
        $user_alamat_data = $user_alamat->selectOne("WHERE noRegistrasi ='" . $id . "' AND jenisAlamat = 'pemasangan'");
        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));

        $message = "Data Instalasi atas nama <b>" . $user_registrasi_data['namauserRegistrasi'] . "</b> dengan alamat <b>" . $user_alamat_data['alamat'] . " RT." . $user_alamat_data['rt'] . "/RW." . $user_alamat_data['rt'] . " Kel." . $user_alamat_data['nameKelurahan'] . " Kec." . $user_alamat_data['nameKecamatan'] . " Kab." . $user_alamat_data['nameKabupaten'] . "</b> pada tanggal <b>" .  date('d F Y', strtotime($instalasi_data['tglInstalasi'])) . "</b> dengan jarak  <b>" . $instalasi_data['jarak'] . "m</b> telah dikondirmasi.";

        $kirim = $user->telegram($message, $ambilUser['chatId']);
        /* -------------------------------------------------------------------------- */


        /* -------------------------------- Kronologi ------------------------------- */
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah mengkonfirmasi data hasil Instalasi pada menu Instalasi atas nama <b>" . $internet_user_registrasi_data['namauserRegistrasi'] . "</b>  pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $id, $idUser);
        /* -------------------------------------------------------------------------- */


        return new RedirectResponse('/instalasi');
    }

    public function get(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');

        $data_instalasi = $this->model->selectOne("WHERE noRegistrasi = '" . $id . "'");
        // $data_survey['biayaInstalasi'] =  number_format($data_survey['biayaInstalasi'], 0, "", ".");
        // dd($data_instalasi);


        $data_instalasi['tglInstalasiInd'] = date('d-m-Y', strtotime($data_instalasi['tglInstalasi']));
        // dd($data_instalasi);

        // $data_instalasi = [
        //     'tglKonfirmasi' =  date('d-m-Y', strtotime($data_instalasi['tglInstalasi'])),

        // ];

        // dd($data_survey);

        return new JsonResponse($data_instalasi);
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

        $datas = $request->request->all();
        $id = $request->attributes->get('id');
        // dd($datas, $id);
        $internet_user_registrasi = new InternetUserRegistrasi();
        $internet_user_registrasi_data = $internet_user_registrasi->selectOneWHere("WHERE noRegistrasi = '" . $id . "'");
        // dd($internet_user_registrasi_data['namauserRegistrasi']);

        $instalasi_create = $this->model->update($datas, $id);


        /* --------------------------------- Telebot -------------------------------- */
        $user_registrasi = new InternetUserRegistrasi();
        $user_registrasi_data = $user_registrasi->selectOne($id);
        $user_alamat = new InternetUserAlamat();
        $user_alamat_data = $user_alamat->selectOne("WHERE noRegistrasi ='" . $id . "' AND jenisAlamat = 'pemasangan'");
        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));

        $message = "Data Instalasi atas nama <b>" . $user_registrasi_data['namauserRegistrasi'] . "</b> dengan alamat <b>" . $user_alamat_data['alamat'] . " RT." . $user_alamat_data['rt'] . "/RW." . $user_alamat_data['rt'] . " Kel." . $user_alamat_data['nameKelurahan'] . " Kec." . $user_alamat_data['nameKecamatan'] . " Kab." . $user_alamat_data['nameKabupaten'] . "</b> telah diubah menjadi tanggal <b>" .  date('d F Y', strtotime($datas['tglInstalasi'])) . "</b> dengan jarak  <b>" . $datas['jarak'] . "m</b>.";

        $kirim = $user->telegram($message, $ambilUser['chatId']);
        /* -------------------------------------------------------------------------- */


        /* -------------------------------- Kronologi ------------------------------- */
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah memperbaharui data hasil Instalasi pada menu Instalasi atas nama <b>" . $internet_user_registrasi_data['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $instalasi_create, $idUser);

        return new RedirectResponse('/instalasi');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);
        $delete = $this->model->delete($id);
        $internet_user_registrasi = new InternetUserRegistrasi();
        $internet_user_registrasi_data = $internet_user_registrasi->selectOneWHere("WHERE noRegistrasi = '" . $id . "'");
        // dd($internet_user_registrasi_data['namauserRegistrasi']);

        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah menghapus data hasil instalasi pada menu Instalasi atas nama <b>" . $internet_user_registrasi_data['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete, $idUser);


        return new RedirectResponse('/user-management');
    }

    public function dokumentasiStore(Request $request)
    {
        // if ($request->getSession()->get('username') == null) {
        //     return new RedirectResponse("/admin");
        // }
        $datas = $request->request->all();
        // dd($_FILES);
        $id = $request->attributes->get('id');
        // dd($id);
        $internet_user_registrasi = new InternetUserRegistrasi();
        $internet_user_registrasi_data = $internet_user_registrasi->selectOneWHere("WHERE noRegistrasi = '" . $id . "'");
        // dd($internet_user_registrasi_data['namauserRegistrasi']);
        $media = new Media();
        $media->create($_FILES['file'], $id, '1', 'dokumentasi-instalasi');
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah menambahkan dokumentasi pada menu Instalasi atas nama <b>" . $internet_user_registrasi_data['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $id, $idUser);


        return new JsonResponse([]);
    }

    public function dokumentasi(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        // dd($id);


        return $this->render_template('admin/master/instalasi/dokumentasi', ['id' => $id]);
    }
}
