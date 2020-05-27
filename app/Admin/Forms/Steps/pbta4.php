<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pbta4 extends StepForm
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
        $이차분류 = $steps['pbta3']['2차분류'];

        $kgtag = "kgtag";
        if($일차분류 > 3) {
            $kgtag = "kgpbt";
        }
        $삼차분류 = DB::table($kgtag)->where('key3_cd', $일차분류)->whereIn('key4_cd', $이차분류)->pluck('key5_nm', 'key5_cd')->toArray();
        $this->checkbox('3차분류')->options($삼차분류)->canCheckAll();
    }
}
