<?php

namespace App\Admin\Controllers;

use App\Kgsbt;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KgsbtController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '공급설비기능위치';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kgsbt);

        // $grid->column('id', __('Id'));
        $grid->column('key3_cd', __('Key3 cd'));
        $grid->column('key3_nm', __('Key3 nm'));
        $grid->column('key4_cd', __('Key4 cd'));
        $grid->column('key4_nm', __('Key4 nm'));
        $grid->column('key5_cd', __('Key5 cd'));
        $grid->column('key5_nm', __('Key5 nm'));
        $grid->column('FL_CD', __('FL CD'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));
        $grid->model()->orderBy('id', 'desc'); //기본 정렬순서
        $grid->quickSearch('key3_cd', 'key3_nm', 'key4_cd', 'key4_nm', 'key5_cd', 'key5_nm', 'FL_CD');    
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
    //     $show = new Show(Kgsbt::findOrFail($id));

    //     $show->field('id', __('Id'));
    //     $show->field('key3_cd', __('Key3 cd'));
    //     $show->field('key3_nm', __('Key3 nm'));
    //     $show->field('key4_cd', __('Key4 cd'));
    //     $show->field('key4_nm', __('Key4 nm'));
    //     $show->field('key5_cd', __('Key5 cd'));
    //     $show->field('key5_nm', __('Key5 nm'));
    //     $show->field('FL_CD', __('FL CD'));
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
    //     $form = new Form(new Kgsbt);

    //     $form->text('key3_cd', __('Key3 cd'));
    //     $form->text('key3_nm', __('Key3 nm'));
    //     $form->text('key4_cd', __('Key4 cd'));
    //     $form->text('key4_nm', __('Key4 nm'));
    //     $form->text('key5_cd', __('Key5 cd'));
    //     $form->text('key5_nm', __('Key5 nm'));
    //     $form->text('FL_CD', __('FL CD'));

    //     return $form;
    // }
}
