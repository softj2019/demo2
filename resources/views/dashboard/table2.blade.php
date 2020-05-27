<?php

use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

$data = DB::table('kgdata')
->join('kgloc','kgdata.plant','=','kgloc.key1_cd')
->select('PR_NUM',DB::raw('substr(probj, 1, 25)'),DB::raw('substr(break_nm, 1, 25)'),'kgloc.key1_nm','kgloc.key2_nm')
->where('break_nm','<>','')
->orderBy('PR_NUM', 'desc')
->take(10)->get()->toArray();
// dd($data);

$headers = ['통지번호', '내역', '현상내역', '플랜트', '위치'];
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

