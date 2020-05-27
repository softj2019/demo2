<?php

namespace App\Admin\Forms\Steps;

use Encore\Admin\Widgets\StepForm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class pbtb1 extends StepForm
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

        $this->radio('분석타입선택')->options(['B' => '기본분석'])->default('B')->disable();
        $this->radio('모드선택')->options(['A' => '선택안함','B' => '고장모드'])->default('B');
        $this->dateRange('sdate', 'edate', '기간선택')->help('비워둘경우 오늘날짜입력됨, 도움말참조'); //검토필요
        $this->divider();      

        //생산이라서
        $플랜트 = DB::table('kgloc')->where('key1_cd', 'like', '2%')->pluck('key1_nm', 'key1_cd')->toArray();
        
        $this->checkbox('플랜트')->options($플랜트)->canCheckAll();

        $this->divider();

    }
}