<?php

namespace App\Admin\Forms\Settings;

use Encore\Admin\Widgets\Form;
use Illuminate\Http\Request;

class Statistics extends Form
{
    /**
     * The form title.
     *
     * @var string
     */
    public $title = '기초통계분석';

    /**
     * Handle the form request.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request)
    {
        //dump($request->all());

        admin_success('심화분석이 요청되었습니다.');

        return redirect('/kganal');
    }

    /**
     * Build a form here.
     */
    public function form()
    {
        $this->switch('website_enable', '')->help('');
        $this->text('website_title', '')->help('');
        $this->text('website_slogan', '')->help('');
        $this->image('website_logo', '');
        $this->image('website_text_logo', '');
        $this->textarea('website_desc', '')->help('');
        $this->text('website_keywords', '')->help('');
        $this->text('website_copyright', '')->help('');
        $this->text('website_icp', '')->help('');
        $this->textarea('website_statistics', '')->help('');
    }

    /**
     * The data of the form.
     *
     * @return array $data
     */
    public function data()
    {
        return [

        ];
    }
}
