<?php

namespace App\KonfirmasiHasilSurvey\Controller;

use App\KonfirmasiHasilSurvey\Model\KonfirmasiHasilSurvey;
use App\LayananInternetDetail\Model\LayananInternetDetail;
use App\Minat\Model\Minat;
use App\MinatLayanan\Model\MinatLayanan;
use App\Users\Model\Users;
use App\Vendor\Model\Vendor;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class KonfirmasiHasilSurveyController extends GlobalFunc
{
    public $model;

    public function __construct()

    {
        $this->model = new KonfirmasiHasilSurvey();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $datas = $this->model->selectAll("WHERE minat.status = 3");


        // dd($datas);

        $vendor = new Vendor();
        $data_vendor = $vendor->selectAll();

        $layanan_internet_detail = new LayananInternetDetail();
        $data_layanan_internet_detail = $layanan_internet_detail->selectAll();
        // dd($data_layanan_internet_detail);

        return $this->render_template('admin/master/konfirmasi-hasil-survey/index', ['datas' => $datas,  'data_vendor' => $data_vendor, 'data_layanan_internet_detail' => $data_layanan_internet_detail]);
    }



    public function create(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        return $this->render_template('admin/master/reseller/create');
    }

    public function store(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $create = $this->model->create($request->request);

        return new RedirectResponse('/reseller');
    }

    public function get(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $data = $this->model->selectOne($id);




        // dd($data);
        return new JsonResponse($data);
    }

    public function edit(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $detail = $this->model->selectOne($id);

        return $this->render_template('admin/master/reseller/edit', ['detail' => $detail]);
    }

    public function update(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $minat = new Minat();
        $user = new Users();
        $vendor = new Vendor();

        $id = $request->attributes->get('id');
        $data_vendor = $this->model->selectOne("WHERE id = '" . $id . "'");

        // $select_vendor = $this->model->selectOne("WHERE kodeMinat = 'lkmwdlkkm' AND status IS NULL");
        $select_vendor = $this->model->selectOne("WHERE kodeMinat = '" . $data_vendor['kodeMinat'] . "' AND status IS NULL");
        $data_minat = $minat->selectOne($data_vendor['kodeMinat']);
        $data_vendor_detail = $vendor->selectOne($data_vendor['idVendor']);
        // dd($data_minat);
        // $data_vendor['kodeMinat'] 

        $dipilih = '1';
        $vendor_status_dipilih = $this->model->updateStatus($id, $dipilih);

        $tidak_dipilih = '2';
        $vendor_status_tidak_dipilih = $this->model->updateStatus($select_vendor['id'], $tidak_dipilih);
        // dd($vendor_status_dipilih, $vendor_status_tidak_dipilih);

        $status = '4';

        $minat_status = $minat->updateStatusMinat($data_vendor['kodeMinat'], $status);
        // dd($minat_status);


        $ambilUser = $user->selectOneUser($request->getSession()->get('idUser'));
        $message = "Hasil survey dari vendor <b>" . $data_vendor_detail['namaVendor'] . "</b> atas nama <b>" . $data_minat['namapemohon'] . "</b> telah dikonfirmasi.";
        // dd($message);
        $kirim = $user->telegram($message, $ambilUser['chatId']);


        return new RedirectResponse('/konfirmasi-hasil-survey');
    }

    public function delete(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $id = $request->attributes->get('id');
        $delete = $this->model->delete($id);

        return new RedirectResponse('/reseller');
    }
}
