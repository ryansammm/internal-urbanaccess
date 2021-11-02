<?php

namespace App\MinatStatus\Controller;

use App\Chronology\Model\Chronology;
use App\GroupKontak\Model\GroupKontak;
use App\HargaItem\Model\HargaItem;
use App\InternetUserAlamat\Model\InternetUserAlamat;
use App\Kontak\Model\Kontak;
use App\LayananInternet\Model\LayananInternet;
use App\LayananInternetDetail\Model\LayananInternetDetail;
use App\Media\Model\Media;
use App\Minat\Model\Minat;
use App\MinatLayanan\Model\MinatLayanan;
use App\Provinsi\Model\Provinsi;
use App\Reseller\Model\Reseller;
use App\Sales\Model\Sales;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class MinatStatusController extends GlobalFunc
{
    public $model;

    public function __construct()
    {
        $this->model = new Minat();
    }

    public function index(Request $request)
    {
        if ($request->getSession()->get('username') == null) {
            return new RedirectResponse("/admin");
        }
        $status = $request->attributes->get('status');
        $datas = $this->model->selectAll("WHERE status = '" . $status . "'");
        $count1 = $this->model->selectAllCount("WHERE status = '1' ")['count'];
        $count2 = $this->model->selectAllCount("WHERE status = '2' ")['count'];
        $count3 = $this->model->selectAllCount("WHERE status = '3' ")['count'];
        $count4 = $this->model->selectAllCount("WHERE status = '4' ")['count'];
        $count5 = $this->model->selectAllCount("WHERE status = '5' ")['count'];
        $count6 = $this->model->selectAllCount("WHERE status = '6' ")['count'];
        $count7 = $this->model->selectAllCount("WHERE status = '7' ")['count'];
        $count8 = $this->model->selectAllCount("WHERE status = '8' ")['count'];
        // dd($count);

        // dd($datas);


        foreach ($datas as $key => $value) {
            if ($value['status'] == '1') {
                $datas[$key]['statusText'] = 'Minat';
            } else if ($value['status'] == '2') {
                $datas[$key]['statusText'] = 'Request Survey (Soft)';
            } else if ($value['status'] == '3') {
                $datas[$key]['statusText'] = 'Konfirmasi Request Survey (Soft)';
            } else if ($value['status'] == '4') {
                $datas[$key]['statusText'] = 'Lanjut Survey Onsite';
            } else if ($value['status'] == '5') {
                $datas[$key]['statusText'] = 'Survey Onsite';
            } else if ($value['status'] == '6') {
                $datas[$key]['statusText'] = 'Konfirmasi Survey Onsite';
            } else if ($value['status'] == '7') {
                $datas[$key]['statusText'] = 'Hasil Survey Onsite';
            } else if ($value['status'] == '8') {
                $datas[$key]['statusText'] = 'Prospek';
            } else if ($value['status'] == '9') {
                $datas[$key]['statusText'] = 'User';
            }

            if ($value['tercover'] == '1') {
                $datas[$key]['tercoverText'] = 'Tercover';
            } else if ($value['tercover'] == '2') {
                $datas[$key]['tercoverText'] = 'Tidak Tercover';
            }
        }

        $judul = '';
        if ($status == '1') {
            $judul = 'Minat';
        } elseif ($status == '2') {
            $judul = 'Menunggu Hasil Survey (Soft)';
        } elseif ($status == '3') {
            $judul = 'Konfirmasi Peminat (Soft)';
        } elseif ($status == '4') {
            $judul = 'Lanjut Onsite';
        } elseif ($status == '5') {
            $judul = 'Konfirmasi Peminat (Onsite)';
        } elseif ($status == '6') {
            $judul = 'Manunggu Hasil Survey (Onsite)';
        } elseif ($status == '7') {
            $judul = 'Hasil';
        } elseif ($status == '8') {
            $judul = 'FAB';
        }




        return $this->render_template('admin/master/list-minat-perstatus/index', ['datas' => $datas, 'count1' => $count1, 'count2' => $count2, 'count3' => $count3, 'count4' => $count4, 'count5' => $count5, 'count6' => $count6, 'count7' => $count7, 'count8' => $count8, 'judul' => $judul, 'status' => $status]);
    }
}
