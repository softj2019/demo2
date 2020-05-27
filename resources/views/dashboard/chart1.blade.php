<?php

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// dd(Carbon::now()->subYears(1));
$고장모드비율 = DB::table('kgdata')->select(DB::raw('count(break_nm) as count, break_nm'))
->where('break_nm','<>','')
->where('sdate','>',Carbon::now()->subYears(1))
->groupBy('break_cd')->get()->pluck('count', 'break_nm')->toArray();
// dd(count($고장모드비율));

// 내장함수 어레이_키_라스트 구현 펑션 PHP 7.3 이하
if (! function_exists("array_key_last")) {
    function array_key_last($array) {
        if (!is_array($array) || empty($array)) {
            return NULL;
        }
       
        return array_keys($array)[count($array)-1];
    }
}
?> 
<canvas id="고장모드비율" style="width: 100%;"></canvas>
<script>

// 차트js 랜덤컬러 함수
function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

$(function () {

    function randomScalingFactor() {
        return Math.floor(Math.random() * 100)
    }

    window.chartColors = {
        red: 'rgb(255, 99, 132)',
        orange: 'rgb(255, 159, 64)',
        yellow: 'rgb(255, 205, 86)',
        green: 'rgb(75, 192, 192)',
        blue: 'rgb(54, 162, 235)',
        purple: 'rgb(153, 102, 255)',
        grey: 'rgb(201, 203, 207)'
    };

    var config = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    <?php
                    $i = 0; 
                    foreach ($고장모드비율 as $key => $value) {
                        if (++$i == count($고장모드비율)) break;
                        echo "'".$value."',";
                    }
                    echo "'".end($고장모드비율)."'";
                    ?> 
                ],
                backgroundColor: [
                    <?php
                    for ($i=0;$i<count($고장모드비율);$i++) {
                        echo "getRandomColor(),";
                    }
                    ?>
                ],
                label: 'Dataset 1'
            }],
            labels: [
                <?php
                    $i = 0; 
                    foreach ($고장모드비율 as $key => $value) {
                        if (++$i == count($고장모드비율)) break;
                        echo "'".$key."',";
                    }
                    echo "'".array_key_last($고장모드비율)."'";
                ?> 
            ]
        },
        options: {
            responsive: true,
            legend: {
                display: false,
                position: 'top',
            },
            title: {
                // display: true,
                display: false,
                text: '고장모드비율'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    };

    var ctx = document.getElementById('고장모드비율').getContext('2d');
    new Chart(ctx, config);
});
</script>