<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Basic extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '기본분석';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        // dump($request->all());

        admin_success('기본분석이 요청되었습니다.');

        // return redirect('/kganal')->with(['플랜트' => '제1공장']);
        return back();
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->method('get');
        $this->text('플랜트', '플랜트')->help('');
        $this->text('위치', '위치')->help('');
        $this->text('1차분류', '1차분류')->help('');
        $this->text('1차추가분류', '1차추가분류');
        $this->text('2차분류', '2차분류');
        $this->text('3차분류', '3차분류')->help('');
        $this->text('4차분류', '4차분류')->help('');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [
            '플랜트' => '제1공장',
            '위치' => '가스',
            '1차분류' => '기계',
            '1차분류추가' => 'ㄴㅇㄹㄴ',
            '2차분류' => 'ㅇㄴ',
            '3차분류' => 'ㄴㅇ',
            '4차분류' => 'ㅇㄹㄴ',           
        ];
    }
}
