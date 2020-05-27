<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pbte2 extends StepForm
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '심화분석(생산)';

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
    
        $위치 = DB::table('kgloc')->where('key1_cd', 'like', '2%')->pluck('key2_nm', 'key2_cd')->toArray();
        $this->checkbox('위치')->options($위치)->canCheckAll();

        $일차분류 = DB::table('kgpbt')->pluck('key3_nm', 'key3_cd')->toArray();
        $this->select('1차분류')->options($일차분류);

        $this->divider();

    }
    
}
