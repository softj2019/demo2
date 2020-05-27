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
use Carbon\Carbon;


// $AR_CD = DB::select( DB::raw("
// select ifnull(concat('AR',substring(max(ar_cd), 3)+1), 'AR".date('Ymd')."0001') 
// from kgart 
// where ar_cd 
// like '"."AR".date('Ymd')."%'; 
// ") );
// $AR_CD = json_decode(json_encode($AR_CD), true);
// dd(implode(',',array_values($AR_CD[0])));

//유휴프로세서찾기 'W' 웨이팅 'A' 분석중
// $kgmtbw = DB::select( DB::raw("
// select * 
// from kgmtb 
// where status = 'W' 
// limit 1; 
// ") );
// $kgmtbw = json_decode(json_encode($kgmtbw), true);
// $kgmtbw = implode(',',array_values($kgmtbw[0]));
// $kgmtbw = substr($kgmtbw,strpos($kgmtbw,'AR20'),14);
// dd($kgmtbw);


class AnalsbtaController extends Controller
{
    public function index(Content $content)
    {
        $content->title('기초통계분석');
        $content->description('(공급)');

        $this->showFormParameters($content);
        
        if (request()->input('플랜트') != '') {
            $this->sql($content);
            // $this->run($content);
        }    

        $tab = new Widgets\Tab();

        $form = new Widgets\Form();

        $form->method('get');

        $form->html('<a href="/anal_pbt_a">생산</a>');

        $form->radio('분석타입선택')->options(['A' => '기초통계분석'])->default('A')->disable();
        // $form->radio('분석플레그')->options(['S' => '분석시작', 'W' => '심화분석중', 'F' => '분석종료'])->default('S');
        $form->dateRange('sdate', 'edate', '기간선택')->help('비워둘경우 오늘날짜입력됨, 도움말참조'); //검토필요
        $form->divider();      

        //공급이라서
        $플랜트 = DB::table('kgloc')->where('key1_cd', 'like', '3%')->pluck('key1_nm', 'key1_cd')->toArray();
        
        $form->checkbox('플랜트')->options($플랜트)->canCheckAll();

        // 심화분석에서만선택가능
        $위치 = DB::table('kgloc')->where('key1_cd', 'like', '3%')->pluck('key2_nm', 'key2_cd')->toArray();
        
        $form->checkbox('위치')->options($위치)->canCheckAll();

        $일차분류 = DB::table('kgpbt')->pluck('key3_nm', 'key3_cd')->toArray();
        $form->multipleSelect('1차분류')->options($일차분류)->rules('required');

        $이차분류 = DB::table('kgpbt')->pluck('key4_nm', 'key4_cd')->toArray();
        $form->multipleSelect('2차분류')->options($이차분류)->rules('required');

        $삼차분류 = DB::table('kgpbt')->pluck('key5_nm', 'key5_cd')->toArray();
        $form->multipleSelect('3차분류')->options($삼차분류)->rules('required');

        $사차분류 = DB::table('kgpbt')->pluck('key6_nm', 'key6_cd')->toArray();
        $form->multipleSelect('4차분류')->options($사차분류)/* ->rules('required') */;

        $삼다시일차분류 = DB::table('kgpbt')->pluck('key3_1_nm', 'key3_1_cd')->toArray();
        $form->multipleSelect('1차추가분류')->options($삼다시일차분류)->rules('required');

        $form->divider();

        $tab->add('기초통계분석', $form);

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
        // $AR_CD = "AR".date("Y-m-d H:i:s");
        $AR_CD = DB::select( DB::raw("
        select ifnull(concat('AR',substring(max(ar_cd), 3)+1), 'AR".date('Ymd')."0001') 
        from kgart 
        where ar_cd 
        like '"."AR".date('Ymd')."%'; 
        ") );
        $AR_CD = json_decode(json_encode($AR_CD), true);
        $AR_CD = array_values($AR_CD);
        $AR_CD = implode(',',array_values($AR_CD[0]));

        $analysis_type = 'A';
        $analysis_flg = 'S';
        
        $key1_cd = request()->input('플랜트');
        if (is_array($key1_cd)) {
            $key1_cd = rtrim(implode(',',$key1_cd),',');
        }
        
        $key2_cd = request()->input('위치');
        if (is_array($key2_cd)) {
            $key2_cd = rtrim(implode(',',$key2_cd),',');
        }
        
        $key3_cd = request()->input('1차분류');
        if (is_array($key3_cd)) {
            $key3_cd = rtrim(implode(',',$key3_cd),',');
        }
        
        $key4_cd = request()->input('2차분류');
        if (is_array($key4_cd)) {
            $key4_cd = rtrim(implode(',',$key4_cd),',');
        }
        
        $key5_cd = request()->input('3차분류');
        if (is_array($key5_cd)) {
            $key5_cd = rtrim(implode(',',$key5_cd),',');
        }

        $key6_cd = request()->input('4차분류');
        if (is_array($key6_cd)) {
            $key6_cd = rtrim(implode(',',$key6_cd),',');
        }

        $key3_1_cd = request()->input('1차추가분류');
        if (is_array($key3_1_cd)) {
            $key3_1_cd = rtrim(implode(',',$key3_1_cd),',');
        }

        $sdate = request()->input('sdate');
        if (is_null($sdate) or is_null($edate) or ($sdate > $edate) or $edate > date('Y-m-d')) {
            $sdate = '2009-01-01';
        }

        $edate = request()->input('edate');
        if (is_null($sdate) or is_null($edate) or ($sdate > $edate) or $edate > date('Y-m-d')) {
            $edate = date('Y-m-d');
        }
        
        $wvalue = request()->input('관심시간입력');
        if (is_null($wvalue)) {
            $wvalue = '1000,5000,10000,50000,100000';
        }

        $distri = request()->input('적용분포');
        $fmode = request()->input('고장모드선택');
        $smode = request()->input('검정모드선택');
        $AR_time = '2020-05-16 13:51:20';/* request()->input('2020-05-16 13:51:20'); */
        $RC_time = '2020-05-16 13:51:20';/* request()->input('2020-05-16 13:51:20'); */
        $user_id = Admin::user()->name;

        // $AR_CD = DB::select( DB::raw("
        // select ifnull(concat('AR',substring(max(ar_cd), 3)+1), 'AR20051400001') 
        // from kgart 
        // where ar_cd 
        // like '"."AR".date('Ymd')."%'; 
        // ") );
        // dd($results);
         
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
                'user_id'=>$user_id,
                'created_at'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
        ]);

        $kgmtbw = DB::select( DB::raw("
        select * 
        from kgmtb 
        where status = 'W' 
        limit 1; 
        ") );
        $kgmtbw = json_decode(json_encode($kgmtbw), true);
        $kgmtbw = implode(',',array_values($kgmtbw[0]));
        $kgmtbw = substr($kgmtbw,strpos($kgmtbw,'AR20'),14);
        DB::table('kgmtb')->where('ar_cd','=',$kgmtbw)->
        update([
                'status'=>'A',
                'ar_cd'=>$AR_CD,
                'pid'=>'',
                'user'=>Admin::user()->name,
                'time'=>Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
        ]);        

    }

    protected function run(Content $content)
    {
        $arcd = DB::table('kgart')->pluck('AR_CD')->first();
        $exce = 'C:\KOGAS\KGANS.exe'.' '.$srcd;
        $output = shell_exec($exec);
        echo "<pre>".$output."명령어를 잘 전송했습니다.</pre>";
    }

}

