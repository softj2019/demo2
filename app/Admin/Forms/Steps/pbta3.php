<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pbta3 extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '기초통계분석(생산)';

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
        $일차분류 = $steps['pbta2']['1차분류'];

        $삼다시일차분류 = DB::table('kgpbt')->where('key3_cd', $일차분류)->pluck('key3_1_nm', 'key3_1_cd')->toArray();
        $this->checkbox('1차분류추가')->options($삼다시일차분류)->canCheckAll();

        $kgtag = "kgtag";
        if($일차분류 > 3) {
            $kgtag = "kgpbt";
        }
        $이차분류 = DB::table($kgtag)->where('key3_cd', $일차분류)->pluck('key4_nm', 'key4_cd')->toArray();
        $this->checkbox('2차분류')->options($이차분류)->canCheckAll();

    }
}
