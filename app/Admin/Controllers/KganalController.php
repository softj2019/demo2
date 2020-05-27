<?php

namespace App\Admin\Controllers;

use App\Kganal;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KganalController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '분석요청시 분석할 로우 데이터가 저장';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kganal);

        $grid->column('AR_CD', __('AR CD'));
        $grid->column('PR_NUM', __('PR NUM'));
        $grid->column('prstatus', __('Prstatus'));
        $grid->column('prm', __('Prm'));
        $grid->column('probj', __('Probj'));
        $grid->column('plant', __('Plant'));
        $grid->column('prloc', __('Prloc'));
        $grid->column('FL_CD', __('FL CD'));
        $grid->column('PR_CD', __('PR CD'));
        $grid->column('FL_TAG', __('FL TAG'));
        $grid->column('prfdate', __('Prfdate'));
        $grid->column('sdate', __('Sdate'));
        $grid->column('stime', __('Stime'));
        $grid->column('edate', __('Edate'));
        $grid->column('etime', __('Etime'));
        $grid->column('break_nm', __('Break nm'));
        $grid->column('break_cd', __('Break cd'));
        $grid->column('cause_nm', __('Cause nm'));
        $grid->column('cause_cd', __('Cause cd'));
        $grid->column('action_nm', __('Action nm'));
        $grid->column('action_cd', __('Action cd'));
        $grid->column('code1', __('Code1'));
        $grid->column('code2', __('Code2'));
        $grid->column('code3', __('Code3'));
        $grid->column('code4', __('Code4'));
        $grid->column('code5', __('Code5'));
        $grid->column('code6', __('Code6'));
        $grid->column('code7', __('Code7'));
        $grid->column('code8', __('Code8'));
        $grid->column('code9', __('Code9'));
        $grid->column('code10', __('Code10'));
        $grid->column('code11', __('Code11'));
        $grid->column('bhour', __('Bhour'));
        $grid->column('mhour', __('Mhour'));
        $grid->column('bstat', __('Bstat'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        $grid->model()->orderBy('PR_NUM', 'desc'); //기본 정렬순서
        // $grid->quickSearch('처방처명', '주소', '제약사', '제품', '분류');    
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
    // protected function detail($PR_NUM)
    // {
    //     $show = new Show(Kganal::findOrFail($PR_NUM));

    //     $show->field('AR_CD', __('AR CD'));
    //     $show->field('PR_NUM', __('PR NUM'));
    //     $show->field('prstatus', __('Prstatus'));
    //     $show->field('prm', __('Prm'));
    //     $show->field('probj', __('Probj'));
    //     $show->field('plant', __('Plant'));
    //     $show->field('prloc', __('Prloc'));
    //     $show->field('FL_CD', __('FL CD'));
    //     $show->field('PR_CD', __('PR CD'));
    //     $show->field('FL_TAG', __('FL TAG'));
    //     $show->field('prfdate', __('Prfdate'));
    //     $show->field('sdate', __('Sdate'));
    //     $show->field('stime', __('Stime'));
    //     $show->field('edate', __('Edate'));
    //     $show->field('etime', __('Etime'));
    //     $show->field('break_nm', __('Break nm'));
    //     $show->field('break_cd', __('Break cd'));
    //     $show->field('cause_nm', __('Cause nm'));
    //     $show->field('cause_cd', __('Cause cd'));
    //     $show->field('action_nm', __('Action nm'));
    //     $show->field('action_cd', __('Action cd'));
    //     $show->field('code1', __('Code1'));
    //     $show->field('code2', __('Code2'));
    //     $show->field('code3', __('Code3'));
    //     $show->field('code4', __('Code4'));
    //     $show->field('code5', __('Code5'));
    //     $show->field('code6', __('Code6'));
    //     $show->field('code7', __('Code7'));
    //     $show->field('code8', __('Code8'));
    //     $show->field('code9', __('Code9'));
    //     $show->field('code10', __('Code10'));
    //     $show->field('code11', __('Code11'));
    //     $show->field('bhour', __('Bhour'));
    //     $show->field('mhour', __('Mhour'));
    //     $show->field('bstat', __('Bstat'));
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
    //     $form = new Form(new Kganal);

    //     $form->text('AR_CD', __('AR CD'));
    //     $form->text('prstatus', __('Prstatus'));
    //     $form->text('prm', __('Prm'));
    //     $form->text('probj', __('Probj'));
    //     $form->text('plant', __('Plant'));
    //     $form->text('prloc', __('Prloc'));
    //     $form->text('FL_CD', __('FL CD'));
    //     $form->text('PR_CD', __('PR CD'));
    //     $form->text('FL_TAG', __('FL TAG'));
    //     $form->date('prfdate', __('Prfdate'))->default(date('Y-m-d'));
    //     $form->date('sdate', __('Sdate'))->default(date('Y-m-d'));
    //     $form->time('stime', __('Stime'))->default(date('H:i:s'));
    //     $form->date('edate', __('Edate'))->default(date('Y-m-d'));
    //     $form->time('etime', __('Etime'))->default(date('H:i:s'));
    //     $form->text('break_nm', __('Break nm'));
    //     $form->text('break_cd', __('Break cd'));
    //     $form->text('cause_nm', __('Cause nm'));
    //     $form->text('cause_cd', __('Cause cd'));
    //     $form->text('action_nm', __('Action nm'));
    //     $form->text('action_cd', __('Action cd'));
    //     $form->date('code1', __('Code1'))->default(date('Y-m-d'));
    //     $form->date('code2', __('Code2'))->default(date('Y-m-d'));
    //     $form->date('code3', __('Code3'))->default(date('Y-m-d'));
    //     $form->time('code4', __('Code4'))->default(date('H:i:s'));
    //     $form->date('code5', __('Code5'))->default(date('Y-m-d'));
    //     $form->time('code6', __('Code6'))->default(date('H:i:s'));
    //     $form->date('code7', __('Code7'))->default(date('Y-m-d'));
    //     $form->time('code8', __('Code8'))->default(date('H:i:s'));
    //     $form->text('code9', __('Code9'));
    //     $form->date('code10', __('Code10'))->default(date('Y-m-d'));
    //     $form->time('code11', __('Code11'))->default(date('H:i:s'));
    //     $form->number('bhour', __('Bhour'));
    //     $form->number('mhour', __('Mhour'));
    //     $form->text('bstat', __('Bstat'));

    //     return $form;
    // }
}
