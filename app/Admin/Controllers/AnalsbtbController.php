<?php

namespace App\Admin\Controllers;

use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;

class analsbtbController extends Controller
{
    public function index(Content $content)
    {
        $content->title('신뢰도분석');
        $content->description('(공급)');

        $this->showFormParameters($content);
        
        if (request()->input('플랜트') != '') {
            $this->sql($content);
            // $this->run($content);
        }    

        $tab = new Widgets\Tab();

        $form = new Widgets\Form();

        $form->method('get');

        $form->html('<a href="/anal_sbt_e">심화분석</a>');

        $form->radio('분석타입선택')->options(['B' => '기본분석', 'E'=> '심화분석'])->default('B')->disable();
        // $form->radio('분석플레그')->options(['S' => '분석시작', 'W' => '심화분석중', 'F' => '분석종료'])->default('S');
        $form->dateRange('sdate', 'edate', '기간선택')->help('비워둘경우 오늘날짜입력됨, 도움말참조'); //검토필요
        $form->divider();      
        $form->text('관심시간입력')->placeholder('1000,5000,10000,50000,100000')->help('최대10개값입력가능, 도움말참조');
        $form->radio('적용분포')->options(['1' => '와이블', '2'=> '로그', '3'=>'지수', '4'=>'정규'])->default('3')->disable()->help('설명필요');
        $form->divider();
        $form->radio('고장모드선택')->options(['1' => '여', '2' => '부'])->default('2');
        $form->radio('검정모드선택')->options(['1' => '여', '2' => '부'])->default('2')->disable()->help('심화분석에서 선택가능');
        $form->divider();

        //공급이라서
        $플랜트 = DB::table('kgloc')->where('key1_cd', 'like', '3%')->pluck('key1_nm', 'key1_cd')->toArray();
        
        $form->checkbox('플랜트')->options($플랜트)->canCheckAll();

        $위치 = DB::table('kgloc')->pluck('key2_cd')->toArray();
        $위치 = array_combine($위치, $위치);
        $form->multipleSelect('위치')->options($위치)->default('2200')->rules('required');

        $일차분류 = DB::table('kgpbt')->pluck('key3_cd')->toArray();
        $일차분류 = array_combine($일차분류, $일차분류);
        $form->multipleSelect('1차분류')->options($일차분류)->default('2200')->rules('required');

        $이차분류 = DB::table('kgpbt')->pluck('key4_cd')->toArray();
        $이차분류 = array_combine($이차분류, $이차분류);
        $form->multipleSelect('2차분류')->options($이차분류)->default('2200')->rules('required');

        $삼차분류 = DB::table('kgpbt')->pluck('key5_cd')->toArray();
        $삼차분류 = array_combine($삼차분류, $삼차분류);
        $form->multipleSelect('3차분류')->options($삼차분류)->default('2200')->rules('required');

        $사차분류 = DB::table('kgpbt')->pluck('key6_cd')->toArray();
        $사차분류 = array_combine($사차분류, $사차분류);
        $form->multipleSelect('4차분류')->options($사차분류)->default('2200')/* ->rules('required') */;

        $삼다시일차분류 = DB::table('kgpbt')->pluck('key3_1_cd')->toArray();
        $삼다시일차분류 = array_combine($삼다시일차분류, $삼다시일차분류);
        $form->multipleSelect('1차추가분류')->options($삼다시일차분류)->default('2200')->rules('required');

        $form->divider();

        $tab->add('기본분석', $form);

        $content->row($tab);

        return $content;
    }

    protected function showFormParameters($content)
    {
        $parameters = request()->except(['_pjax', '_token']);
        if (!empty($parameters)) {
            ob_start();
            dump($parameters);
            $contents = ob_get_contents();
            ob_end_clean();
            $content->row(new Widgets\Box('전송된변수', $contents));
        }
    }

    protected function sql(Content $content)
    {
        $AR_CD = "AR".date("Y-m-d H:i:s");
        $analysis_type = 'B';
        $analysis_flg = 'S';
        
        $key1_cd = request()->input('플랜트');
        if (is_array($key1_cd)) {
            $key1_cd = implode(',',$key1_cd);
        }
        
        $key2_cd = request()->input('위치');
        if (is_array($key2_cd)) {
            $key2_cd = implode(',',$key2_cd);
        }
        
        $key3_cd = request()->input('1차분류');
        if (is_array($key3_cd)) {
            $key3_cd = implode(',',$key3_cd);
        }
        
        $key4_cd = request()->input('2차분류');
        if (is_array($key4_cd)) {
            $key4_cd = implode(',',$key4_cd);
        }
        
        $key5_cd = request()->input('3차분류');
        if (is_array($key5_cd)) {
            $key5_cd = implode(',',$key5_cd);
        }

        $key6_cd = request()->input('4차분류');
        if (is_array($key6_cd)) {
            $key6_cd = implode(',',$key6_cd);
        }

        $key3_1_cd = request()->input('1차추가분류');
        if (is_array($key3_1_cd)) {
            $key3_1_cd = implode(',',$key3_1_cd);
        }

        $sdate = request()->input('sdate');
        if (is_null($sdate) or is_null($edate) or ($sdate > $edate) or $edate > date('Y-m-d')) {
            $sdate = '2009-01-01';
        }

        $edate = request()->input('edate');
        if (is_null($sdate) or is_null($edate) or ($sdate > $edate) or $edate > date('Y-m-d')) {
            $edate = date('Y-m-d');
        }
        

        $distri = request()->input('적용분포');
        $fmode = request()->input('고장모드선택');
        $smode = request()->input('검정모드선택');
        $wvalue = request()->input('관심시간입력');
        $AR_time = '2020-05-16 13:51:20';/* request()->input('2020-05-16 13:51:20'); */
        $RC_time = '2020-05-16 13:51:20';/* request()->input('2020-05-16 13:51:20'); */
        $user_id = Admin::user()->name;

        DB::table('kgart')->
        insert(['AR_CD'=>$AR_CD,
                'analysis_type'=>$analysis_type,
                'analysis_flg'=>$analysis_flg,
                'key1_cd'=>$key1_cd,
                'key2_cd'=>$key2_cd,
                'key3_cd'=>$key3_cd,
                'key4_cd'=>$key4_cd,
                'key5_cd'=>$key5_cd,
                'key6_cd'=>$key6_cd,
                'key3_1_cd'=>$key3_1_cd,
                'sdate'=>$sdate,
                'edate'=>$edate,
                'distri'=>$distri,
                'fmode'=>$fmode,
                'smode'=>$smode,
                'wvalue'=>$wvalue,
                'AR_time'=>$AR_time,
                'RC_time'=>$RC_time,
                'user_id'=>$user_id
        ]);
    }

    protected function run(Content $content)
    {
        $output = shell_exec('C:\KOGAS\KGANS.exe AR20051700024');
        echo "<pre>".$output."명령어를 잘 전송했습니다.</pre>";
    }

}

