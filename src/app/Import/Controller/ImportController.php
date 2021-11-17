<?php

namespace App\Import\Controller;

use App\GroupKontak\Model\GroupKontak;
use App\GroupLegalitas\Model\GroupLegalitas;
use App\GroupPIC\Model\GroupPIC;
use App\InternetUserAlamat\Model\InternetUserAlamat;
use App\InternetUserLayanan\Model\InternetUserLayanan;
use App\InternetUserVendor\Model\InternetUserVendor;
use App\Kabupaten\Model\Kabupaten;
use App\Kecamatan\Model\Kecamatan;
use App\Kelurahan\Model\Kelurahan;
use App\Kontak\Model\Kontak;
use App\LayananInternet\Model\LayananInternet;
use App\LayananInternetDetail\Model\LayananInternetDetail;
use App\Legalitas\Model\Legalitas;
use App\Media\Model\Media;
use App\PIC\Model\PIC;
use App\Provinsi\Model\Provinsi;
use App\RegistrasiUser\Model\InternetUserRegistrasi;
use App\Sales\Model\Sales;
use App\Users\Model\Users;
use Core\GlobalFunc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

class MyReadFilter implements IReadFilter
{
    public function readCell($column, $row, $worksheetName = '')
    {
        if ($row >= 5 && $row <= 5) {
            if (in_array($column, range('A', 'AF'))) {
                return true;
            }
        }
        return false;
    }
}

class ImportController extends GlobalFunc
{
    public function __construct()
    {
        
    }

    public function index(Request $request)
    {
        return $this->render_template('import');
    }

