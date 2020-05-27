<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class sbta3 extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '기초통계분석(공급)';

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
        $일차분류 = $steps['sbta2']['1차분류'];

        $이차분류 = DB::table('kgsbt')->where('key3_cd', $일차분류)->pluck('key4_nm', 'key4_cd')->toArray();
        $this->checkbox('2차분류')->options($이차분류)->canCheckAll();
        
        if($일차분류 == 19) { // 밸브
            $삼차분류 = DB::table('kgsbt')->pluck('key5_nm', 'key5_cd')->toArray();
            $this->checkbox('3차분류')->options($삼차분류)->canCheckAll();
        }

        //$사차분류 = DB::table('kgsbt')->pluck('key6_nm', 'key6_cd')->toArray();
        //$this->checkbox('4차분류')->options($사차분류)->canCheckAll();

        //$삼다시일차분류 = DB::table('kgsbt')->pluck('key3_1_nm', 'key3_1_cd')->toArray();
        //$this->checkbox('1차분류추가')->options($삼다시일차분류)->canCheckAll();
        
        $this->divider();
    }
}
