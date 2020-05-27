<?php

namespace App\Admin\Controllers;

use App\Admin\Forms\Settings;
use App\Admin\Forms\Steps;
use App\Http\Controllers\Controller;
use App\Models\User;
use Encore\Admin\Admin;
use Encore\Admin\Layout\Content;
use Encore\Admin\Widgets\MultipleSteps;
use Encore\Admin\Widgets;

class SbtbController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('기본분석(공급)')
            ->body(MultipleSteps::make([
                'sbtb1'     => Steps\sbtb1::class,
                'sbtb2'  => Steps\sbtb2::class,
                'sbtb3' => Steps\sbtb3::class,
                'sbtb4' => Steps\sbtb4::class,
            ]));
    }

    protected function dumpRequest(Content $content)
    {
        $parameters = request()->except(['_pjax', '_token']);

        if (!empty($parameters)) {

            ob_start();

            dump($parameters);

            $contents = ob_get_contents();

            ob_end_clean();

            $content->row(new Widgets\Box('Form parameters', $contents));
        }
    }
}