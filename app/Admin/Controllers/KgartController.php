<?php

namespace App\Admin\Controllers;

use App\Kgart;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;
use Illuminate\Support\Facades\DB;

class KgartController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '분석결과조회';
    
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kgart);
        
        $grid->column('user_id', __('분석요청자'));
        $grid->column('AR_CD', __('요청고유번호'))->modal('분석요청정보', function(){
            $values = DB::table('kgart')->where('AR_CD', $this->AR_CD)->get();
            //$value = json_decode(json_encode($value), true);
            // dd($value);
            $row = array();
            foreach($values as $value) {
                foreach($value as $k=>$v) { 
                    $row[$k] = substr($v, 0, 100);
                }
                break;
            }
    
            return new Table(['항목', '값'], $row);
        });
        // $grid->column('분석일자')->display(function(){
        //     $분석일자 = DB::table('kgart')->where('AR_CD',$this->AR_CD)->pluck('AR_time');
        //     return substr($분석일자,2,10);
        // });
        $grid->column('플랜트')->display(function(){
            $key1_cd = explode(',', $this->key1_cd);
            if (in_array('ALL', $key1_cd)) {
                return 'ALL';
            } else {
            $플랜트 = DB::table('kgloc')->whereIn('key1_cd', $key1_cd)->pluck('key1_nm')->toArray();
            return substr(implode(',', array_unique($플랜트)), 0, 18)."...";
            }
        });
        $grid->column('위치내역')->display(function(){
            $key2_cd = explode(',', $this->key2_cd);
            if (in_array('ALL', $key2_cd)) {
                return 'ALL';
            } else {
            $위치 = DB::table('kgloc')->whereIn('key2_cd', $key2_cd)->pluck('key2_nm')->toArray();
            return substr(implode(',', array_unique($위치)), 0, 18)."...";
            }
        });
        $grid->column('1차분류')->display(function(){
            $key3_cd = explode(',', $this->key3_cd);
            if (in_array('ALL', $key3_cd)) {
                return 'ALL';
            } else {
            $일차분류 = DB::table('kgpbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // if (substr($key3_cd,1) == '2') {
            //     $일차분류 = DB::table('kgpbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // } else {
            //     $일차분류 = DB::table('kgsbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // }
            return substr(implode(',', array_unique($일차분류)), 0, 24)."...";
            }
        });
        $grid->column('1-1차분류')->display(function(){
            $key3_1_cd = explode(',', $this->key3_1_cd);
            if (in_array('ALL', $key3_1_cd)) {
                return 'ALL';
            } else {
            $일다시일차분류 = DB::table('kgpbt')->whereIn('key3_1_cd', $key3_1_cd)->pluck('key3_1_nm')->toArray();
            // if (substr($key3_cd,1) == '2') {
            //     $일차분류 = DB::table('kgpbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // } else {
            //     $일차분류 = DB::table('kgsbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // }
            return substr(implode(',', array_unique($일다시일차분류)), 0, 26)."...";
            }
        });
        $grid->column('2차분류')->display(function(){
            $key4_cd = explode(',', $this->key4_cd);
            if (in_array('ALL', $key4_cd)) {
                return 'ALL';
            } else {
            $이차분류 = DB::table('kgpbt')->whereIn('key4_cd', $key4_cd)->pluck('key4_nm')->toArray();
            // if (substr($key3_cd,1) == '2') {
            //     $일차분류 = DB::table('kgpbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // } else {
            //     $일차분류 = DB::table('kgsbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // }
            return substr(implode(',', array_unique($이차분류)), 0, 30)."...";
            }
        });
        $grid->column('3차분류')->display(function(){
            $key5_cd = explode(',', $this->key5_cd);
            if (in_array('ALL', $key5_cd)) {
                return 'ALL';
            } else {
            $삼차분류 = DB::table('kgpbt')->whereIn('key5_cd', $key5_cd)->pluck('key5_nm')->toArray();
            // if (substr($key3_cd,1) == '2') {
            //     $일차분류 = DB::table('kgpbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // } else {
            //     $일차분류 = DB::table('kgsbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // }
            return substr(implode(',', array_unique($삼차분류)), 0, 30)."...";
            }
        });
        $grid->column('4차분류')->display(function(){
            $key6_cd = explode(',', $this->key6_cd);
            // dd(array_slice($key6_cd,0,2));
            if (in_array('ALL', $key6_cd)) {
                return 'ALL';
            } else {
            $사차분류 = DB::table('kgpbt')->whereIn('key6_cd', $key6_cd)->pluck('key6_nm')->toArray();
            // if (substr($key3_cd,1) == '2') {
            //     $일차분류 = DB::table('kgpbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // } else {
            //     $일차분류 = DB::table('kgsbt')->whereIn('key3_cd', $key3_cd)->pluck('key3_nm')->toArray();
            // }
            return substr(implode(',', array_unique($사차분류)), 0, 24)."...";
            }
        });

        $grid->column('분석요약표')->display(function(){
            return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="">
            View
            </button>';
        })->modal('분석결과 Value', function(){
            $titles = array(
                'ar_cd' => 'AR_CD',
                'value1' => '신뢰도',
                'value2' => '신뢰도 하한',
                'value3' => '신회도 상한',
                'value4' => '불신뢰도',
                'value5' => '불신뢰도 하한',
                'value6' => '불신뢰도 상한',
                'value7' => '평균(MTTF)',
                'value8' => '평균 하한',
                'value9' => '평균 상한',
                'value10' => '고장율',
                'value11' => '고장율 하한',
                'value12' => '고장율 상한',
                'value13' => '지수분포 고장모드별 리스트',
                'value14' => '지수분포 고장모드별 고장율',
                'value15' => '지수분포 고장모드별 고장율 하한',
                'value16' => '지수분포 고장모드별 고장율 상한'
            );
            $values = DB::table('kgrct')->where('AR_CD', $this->AR_CD)->get([
                'ar_cd',
                'value1',
                'value2',
                'value3',
                'value4',
                'value5',
                'value6',
                'value7',
                'value8',
                'value9',
                'value10',
                'value11',
                'value12',
                'value13',
                'value14',
                'value15',
                'value16'
            ]);
            $row = array();
            foreach($values as $value) {
                foreach($value as $k=>$v) {
                    $row[$titles[$k]] = substr($v,0,70);
                }
                break;
            }

            //$value = json_decode(json_encode($value), true);
            // dd($value);
            // $value = array_slice($value[0], 2); 
            return new Table(['항목', '값'], $row);
        });
        
        $grid->column('신뢰도분석')->display(function(){
            // $rct=DB::table('kgrct')->where('AR_CD','=',$this->AR_CD)->first();
            
            $rct=DB::table('kgrct')->where('AR_CD','=',$this->AR_CD)->get()->toArray();
            // dd($rct[0]);
            
            $htm1=$rct[0]->htm1;
            // dd($htm1);
            $htm2=$rct[0]->htm2;
            // dd($htm2);
            $htm3=$rct[0]->htm3;
            $htm4=$rct[0]->htm4;

            return '
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable2">
            View
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalScrollable2" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document" style="width: 80%;height: 100%;margin: 150 150 150 0;padding: 0;">
                <div class="modal-content" style="height: 100%;min-height: 80%;border-radius: 0;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">신뢰도분석결과</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>신뢰도 분석결과<p/>
                    <iframe src="'.$htm4.'" width="1100" height="500">
                    </iframe>
                </div>
                <div class="modal-footer">
                    
                </div>
                </div>
            </div>
            </div>
            ';
        });
        
        $grid->column('기초통계분석')->display(function(){
            return '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="">
            View
            </button>';
        })->modal('분석결과 차트', function(){
            $titles = array(
                // 'ar_cd' => 'AR_CD',
                // 'htm1' => '분포 ID 그림 A-D 값 > 심화 distriID',
                // 'htm2' => '분포 ID 그림 A-D 값 FULL > 심화 distriID2',
                // 'htm3' => '분포개관그림 이미지 > 심화 Boverview',
                // 'htm4' => '신뢰도 분석결과 > reliability',
                'htm5' => '고장모드 별 파이차트',
                'htm6' => '고장원인 별 파이차트',
                'htm7' => '고장조치사항 별 파이차트',
                'htm8' => '플랜트 구분 고장모드 별 파이차트',
                'htm9' => '플랜트 구분 고장원인 별 파이차트',
                'htm10' => '플랜트 구분 고장조치사항 별 파이차트',
                'htm11' => '고장모드 별 고장시간 히스토그램',
                'htm12' => '고장원인 별 고장시간 히스토그램',
                'htm13' => '고장조치사항 별 고장시간 히스토그램',
                'htm14' => '설비 별 고장시간 히스토그램',
                'htm15' => '설비 구분 고장모드별 고장시간 히스토그램',
                'htm16' => '설비 구분 고장원일별 고장시간 히스토그램',
                'htm17' => '설비 구분 고장조치사항별 고장시간 히스토그램',
                'htm18' => '고장모드 별 보수시간 히스토그램',
                'htm19' => '고장원인 별 보수시간 히스토그램',
                'htm20' => '고장조치사항 별 보수시간 히스토그램',
                'htm21' => '설비 별 보수시간 히스토그램'
            );
            $values = DB::table('kgrct')->where('AR_CD', $this->AR_CD)->get([
                // 'ar_cd',
                // 'htm1',
                // 'htm2',
                // 'htm3',
                // 'htm4',
                'htm5',
                'htm6',
                'htm7',
                'htm8',
                'htm9',
                'htm10',
                'htm11',
                'htm12',
                'htm13',
                'htm14',
                'htm15',
                'htm16',
                'htm17',
                'htm18',
                'htm19',
                'htm20',
                'htm21'
            ]);
            $row = array();
            foreach($values as $value) {
                foreach($value as $k=>$v) {
                    // $row[$titles[$k]] = sprintf("<a href=\"%s\" onclick=\"window.open(this.href);\"><button>차트보기</button></a>", $v, $v);
                    $row[$titles[$k]] = sprintf("<a href=\"%s\" target='_blank'><button>차트보기</button></a>", $v, $v);
                    
                }
                break;
            }

            //$value = json_decode(json_encode($value), true);
            // dd($value);
            // $value = array_slice($value[0], 2); 
            return new Table(['항목', '값'], $row);
        });
        
        $grid->column('데이터받기')->display(function(){
            if($this->analysis_flg == 'F') {
                // return '<form method="get" action="/htm/".substr($this->AR_CD,2,4)."/".substr($this->AR_CD,6,4)."/".$this->AR_CD."/".$this->AR_CD."_file.csv">
                //             <button type="submit">Download</button>
                //         </form>';
                return "<a href='/htm/".substr($this->AR_CD,2,4)."/".substr($this->AR_CD,6,4)."/".$this->AR_CD."/".$this->AR_CD."_file.csv' download><button class='btn btn-primary'>Download</button></a>";
            } else {
                return "";
            }
        });

        $grid->column('analysis_type', __('분석타입'))
        ->display(function(){
            switch ($this->analysis_type) {
                case 'A' : return '<span style="color:red">기초통계분석(A)</span>'; break;
                case 'B' : return '<span style="color:blue">기본분석(B)</span>'; break;
                case 'E' : return '심화분석(E)'; break;
            }
        });
        $grid->column('analysis_flg', __('분석상태'))->display(function(){
            switch ($this->analysis_flg) {
                case 'S' : return '<span style="color:red">분석시작(S)</span>'; break;
                case 'W' : return '<span style="color:blue">심화분석중(W)</span>'; break;
                case 'E' : return '<span style="color:blue">오류(E)</span>'; break;
                case 'Z' : return '<span style="color:blue">오류(Z)</span>'; break;
                case 'F' : return '분석종료(F)'; break;
            }
        });
        
        // $grid->column('key1_cd', __('위치정보1'))->display(function($key1_cd){
        //     $key1_cd_exp=explode(',',$key1_cd);
        //     for ($i=0;$i<count($key1_cd_exp);$i++){
        //         $key1_nm[$i]=DB::table('kgloc')->where('key1_cd','=',$key1_cd_exp[$i])->pluck('key1_nm')->first();    
        //     }
        //     if ($key1_nm == []) {
        //         for ($i=0;$i<count($key1_cd_exp);$i++){
        //             $key1_nm[$i]=DB::table('kgloc')->where('key1_cd','=',$key1_cd_exp[$i])->pluck('key1_nm')->first();    
        //         }    
        //     }
        //     return implode(',',$key1_nm);
        // });
        // $grid->column('key2_cd', __('위치정보2'))/* ->display(function($key2_cd){
        //     $key2_nm=DB::table('kgloc')->where('key2_cd','=',$key2_cd)->pluck('key2_nm');
        //     return $key2_nm[0];
        // }) */;
        // $grid->column('key3_cd', __('위치정보3'))/* ->display(function($key3_cd){
        //     $key3_cd_exp=explode(',',$key3_cd);
        //     for ($i=0;$i<count($key3_cd_exp);$i++){
        //         $key3_nm[$i]=DB::table('kgpbt')->where('key3_cd','=',$key3_cd_exp[$i])->pluck('key3_nm')->first();    
        //     }
        //     if ($key3_nm == []) {
        //         for ($i=0;$i<count($key3_cd_exp);$i++){
        //             $key3_nm[$i]=DB::table('kgsbt')->where('key3_cd','=',$key3_cd_exp[$i])->pluck('key3_nm')->first();    
        //         }    
        //     }
        //     return implode(',',$key3_nm);
        // }) */;
        
        // $grid->column('key4_cd', __('위치정보4'))/* ->display(function($key4_cd){
        //     $key4_cd_exp=explode(',',$key4_cd);
        //     for ($i=0;$i<count($key4_cd_exp);$i++){
        //         $key4_nm[$i]=DB::table('kgpbt')->where('key4_cd','=',$key4_cd_exp[$i])->pluck('key4_nm')->first();    
        //     }
        //     if ($key4_nm == []) {
        //         for ($i=0;$i<count($key4_cd_exp);$i++){
        //             $key4_nm[$i]=DB::table('kgsbt')->where('key4_cd','=',$key4_cd_exp[$i])->pluck('key4_nm')->first();    
        //         }    
        //     }
        //     return implode(',',$key4_nm);
        // }) */;
        // $grid->column('key5_cd', __('위치정보5'))/* ->display(function($key5_cd){
        //     $key5_cd_exp=explode(',',$key5_cd);
        //     for ($i=0;$i<count($key5_cd_exp);$i++){
        //         $key5_nm[$i]=DB::table('kgpbt')->where('key5_cd','=',$key5_cd_exp[$i])->pluck('key5_nm')->first();    
        //     }
        //     if ($key5_nm == []) {
        //         for ($i=0;$i<count($key5_cd_exp);$i++){
        //             $key5_nm[$i]=DB::table('kgsbt')->where('key5_cd','=',$key5_cd_exp[$i])->pluck('key5_nm')->first();    
        //         }    
        //     }
        //     return implode(',',$key5_nm);
        // }) */;
        // $grid->column('key6_cd', __('위치정보6'))/* ->display(function($key6_cd){
        //     $key6_cd_exp=explode(',',$key6_cd);
        //     for ($i=0;$i<count($key6_cd_exp);$i++){
        //         $key6_nm[$i]=DB::table('kgpbt')->where('key6_cd','=',$key6_cd_exp[$i])->pluck('key6_nm')->first();    
        //     }
        //     if ($key6_nm == []) {
        //         for ($i=0;$i<count($key6_cd_exp);$i++){
        //             $key6_nm[$i]=DB::table('kgsbt')->where('key6_cd','=',$key6_cd_exp[$i])->pluck('key6_nm')->first();    
        //         }    
        //     }
        //     return implode(',',$key6_nm);
        // }) */;
        // $grid->column('key3_1_cd', __('위치정보3-1'));
        // $grid->column('sdate', __('Sdate'));
        // $grid->column('edate', __('Edate'));
        // $grid->column('distri', __('Distri'));
        // $grid->column('fmode', __('Fmode'));
        // $grid->column('smode', __('Smode'));
        // $grid->column('wvalue', __('Wvalue'));
        // $grid->column('AR_time', __('AR time'));
        // $grid->column('RC_time', __('RC time'));
        // $grid->column('start_time', __('분석시작시간'));
        // $grid->column('finish_time', __('분석완료시간'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        $grid->model()->orderBy('AR_CD', 'desc'); //기본 정렬순서
        $grid->quickSearch('AR_CD','user_id','analysis_type','analysis_flg');    
        $grid->fixColumns(0, 0);

        $grid->disableActions();
        $grid->disableFilter();    
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();
        // $grid->disableTools();
        $grid->disableExport();

        return $grid;
    }

    // /**
    //  * Make a show builder.
    //  *
    //  * @param mixed $id
    //  * @return Show
    //  */
    // protected function detail($id)
    // {
    //     $show = new Show(Kgart::findOrFail($id));

    //     $show->field('AR_CD', __('AR CD'));
    //     $show->field('analysis_type', __('Analysis type'));
    //     $show->field('analysis_flg', __('Analysis flg'));
    //     $show->field('key1_cd', __('Key1 cd'));
    //     $show->field('key2_cd', __('Key2 cd'));
    //     $show->field('key3_cd', __('Key3 cd'));
    //     $show->field('key4_cd', __('Key4 cd'));
    //     $show->field('key5_cd', __('Key5 cd'));
    //     $show->field('key6_cd', __('Key6 cd'));
    //     $show->field('key3_1_cd', __('Key3 1 cd'));
    //     $show->field('sdate', __('Sdate'));
    //     $show->field('edate', __('Edate'));
    //     $show->field('distri', __('Distri'));
    //     $show->field('fmode', __('Fmode'));
    //     $show->field('smode', __('Smode'));
    //     $show->field('wvalue', __('Wvalue'));
    //     $show->field('AR_time', __('AR time'));
    //     $show->field('RC_time', __('RC time'));
    //     $show->field('user_id', __('User id'));
    //     $show->field('start_time', __('Start time'));
    //     $show->field('finish_time', __('Finish time'));
    //     $show->field('created_at', __('Created at'));
    //     $show->field('updated_at', __('Updated at'));

    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Kgart);

    //     $form->text('analysis_type', __('Analysis type'));
    //     $form->text('analysis_flg', __('Analysis flg'));
    //     $form->text('key1_cd', __('Key1 cd'));
    //     $form->text('key2_cd', __('Key2 cd'));
    //     $form->text('key3_cd', __('Key3 cd'));
    //     $form->text('key4_cd', __('Key4 cd'));
    //     $form->text('key5_cd', __('Key5 cd'));
    //     $form->text('key6_cd', __('Key6 cd'));
    //     $form->text('key3_1_cd', __('Key3 1 cd'));
    //     $form->date('sdate', __('Sdate'))->default(date('Y-m-d'));
    //     $form->date('edate', __('Edate'))->default(date('Y-m-d'));
    //     $form->text('distri', __('Distri'));
    //     $form->text('fmode', __('Fmode'));
    //     $form->text('smode', __('Smode'));
    //     $form->text('wvalue', __('Wvalue'));
    //     $form->date('AR_time', __('AR time'))->default(date('Y-m-d'));
    //     $form->date('RC_time', __('RC time'))->default(date('Y-m-d'));
    //     $form->text('user_id', __('User id'));
    //     $form->datetime('start_time', __('Start time'))->default(date('Y-m-d H:i:s'));
    //     $form->datetime('finish_time', __('Finish time'))->default(date('Y-m-d H:i:s'));

    //     return $form;
    // }
}
