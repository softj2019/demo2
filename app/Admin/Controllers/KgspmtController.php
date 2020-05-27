<?php

namespace App\Admin\Controllers;

use App\Kgspmt;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KgspmtController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '생산/공급설비 마스터';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kgspmt);

        $grid->column('PR_CD', __('PR CD'));
        $grid->column('prstatus', __('Prstatus'));
        $grid->column('prdate', __('Prdate'));
        $grid->column('prtag', __('Prtag'));
        $grid->column('prmade', __('Prmade'));
        $grid->column('pr', __('Pr'));
        $grid->column('prkey', __('Prkey'));
        $grid->column('prmain', __('Prmain'));
        $grid->column('prloc', __('Prloc'));
        $grid->column('prcost', __('Prcost'));
        $grid->column('prcost2', __('Prcost2'));
        $grid->column('prfdate', __('Prfdate'));

        $grid->model()->orderBy('PR_CD', 'desc'); //기본 정렬순서
        $grid->quickSearch('prtag', 'prmade', 'pr', 'prcost2');    
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
    //     $show = new Show(Kgspmt::findOrFail($id));

    //     $show->field('PR_CD', __('PR CD'));
    //     $show->field('prstatus', __('Prstatus'));
    //     $show->field('prdate', __('Prdate'));
    //     $show->field('prtag', __('Prtag'));
    //     $show->field('prmade', __('Prmade'));
    //     $show->field('pr', __('Pr'));
    //     $show->field('prkey', __('Prkey'));
    //     $show->field('prmain', __('Prmain'));
    //     $show->field('prloc', __('Prloc'));
    //     $show->field('prcost', __('Prcost'));
    //     $show->field('prcost2', __('Prcost2'));
    //     $show->field('prfdate', __('Prfdate'));

    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Kgspmt);

    //     $form->text('prstatus', __('Prstatus'));
    //     $form->date('prdate', __('Prdate'))->default(date('Y-m-d'));
    //     $form->text('prtag', __('Prtag'));
    //     $form->text('prmade', __('Prmade'));
    //     $form->text('pr', __('Pr'));
    //     $form->text('prkey', __('Prkey'));
    //     $form->text('prmain', __('Prmain'));
    //     $form->text('prloc', __('Prloc'));
    //     $form->text('prcost', __('Prcost'));
    //     $form->text('prcost2', __('Prcost2'));
    //     $form->date('prfdate', __('Prfdate'))->default(date('Y-m-d'));

    //     return $form;
    // }
}
