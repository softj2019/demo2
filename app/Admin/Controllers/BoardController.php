<?php

namespace App\Admin\Controllers;

use App\Board;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class BoardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '도움말';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Board);
        $grid->column('id', __('연번'));
        $grid->column('분류', __('분류'))->label('success');
        $grid->column('name', __('작성자'))->display(function(){
            return "<a href='/board/".$this->id."/edit'>".$this->name."</a>";
        });
        // $grid->column('pw', __('Pw'));
        $grid->column('title', __('제목'))->display(function(){
            return "<a href='/board/".$this->id."/edit'>".$this->title."</a>";
        });
        $grid->column('content', __('내용'))->display(function(){
            return "<a href='/board/".$this->id."/edit'><div style='width:500px;color:blue;'>$this->content</div></a>";
        });
        // $grid->column('date', __('Date'));
        // $grid->column('hit', __('Hit'));
        $grid->column('created_at', __('생성일'))->date('Y-m-d');
        $grid->column('updated_at', __('수정일'))->date('Y-m-d');
        
        $grid->model()->orderBy('id', 'desc'); //기본 정렬순서
        $grid->quickSearch('작성자', '제목', '내용');    
        $grid->fixColumns(2, 0);

        // $grid->disableActions();
        $grid->disableFilter();    
        // $grid->disableRowSelector();
        $grid->disableColumnSelector();
        // $grid->disableCreateButton();
        $grid->disableExport();
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
        $show = new Show(Board::findOrFail($id));

        $show->field('id', __('연번'));
        $show->field('created_at', __('생성일'));
        $show->field('updated_at', __('수정일'));
        $show->field('name', __('작성자'));
        // $show->field('pw', __('Pw'));
        $show->field('분류', __('분류'));
        $show->field('title', __('제목'));
        $show->field('content', __('내용'));
        // $show->field('date', __('Date'));
        // $show->field('hit', __('Hit'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Board);

        $form->text('name', __('작성자'));
        // $form->text('pw', __('Pw'));
        
        $form->text('분류', __('분류'));
        $form->text('title', __('제목'));
        $form->textarea('content', __('내용'));
        $form->date('date', __('작성일'))->default(date('Y-m-d'));
        // $form->number('hit', __('Hit'));

        return $form;
    }
}
