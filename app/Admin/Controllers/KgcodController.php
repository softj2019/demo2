<?php

namespace App\Admin\Controllers;

use App\Kgcod;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class KgcodController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '고장유형코드';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Kgcod);

        $grid->column('num_cd', __('Num cd'));
        $grid->column('num_nm', __('Num nm'));
        $grid->model()->orderBy('num_cd', 'desc'); //기본 정렬순서
        $grid->quickSearch('num_cd', 'num_nm');    
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
    //     $show = new Show(Kgcod::findOrFail($id));

    //     $show->field('num_cd', __('Num cd'));
    //     $show->field('num_nm', __('Num nm'));

    //     return $show;
    // }

    // /**
    //  * Make a form builder.
    //  *
    //  * @return Form
    //  */
    // protected function form()
    // {
    //     $form = new Form(new Kgcod);

    //     $form->text('num_nm', __('Num nm'));

    //     return $form;
    // }
}