    public function prosess(Request $request)
    {
        $inputFileType = 'Xlsx';
        $inputFileName = __DIR__ . '/../../../../web/assets/file/template_data_registrasi_user_urban.xlsx';
        $sheetname = 'Sheet1';

        $Reader = new Xlsx();

        /**  Create an Instance of our Read Filter  **/
        // $filterSubset = new MyReadFilter();

        /**  Create a new Reader of the type defined in $inputFileType  **/
        $reader = IOFactory::createReader($inputFileType);
        $reader->setLoadSheetsOnly($sheetname);
        /**  Tell the Reader that we want to use the Read Filter  **/
        // $reader->setReadFilter($filterSubset);
        /**  Load only the rows and columns that match our filter to Spreadsheet  **/
        $spreadsheet = $reader->load($inputFileName);
        $excelsheet = $spreadsheet->getActiveSheet();
        $data = $excelsheet->toArray();

        $layanan_internet = new LayananInternet();
        $layanan_internet_detail = new LayananInternetDetail();
        $sales = new Sales();
        $internet_user_registrasi = new InternetUserRegistrasi();
        $users = new Users();
        $internet_user_layanan = new InternetUserLayanan();
        $idprovinsi = new Provinsi();
        $idkabupaten = new Kabupaten();
        $idkecamatan = new Kecamatan();
        $idkelurahan = new Kelurahan();
        $PIC = new PIC();
        $kontak = new Kontak();

        $group_kontak = new GroupKontak();
        $internet_user_alamat = new InternetUserAlamat();

        $group_pic = new GroupPIC();
        $group_legalitas = new GroupLegalitas();
        $media = new Media();
        $internet_user_vendor = new InternetUserVendor();

        $jenisKontakTelepon = $kontak->namaKontak("Telepon");
        $jenisKontakWhatsapp = $kontak->namaKontak("Whatsapp");
        $jenisKontakEmail = $kontak->namaKontak("Email");

        $legalitas = new Legalitas();
        $id_legalitas = $legalitas->selectOneWhere("WHERE singkatanlegalitas = 'npwp'")['idLegalitas'];
        
        // $this->dd($data, $data[3][0]);

        for ($i = 3; $i < 4; $i++) {
            $namaLayanan = $layanan_internet->namaLayanan($data[$i][0]);
            $kecepatan = $layanan_internet_detail->idLayananinternet($namaLayanan['idLayananinternet'], explode(' ', $data[$i][1])[0]);
            // dd($kecepatan);
            $namaSales = $sales->namaSales($data[$i][2]);
            // $kodeformInternetregistrasi = $internet_user_registrasi->kodeformInternetregistrasi($data[$i][3]);
            $jenisuserRegistrasi = $internet_user_registrasi->jenisuserRegistrasi($data[$i][4]);
            $provinsi = $idprovinsi->provinsi($data[$i][11]);
            $kabupaten = $idkabupaten->kabupaten($data[$i][12]);
            $kecamatan = $idkecamatan->kecamatan($data[$i][13]);
            $kelurahan = $idkelurahan->kelurahan($data[$i][14]);
            $namaPIC = $PIC->namaPIC($data[$i][20]);
            $namaVendor = $internet_user_vendor->namaVendor($data[$i][24]);
            $jenisVendor = $internet_user_vendor->jenisVendor($data[$i][25]);
            $mediakoneksiVendor = $internet_user_vendor->mediakoneksiVendor($data[$i][26]);
            // dd($namaSales);

            $internet_user_registrasi->create([
                'noRegistrasi' => $data[$i][31],
                'kodeformInternetregistrasi' => $data[$i][3],
                'tanggalRegistrasi' => date('Y-m-d', strtotime($data[$i][5])),
                'idSales' => $namaSales['nikSales'],
                'idMitra' => "",
                'idUser' =>  $data[$i][6],
                'jenisuserRegistrasi' => $jenisuserRegistrasi,
                'statusRegistrasi' => "2",
                'namauserRegistrasi' => $data[$i][3],
                'jabatanuserRegistrasi' => "",
                'namabadanRegistrasi' => "",
                'jenisusahaRegistrasi' => "",
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            $internet_user_layanan->create($data[$i][31], [
                'idLayanan' => $namaLayanan['idLayananinternet'],
                'idLayanandetail' => $kecepatan['idLayananinternetdetail'],
                'biayaregistrasiLayanan' => $data[$i][27],
                'biayabulananLayanan' => $data[$i][28],
                'biayadasarregistrasiLayanan' => $namaLayanan['biayadasarregistrasi'],
                'biayadasarbulananLayanan' => $kecepatan['biayadasarbulanan'],
                'ppnbiayaregistrasi' => $data[$i][29],
                'ppnbiayabulanan' => $data[$i][30],
                'statusLayanan' => "2",
                'mediakoneksiLayanan' => $mediakoneksiVendor,
                'ippublicLayanan' => "",
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            $users->create([
                'nikUser' => $data[$i][7],
                'namaUser' => $data[$i][8],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            // user internet kontak telepon
            $group_kontak->create([
                'idRelation' => $data[$i][31],
                'idKontak' => $jenisKontakTelepon['idKontak'],
                'isiKontak' => $data[$i][9],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            // create kontak user email
            $group_kontak->create([
                'idRelation' => $data[$i][31],
                'idKontak' => $jenisKontakEmail['idKontak'],
                'isiKontak' => $data[$i][10],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            $internet_user_alamat->create($data[$i][31], [
                'alamat' => $data[$i][19],
                'rt' => $data[$i][16],
                'rw' => $data[$i][17],
                'idProvinsi' => $provinsi['id'],
                'idKabupaten' => $kabupaten['id'],
                'idKecamatan' => $kecamatan['id'],
                'idKelurahan' => $kelurahan['id'],
                'kodepos' => $data[$i][15],
                'latitude' => explode(',', $data[$i][18])[0],
                'longtitude' => explode(',', $data[$i][18])[1],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            if ($namaPIC == false) {
                $idPIC = $PIC->create([
                    'nikPic' => "",
                    'namaPic' => $data[$i][20],
                    'tempatlahirPic' => "",
                    'tanggallahirPic' => "",
                    'statusPic' => "1",
                    'jabatanPic' => "",
                    'Y-m-d H:i:s' => "",
                    'Y-m-d H:i:s' => ""
                ]);
            } else {
                $idPIC = $namaPIC['idPic'];
            }

            // create pic internal kontak telepon
            $group_kontak->create([
                'idRelation' => $idPIC,
                'idKontak' => $jenisKontakTelepon['idKontak'],
                'isiKontak' => $data[$i][21],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            // create pic internal kontak email
            $group_kontak->create([
                'idRelation' => $idPIC,
                'idKontak' => $jenisKontakEmail['idKontak'],
                'isiKontak' => $data[$i][22],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            $group_pic->create([
                'nikPic' => $idPIC,
                'idRelation' => $data[$i][31],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            $group_legalitas->create([
                'idRelation' =>  $data[$i][31],
                'idLegalitas' => $id_legalitas,
                'isiLegalitas' => $data[$i][23],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);

            $internet_user_vendor->create($data[$i][31], [
                'namaVendor' => $data[$i][24],
                'idVendor' => $namaVendor['idVendor'],
                'jenislinkVendor' => $jenisVendor,
                'mediakoneksiVendor' => $mediakoneksiVendor,
                'biayaregistrasi' => $data[$i][27],
                'biayabulanan' => $data[$i][28],
                'ppnbiayainstalasi' => $data[$i][29],
                'ppnbiayabulanan' => $data[$i][30],
                'Y-m-d H:i:s' => "",
                'Y-m-d H:i:s' => ""
            ]);
        }

        return new RedirectResponse('/');
    }



    // for ($i = 4; $i < 5; $i++) {
    //     $dataproduk = $produk->insert([
    //         'namaItem' => $data[$i][3],
    //         'supplierItem' => $sheetname,
    //         'kuantitiItem' => 0,
    //         'hargaItem' => $data[$i][4],
    //         'hargaperpcsItem' => $data[$i][5] != 'NOT' ? $data[$i][5] : '',
    //         'tanggalmasukProduk' => '',
    //         'tanggalexpiryProduk' => ''
    //     ]);

    //     if ($data[$i][6] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Pcs",
    //             'jenisHarga' => '1',
    //             'hargaHarga' => $data[$i][6]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][6] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Kg",
    //             'jenisHarga' => '1',
    //             'hargaHarga' => $data[$i][6]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][7] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Krg",
    //             'jenisHarga' => '1',
    //             'hargaHarga' => $data[$i][7]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][7] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Dus",
    //             'jenisHarga' => '1',
    //             'hargaHarga' => $data[$i][7]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][7] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Set",
    //             'jenisHarga' => '1',
    //             'hargaHarga' => $data[$i][7]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][8] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Pcs",
    //             'jenisHarga' => '2',
    //             'hargaHarga' => $data[$i][8]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][8] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Kg",
    //             'jenisHarga' => '2',
    //             'hargaHarga' => $data[$i][8]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][9] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Krg",
    //             'jenisHarga' => '2',
    //             'hargaHarga' => $data[$i][9]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][9] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Dus",
    //             'jenisHarga' => '2',
    //             'hargaHarga' => $data[$i][9]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    //     if ($data[$i][9] != 'NOT') {
    //         $arr = [
    //             'satuanHarga' => "Set",
    //             'jenisHarga' => '2',
    //             'hargaHarga' => $data[$i][9]
    //         ];
    //         $hargaitem->insert($dataproduk, $arr);
    //     }
    // }


}
