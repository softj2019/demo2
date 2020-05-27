<?php

namespace App\Admin\Controllers;

use App\Kgmtb;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KgmtbController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '분석모듈실시간사용정보';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kgmtb);

        $grid->column('SEQ', __('SEQ'));
        $grid->column('name', __('Name'));
        $grid->column('status', __('Status'));
        $grid->column('AR_CD', __('AR CD'));
        $grid->column('pid', __('Pid'));
        $grid->column('user', __('User'));
        $grid->column('time', __('Time'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show = new Show(Kgmtb::findOrFail($id));

        $show->field('SEQ', __('SEQ'));
        $show->field('name', __('Name'));
        $show->field('status', __('Status'));
        $show->field('AR_CD', __('AR CD'));
        $show->field('pid', __('Pid'));
        $show->field('user', __('User'));
        $show->field('time', __('Time'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Kgmtb);

        $form->number('SEQ', __('SEQ'));
        $form->text('status', __('Status'))->default('W');
        $form->text('AR_CD', __('AR CD'));
        $form->text('pid', __('Pid'));
        $form->text('user', __('User'));
        $form->text('time', __('Time'));

        return $form;
    }
}
