<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;


class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('대시보드')
            ->description('현황')
            // ->body('<a href "http://kogas.p-e.kr/kgart">분석요청이동</a>')
            // ->row(Dashboard::title())
            ->row(function (Row $row) {
                $table1 = view('dashboard.table1');
                $row->column(1/2, new Box('분석요청 최근 10건', $table1));
                $table2 = view('dashboard.table2');
                $row->column(1/2, new Box('현상내역있는 고장데이터 최근 10건', $table2));
            })
            // ->body('<a href "http://kogas.p-e.kr/kganal">고장통지이동</a>')
            ->row(function (Row $row) {
                $chart1 = view('dashboard.chart1');
                $row->column(1/3, new Box('최근 1년간 고장모드비율 (현상코드)', $chart1));
                $chart2 = view('dashboard.chart2');
                $row->column(1/3, new Box('최근 1년간 고장원인비율 (원인코드)', $chart2));
                $chart3 = view('dashboard.chart3');
                $row->column(1/3, new Box('최근 1년간 고장조치비율 (조치코드)', $chart3));
            });
    }
}
