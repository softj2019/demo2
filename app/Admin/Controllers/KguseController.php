<?php

namespace App\Admin\Controllers;

use App\Kguse;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KguseController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '사용자관리';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kguse);

        // $grid->column('id', __('Id'));
        $grid->column('password', __('비번'));
        $grid->column('email', __('이메일'));
        $grid->column('name', __('이름'));
        $grid->column('department', __('부수'));
        $grid->column('role', __('Role'));
        // $grid->column('LASTUSE', __('LASTUSE'));
        // $grid->column('TOTALUSE', __('TOTALUSE'));
        // $grid->column('created_at', __('Created at'));
        // $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Kguse::findOrFail($id));

        // $show->field('id', __('Id'));
        $show->field('password', __('Password'));
        $show->field('email', __('Email'));
        $show->field('name', __('Name'));
        $show->field('department', __('Department'));
        $show->field('role', __('Role'));
        // $show->field('LASTUSE', __('LASTUSE'));
        // $show->field('TOTALUSE', __('TOTALUSE'));
        // $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Kguse);

        $form->password('password', __('Password'));
        $form->email('email', __('Email'));
        $form->text('name', __('Name'));
        $form->text('department', __('Department'));
        $form->text('role', __('Role'));
        // $form->datetime('LASTUSE', __('LASTUSE'))->default(date('Y-m-d H:i:s'));
        // $form->number('TOTALUSE', __('TOTALUSE'));

        return $form;
    }
}
