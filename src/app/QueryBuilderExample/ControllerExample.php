<?php

namespace App\QueryBuilderExample;

class ControllerExample
{
    public function index()
    {
        $model = new ModelExample;

        // basic query get all data
        $data = $model->select('id', 'name')
            ->where('id', '=', 1)
            ->get();

        // advanced query get all data with pagination and querystring
        $datas = $this->model
            ->select('penelitianNarsum.idPenelitiannarsum', 'penelitianNarsum.namaNarsum', 'penelitianNarsum.fotopribadiNarsum', 'penelitianNarsum.tokohNarsum', 'tagPenelitian.idRelation')
            ->join('LEFT', 'tagPenelitian', 'tagPenelitian.idRelation', '=', 'penelitianNarsum.idPenelitiannarsum')
            ->where('penelitianNarsum.statusHapus', '1')
            ->where('penelitianNarsum.status', '2')
            ->where(function ($query) use ($search, $jenis_penelitian_pelaku_budaya) {
                $query->where(function ($query) use ($search, $jenis_penelitian_pelaku_budaya) {
                    $query->where('tagPenelitian.jenisPenelitian', $jenis_penelitian_pelaku_budaya)
                        ->where('tagPenelitian.tag', 'ILIKE', '%' . $search . '%');
                })->orWhere(function ($query) use ($search) {
                    $query->where('penelitianNarsum.namaNarsum', 'ILIKE', '%' . $search . '%')
                        ->orWhere('penelitianNarsum.namalengkapNarsum', 'ILIKE', '%' . $search . '%');
                });
            })
            ->groupBy('penelitianNarsum.idPenelitiannarsum', 'tagPenelitian.idRelation')
            ->paginate($result_per_page)
            ->appends(['keywords' => $search]);
    }
}
