<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Encore\Admin\Facades\Admin;
use Carbon\Carbon;

class sbte4 extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '심화분석(공급)';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        $data = json_encode($this->all(), JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT);

        // admin_info('입력정보확인', "<pre><code>$data</code></pre>");

        //$this->clear();

        $ALL = $this->all();
        
        $AR_CD = DB::select( DB::raw("
        select ifnull(concat('AR',substring(max(ar_cd), 3)+1), 'AR".date('Ymd')."0001') 
        from kgart 
        where ar_cd 
        like '"."AR".date('Ymd')."%'; 
        ") );
        $AR_CD = json_decode(json_encode($AR_CD), true);
        $AR_CD = array_values($AR_CD);
        $AR_CD = implode(',',array_values($AR_CD[0]));

        $analysis_type = 'C';
        $analysis_flg = 'S';
        
        //echo "<pre>";
        //var_dump($ALL);
        //echo "</pre>";
        
        $key1_cd = $ALL['sbte1']['플랜트'];
        if (is_array($key1_cd)) {
            $key1_cd = rtrim(implode(',',$key1_cd),',');
        }
        
        $key2_cd = $ALL['sbte2']['위치'];
        if (is_array($key2_cd)) {
            $key2_cd = rtrim(implode(',',$key2_cd),',');
        }
        
        $key3_cd = $ALL['sbte2']['1차분류'];
        if (is_array($key3_cd)) {
            $key3_cd = rtrim(implode(',',$key3_cd),',');
        }
        
        $key4_cd = $ALL['sbte3']['2차분류'];
        if (is_array($key4_cd)) {
            $key4_cd = rtrim(implode(',',$key4_cd),',');
        }

        $key5_cd = "";
        if(array_key_exists('3차분류', $ALL['sbte3'])) { 
            $key5_cd = $ALL['sbte3']['3차분류'];
            if (is_array($key5_cd)) {
                $key5_cd = rtrim(implode(',',$key5_cd),',');
            }
        }

/*
        $key6_cd = $ALL['sbte3']['4차분류'];
        if (is_array($key6_cd)) {
            $key6_cd = rtrim(implode(',',$key6_cd),',');
        }

        $key3_1_cd = $ALL['sbte3']['1차분류추가'];
        if (is_array($key3_1_cd)) {
            $key3_1_cd = rtrim(implode(',',$key3_1_cd),',');
        }
*/

        $sdate = $ALL['sbte1']['sdate'];
        //$sdate = Carbon::parse($sdate);

        $edate = $ALL['sbte1']['edate'];
        //$edate = Carbon::parse($edate);

        if (empty($sdate) or ($sdate > $edate) or ($edate > Carbon::now())) {
            $sdate = '2009-01-01';
        }

        if (empty($edate) or ($sdate > $edate) or ($edate > Carbon::now())) {
            $edate = date('Y-m-d');
        }
        
        $wvalue = $ALL['sbte3']['관심시간입력'];
        if (is_null($wvalue)) {
            $wvalue = '1000,5000,10000,50000,100000';
        }
        
        $distri = ""; // 적용분포
        $fmode = "";
        if(array_key_exists('고장모드선택', $ALL['sbte3'])) {
            $fmode = implode(',', array_filter($ALL['sbte3']['고장모드선택']));
        }
        $smode = "";
        if($ALL['sbte1']['모드선택'] == 'C') {
            $smode = $key1_cd;
        }
        $AR_time = date('Y-m-d H:i:s');
        $RC_time = date('Y-m-d H:i:s');
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
                //'key6_cd'=>$key6_cd,
                //'key3_1_cd'=>$key3_1_cd,
                'sdate'=>$sdate,
                'edate'=>$edate,
                'distri'=>$distri,
                'fmode'=>$fmode,
                'smode'=>$smode,
                'wvalue'=>$wvalue,
                'AR_time'=>$AR_time,
                'RC_time'=>$RC_time,
                'user_id'=>$user_id,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s')
        ]);

        // DB::raw("ifnull(key1_cd, 'ALL') from kgart where ar_cd='".$AR_CD."'; 
        DB::statement("update kgart set key1_cd = 'ALL' where key1_cd = '' and AR_CD = '".$AR_CD."';"); 
        DB::statement("update kgart set key1_cd = 'ALL' where ISNULL(key1_cd) and AR_CD = '".$AR_CD."';");

        DB::statement("update kgart set key2_cd = 'ALL' where key2_cd = '' and AR_CD = '".$AR_CD."';"); 
        DB::statement("update kgart set key2_cd = 'ALL' where ISNULL(key2_cd) and AR_CD = '".$AR_CD."';");

        DB::statement("update kgart set key3_cd = 'ALL' where key3_cd = '' and AR_CD = '".$AR_CD."';"); 
        DB::statement("update kgart set key3_cd = 'ALL' where ISNULL(key3_cd) and AR_CD = '".$AR_CD."';");

        DB::statement("update kgart set key4_cd = 'ALL' where key4_cd = '' and AR_CD = '".$AR_CD."';"); 
        DB::statement("update kgart set key4_cd = 'ALL' where ISNULL(key4_cd) and AR_CD = '".$AR_CD."';");

        DB::statement("update kgart set key5_cd = 'ALL' where key5_cd = '' and AR_CD = '".$AR_CD."';"); 
        DB::statement("update kgart set key5_cd = 'ALL' where ISNULL(key5_cd) and AR_CD = '".$AR_CD."';");

        DB::statement("update kgart set key6_cd = 'ALL' where key6_cd = '' and AR_CD = '".$AR_CD."';"); 
        DB::statement("update kgart set key6_cd = 'ALL' where ISNULL(key6_cd) and AR_CD = '".$AR_CD."';");

        DB::statement("update kgart set key3_1_cd = 'ALL' where key3_1_cd = '' and AR_CD = '".$AR_CD."';"); 
        DB::statement("update kgart set key3_1_cd = 'ALL' where ISNULL(key3_1_cd) and AR_CD = '".$AR_CD."';");
        
        $success = false;
        
        $kgmtbw = DB::select( DB::raw("select * from kgmtb where status = 'W' limit 1;") );
        if ($kgmtbw == []) {
            echo "<pre>모든프로세스를 사용중입니다. 잠시후 이용해주세요</pre>";
        } else {
            //$kgmtbw = json_decode(json_encode($kgmtbw), true);
            //$kgmtbw = implode(',',array_values($kgmtbw[0]));
            //$kgmtbw = substr($kgmtbw,strpos($kgmtbw,'AR20'),14);
            
            foreach($kgmtbw as $row) {
                $success = DB::table('kgmtb')->where('name', $row->name)->limit(1)->update([
                    'status'=>'A',
                    'ar_cd' => $AR_CD,
                    'pid' => '',
                    'user' => Admin::user()->name,
                    'time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            
            DB::table('kgrct')->insert([
                'ar_cd' => $AR_CD,
                'htm1' => '/kogas.htm',
                'htm2' => '/kogas.htm',
                'htm3' => '/kogas.htm',
                'htm4' => '/kogas.htm',
                'htm5' => '/kogas.htm',
                'htm6' => '/kogas.htm',
                'htm7' => '/kogas.htm',
                'htm8' => '/kogas.htm',
                'htm9' => '/kogas.htm',
                'htm10' => '/kogas.htm',
                'htm11' => '/kogas.htm',
                'htm12' => '/kogas.htm',
                'htm13' => '/kogas.htm',
                'htm14' => '/kogas.htm',
                'htm15' => '/kogas.htm',
                'htm16' => '/kogas.htm',
                'htm17' => '/kogas.htm',
                'htm18' => '/kogas.htm',
                'htm19' => '/kogas.htm',
                'htm20' => '/kogas.htm',
                'htm21' => '/kogas.htm',
                'value1' => '*',
                'value2' => '*',
                'value3' => '*',
                'value4' => '*',
                'value5' => '*',
                'value6' => '*',
                'value7' => '*',
                'value8' => '*',
                'value9' => '*',
                'value10' => '*',
                'value11' => '*',
                'value12' => '*',
                'value13' => '*',
                'value14' => '*',
                'value15' => '*',
                'value16' => '*'
            ]);
        }

        if($success == true) {
            $this->run();
            admin_success("분석이 완료되었습니다.");
        } else {
            admin_error("신규 작업을 생성할 수 없습니다. 모든 할당된 프로세스가 실행 중입니다.");
        }

        //$this->clear();

        return redirect('/kgart');
    }
    
    protected function run()
    {
        $arcd = DB::table('kgart')->orderBy('created_at', 'desc')->pluck('AR_CD')->first();
        
        $output = "";
        $exec = 'start /b cmd /c C:\KOGAS\KGANS.exe' . ' ' . $arcd;
        // sleep(30);
        // $exec = 'dir/w'.' '.$arcd;
        // $output = shell_exec($exec);
        exec($exec, $output);
        // echo "<pre>".$output."명령어를 잘 전송했습니다.</pre>";
    }
}
