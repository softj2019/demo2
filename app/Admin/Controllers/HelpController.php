<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class HelpController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->title('도움말')
            ->description('메뉴설명입니다.')
            ->view('help', ['data' => 'foo'])
            ;
    }
}
