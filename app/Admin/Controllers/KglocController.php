<?php

namespace App\Admin\Controllers;

use App\Kgloc;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KglocController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '플랜트, 위치 코드';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kgloc);

        $grid->column('id', __('Id'));
        $grid->column('key1_cd', __('Key1 cd'));
        $grid->column('key1_nm', __('Key1 nm'));
        $grid->column('key2_cd', __('Key2 cd'));
        $grid->column('key2_nm', __('Key2 nm'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));
        $grid->model()->orderBy('id', 'desc'); //기본 정렬순서
        $grid->quickSearch('key1_cd', 'key1_nm', 'key2_cd', 'key2_nm');    
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
    //     $show = new Show(Kgloc::findOrFail($id));

    //     $show->field('id', __('Id'));
    //     $show->field('key1_cd', __('Key1 cd'));
    //     $show->field('key1_nm', __('Key1 nm'));
    //     $show->field('key2_cd', __('Key2 cd'));
    //     $show->field('key2_nm', __('Key2 nm'));
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
    //     $form = new Form(new Kgloc);

    //     $form->text('key1_cd', __('Key1 cd'));
    //     $form->text('key1_nm', __('Key1 nm'));
    //     $form->text('key2_cd', __('Key2 cd'));
    //     $form->text('key2_nm', __('Key2 nm'));

    //     return $form;
    // }
}
