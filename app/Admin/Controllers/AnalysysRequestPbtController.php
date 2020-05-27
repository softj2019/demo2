<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Illuminate\Support\Facades\DB;

// $grid->filter(function($filter){
//     $filter->expand();
//     $filter->disableIdFilter();
//     $filter->column(1/3, function ($filter){
//         $a = DB::table('kgloc')->pluck('key1_NM')->toArray();
//         $a = array_combine($a, $a);
//         $filter->in('key1_NM','플랜트')
//         ->multipleSelect($a);
//         $b = DB::table('kgloc')->pluck('key2_NM')->toArray();
//         $b = array_combine($b, $b);
//         $filter->in('key2_NM','위치')
//         ->multipleSelect($b);
//     });
//     $filter->column(1/3, function ($filter){
//         $c = DB::table('kgpbt')->pluck('key3_NM')->toArray();
//         $c = array_combine($c, $c);
//         $filter->in('key3_NM','1차분류')
//         ->Select($c);
//         $d = DB::table('kgpbt')->pluck('key3_1_NM')->toArray();
//         $d = array_combine($d, $d);
//         $filter->in('key3_1_NM','1차분류추가')
//         ->multipleSelect($d);
//     });
//     $filter->column(1/3, function ($filter){
//         $e = DB::table('kgpbt')->pluck('key4_NM')->toArray();
//         $e = array_combine($e, $e);
//         $filter->in('key4_NM','2차분류')
//         ->multipleSelect($e);
//         $f = DB::table('kgpbt')->pluck('key5_NM')->toArray();
//         $f = array_combine($f, $f);
//         $filter->in('key5_NM','3차분류')
//         ->multipleSelect($f);
//         $g = DB::table('kgpbt')->pluck('key6_NM')->toArray();
//         $g = array_combine($g, $g);
//         $filter->in('key6_NM','4차분류')
//         ->multipleSelect($g);
//     });
// });

class AnalysysRequestPbtController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('신뢰도 분석')
            ->description('생산설비')
            ->row(function (Row $row) {
            $row->column(4, function (Column $column) {
                $column->append('<select id="sel_id" multiple="multiple">

                <option value="1" selected>1</option>
                
                <option value="2">2</option>
                
                </select>');
            });
        });
    }
}
