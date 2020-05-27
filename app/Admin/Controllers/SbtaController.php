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

class SbtaController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('기초통계분석(공급)')
            ->body(MultipleSteps::make([
                'sbta1'     => Steps\sbta1::class,
                'sbta2'  => Steps\sbta2::class,
                'sbta3' => Steps\sbta3::class,
                'sbta4' => Steps\sbta4::class,
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
