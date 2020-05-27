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

class PbtbController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('기본분석(생산)')
            ->body(MultipleSteps::make([
                'pbtb1' => Steps\pbtb1::class,
                'pbtb2' => Steps\pbtb2::class,
                'pbtb3' => Steps\pbtb3::class,
                'pbtb4' => Steps\pbtb4::class,
                'pbtb5' => Steps\pbtb5::class
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
