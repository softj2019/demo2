<?php

namespace App\Admin\Controllers;

use App\Kgrct;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KgrctController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '분석결과저장테이블';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kgrct);

        $grid->column('AR_CD', __('AR CD'));
        $grid->column('htm1', __('Htm1'));
        $grid->column('htm2', __('Htm2'));
        $grid->column('htm3', __('Htm3'));
        $grid->column('htm4', __('Htm4'));
        $grid->column('htm5', __('Htm5'));
        $grid->column('htm6', __('Htm6'));
        $grid->column('htm7', __('Htm7'));
        $grid->column('htm8', __('Htm8'));
        $grid->column('htm9', __('Htm9'));
        $grid->column('htm10', __('Htm10'));
        $grid->column('htm11', __('Htm11'));
        $grid->column('htm12', __('Htm12'));
        $grid->column('htm13', __('Htm13'));
        $grid->column('htm14', __('Htm14'));
        $grid->column('value1', __('Value1'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->model()->orderBy('AR_CD', 'desc'); //기본 정렬순서
        $grid->quickSearch('AR_CD');    
        $grid->fixColumns(2, 0);

        $grid->disableActions();
        $grid->disableFilter();    
        $grid->disableRowSelector();
        $grid->disableColumnSelector();
        $grid->disableCreateButton();
        // $grid->disableTools();
        // $grid->disableExport();

        return $grid;
    }

    // /**
    //  * Make a show builder.
    //  *
    //  * @param mixed $id
    //  * @return Show
    //  */
    // protected function detail($id)
    // {
    //     $show = new Show(Kgrct::findOrFail($id));

    //     $show->field('AR_CD', __('AR CD'));
    //     $show->field('htm1', __('Htm1'));
    //     $show->field('htm2', __('Htm2'));
    //     $show->field('htm3', __('Htm3'));
    //     $show->field('htm4', __('Htm4'));
    //     $show->field('htm5', __('Htm5'));
    //     $show->field('htm6', __('Htm6'));
    //     $show->field('htm7', __('Htm7'));
    //     $show->field('htm8', __('Htm8'));
    //     $show->field('htm9', __('Htm9'));
    //     $show->field('htm10', __('Htm10'));
    //     $show->field('htm11', __('Htm11'));
    //     $show->field('htm12', __('Htm12'));
    //     $show->field('htm13', __('Htm13'));
    //     $show->field('htm14', __('Htm14'));
    //     $show->field('value1', __('Value1'));
    //     $show->field('created_at', __('Created at'));
    //     $show->field('updated_at', __('Updated at'));

    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Kgrct);

    //     $form->text('htm1', __('Htm1'));
    //     $form->text('htm2', __('Htm2'));
    //     $form->text('htm3', __('Htm3'));
    //     $form->text('htm4', __('Htm4'));
    //     $form->text('htm5', __('Htm5'));
    //     $form->text('htm6', __('Htm6'));
    //     $form->text('htm7', __('Htm7'));
    //     $form->text('htm8', __('Htm8'));
    //     $form->text('htm9', __('Htm9'));
    //     $form->text('htm10', __('Htm10'));
    //     $form->text('htm11', __('Htm11'));
    //     $form->text('htm12', __('Htm12'));
    //     $form->text('htm13', __('Htm13'));
    //     $form->text('htm14', __('Htm14'));
    //     $form->text('value1', __('Value1'));

    //     return $form;
    // }
}
