<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->get('forms/form-1', 'FormController@form1');
    $router->get('forms/form-2', 'FormController@form2');
    $router->get('forms/form-3', 'FormController@form3');
    $router->get('forms/form-4', 'FormController@form4');
    $router->get('forms/settings', 'FormController@settings');
    $router->get('forms/register', 'FormController@register');

    $router->get('widgets/table', 'WidgetsController@table');
    $router->get('widgets/box', 'WidgetsController@box');
    $router->get('widgets/info-box', 'WidgetsController@infoBox');
    $router->get('widgets/tab', 'WidgetsController@tab');
    $router->get('widgets/notice', 'WidgetsController@notice');
    $router->get('widgets/editors', 'WidgetsController@editors');

    $router->get('chartjs', 'ChartjsController@index');
    $router->get('help', 'HelpController@index');

    $router->get('analysis-request-pbts', 'AnalysysRequestPbtController@index');

    $router->resource('kganal', KganalController::class);
    $router->resource('kgcod', KgcodController::class);
    $router->resource('kgloc', KglocController::class);
    $router->resource('kgpbt', KgpbtController::class);
    $router->resource('kgsbt', KgsbtController::class);
    $router->resource('kgtag', KgtagController::class);
    $router->resource('kgspmt', KgspmtController::class);
    $router->resource('kgdata', KgdataController::class);
    $router->resource('kgrct', KgrctController::class);
    $router->resource('kguse', KguseController::class);
    $router->resource('kgart', KgartController::class);
    $router->resource('kgmtb', KgmtbController::class);


    $router->get('anal_pbt_b', 'AnalpbtbController@index');
    $router->get('anal_pbt_e', 'AnalpbteController@index');
    $router->get('anal_pbt_a', 'AnalpbtaController@index');

    $router->get('anal_sbt_b', 'AnalsbtbController@index');
    $router->get('anal_sbt_e', 'AnalsbteController@index');
    $router->get('anal_sbt_a', 'AnalsbtaController@index');
    // $router->get('testmenu', 'China\ChinaController@cascading');
    $router->resource('board', BoardController::class);

    $router->get('pbt/a', 'PbtaController@index');
    $router->get('pbt/b', 'PbtbController@index');
    $router->get('pbt/e', 'PbteController@index');

    $router->get('sbt/a', 'SbtaController@index');
    $router->get('sbt/b', 'SbtbController@index');
    $router->get('sbt/e', 'SbteController@index');

       
});