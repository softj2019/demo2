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

class PbtaController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('기초통계분석(생산)')
            ->body(MultipleSteps::make([
                'pbta1' => Steps\pbta1::class,
                'pbta2' => Steps\pbta2::class,
                'pbta3' => Steps\pbta3::class,
                'pbta4' => Steps\pbta4::class,
                'pbta5' => Steps\pbta5::class
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
