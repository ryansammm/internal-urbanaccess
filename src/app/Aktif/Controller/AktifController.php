<?php

namespace App\Aktif\Controller;

use App\Chronology\Model\Chronology;
use App\Aktif\Model\Aktif;
use App\Aktivasi\Model\Aktivasi;
use App\InternetUserAlamat\Model\InternetUserAlamat;
use App\InternetUserLayanan\Model\InternetUserLayanan;
use App\LayananInternet\Model\LayananInternet;
use App\RegistrasiUser\Model\InternetUserRegistrasi;
use App\Roles\Model\Roles;
use App\UserManagement\Model\UserManagement;
use App\Users\Model\Users;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AktifController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Aktif();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }

        $datas = $this->model->selectAll();

        $internet_user_registrasi = new InternetUserRegistrasi();
        $data_internet_user_registrasi = $internet_user_registrasi->selectAll("WHERE statusRegistrasi = 3 AND jenisAlamat = 'pemasangan' ");
        // dd($data_internet_user_registrasi);

        return $this->render_template('admin/master/aktif/index', ['datas' => $datas, 'data_internet_user_registrasi' => $data_internet_user_registrasi]);
    }

    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');

        $data_layanan = new LayananInternet();
        $layanan = $data_layanan->selectAll();

        $internet_user_layanan = new InternetUserLayanan();
        $data_internet_user_layanan = $internet_user_layanan->selectOne($id);


        return $this->render_template('admin/master/aktivasi/create', ['id' => $id, 'layanan' => $layanan, 'data_internet_user_layanan' => $data_internet_user_layanan]);
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

        /* ------------------------------- Ubah Status ------------------------------ */
        $status = '4';
        $internet_user_registrasi_status = $internet_user_registrasi->statusRegistrasi($id, $status);
        /* -------------------------------------------------------------------------- */


        /* --------------------------- Tambah Data Billing -------------------------- */
        $aktif_create = $this->model->create($datas, $id);
        /* -------------------------------------------------------------------------- */


        /* --------------------------------- Telebot -------------------------------- */
        $user_registrasi = new InternetUserRegistrasi();
        $user_registrasi_data = $user_registrasi->selectOne($id);
        $user_alamat = new InternetUserAlamat();
        $user_alamat_data = $user_alamat->selectOne("WHERE noRegistrasi ='" . $id . "' AND jenisAlamat = 'pemasangan'");
        $user = new Users();
        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));

        $message = "Data Billing atas nama <b>" . $user_registrasi_data['namauserRegistrasi'] . "</b> dengan alamat <b>" . $user_alamat_data['alamat'] . " RT." . $user_alamat_data['rt'] . "/RW." . $user_alamat_data['rt'] . " Kel." . $user_alamat_data['nameKelurahan'] . " Kec." . $user_alamat_data['nameKecamatan'] . " Kab." . $user_alamat_data['nameKabupaten'] . "</b> telah melakukan pembayaran pada tanggal <b>" .  date('d F Y', strtotime($datas['tanggalPembayaran'])) . "</b> dengan jumlah pembayaran  <b>Rp." . $datas['jumlahPembayaran'] . ",-</b>.";

        $kirim = $user->telegram($message, $ambilUser['chatId']);
        /* -------------------------------------------------------------------------- */
        // dd($kirim);

        /* -------------------------------- Kronologi ------------------------------- */
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = "<b>" . $nama . "</b> telah melakukan pembayaran pada menu Start Billing atas nama <b>" . $internet_user_registrasi_data['namauserRegistrasi'] . "</b> pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $aktif_create, $idUser);
        /* -------------------------------------------------------------------------- */


        return new RedirectResponse('/aktif');
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
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah memperbaharui data Billing pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $update, $idUser);


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
        // buat log aktivitas
        $nama = $request->getSession()->get('namaUser');
        $idUser = $request->getSession()->get('idUser');
        $chronology = new Chronology();
        $deskripsi = $nama . " telah menghapus aktif pada tanggal " . date('d M Y H:i:s');
        $data_chronology = $chronology->create($deskripsi, $delete, $idUser);



        return new RedirectResponse('/user-management');
    }
}
