<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pbtb2 extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '기본분석(생산)';

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
        $this->method('get');
        
        $steps = session("steps");
        $플랜트 = $steps['pbtb1']['플랜트'];
    
        //$위치 = DB::table('kgloc')->whereIn('key1_cd', $플랜트)->where('key2_cd', 'like', '2%')->pluck('key2_nm', 'key2_cd')->toArray();
        //$this->checkbox('위치')->options($위치)->canCheckAll();

        $일차분류 = DB::table('kgpbt')->pluck('key3_nm', 'key3_cd')->toArray();
        $this->select('1차분류')->options($일차분류);

        $this->divider();

    }
    
}
