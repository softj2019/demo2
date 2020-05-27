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

class PbteController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('심화분석(생산)')
            ->body(MultipleSteps::make([
                'pbte1' => Steps\pbte1::class,
                'pbte2' => Steps\pbte2::class,
                'pbte3' => Steps\pbte3::class,
                'pbte4' => Steps\pbte4::class,
                'pbte5' => Steps\pbte5::class
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
