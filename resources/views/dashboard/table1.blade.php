<?php

use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

$data = DB::table('kgart')
->leftjoin('ref1','kgart.analysis_type','=','ref1.typecode')
->leftjoin('ref2','kgart.analysis_flg','=','ref2.flgcode')
->select('created_at','AR_CD','user_id'/* ,'analysis_type','analysis_flg' */,'ref1.typename','ref2.flgname')
->orderBy('ar_cd', 'desc')
->take(11)->get()->toArray();
// dd($data);


$headers = ['요청일시','요청번호', '요청자', '요청분석', '분석여부'];
$rows = [
    $data[0],
    $data[1],
    $data[2],
    $data[3],
    $data[4],
    $data[5],
    $data[6],
    $data[7],
    $data[8],
    $data[9]
];

$table = new Table($headers, $rows);

echo $table->render();

