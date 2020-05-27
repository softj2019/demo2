<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sbte3 extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '심화분-석(공급)';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        // $this->clear();
        
        return $this->next($request->all());
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $steps = session("steps");
        $일차분류 = $steps['sbte2']['1차분류'];
        
        $이차분류 = DB::table('kgsbt')->where('key3_cd', $일차분류)->pluck('key4_nm', 'key4_cd')->toArray();
        $this->checkbox('2차분류')->options($이차분류)->canCheckAll();
        
        if($일차분류 == 19) { // 밸브
            $삼차분류 = DB::table('kgsbt')->pluck('key5_nm', 'key5_cd')->toArray();
            $this->checkbox('3차분류')->options($삼차분류)->canCheckAll();
        }
        
        $this->divider();
        
        $모드선택 = $steps['sbte1']['모드선택'];
        if($모드선택 == "B") { // 고장모드 == 'B'
            $kgcod = DB::table('kgcod')->where('num_cd', 'like', '1%')->pluck('num_nm', 'num_cd')->toArray();
            $this->checkbox('고장모드선택')->options($kgcod);
        }
        
        $this->text('관심시간입력')->default("1000,5000,10000,50000,100000")->placeholder("1000,5000,10000,50000,100000");

        
        $this->divider();
    }
}
