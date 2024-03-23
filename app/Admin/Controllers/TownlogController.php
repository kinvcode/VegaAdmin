<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Townlog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class TownlogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Townlog(), function (Grid $grid) {
//            $grid->column('id')->sortable();
            $grid->column('game_user_id');
            $grid->column('level');
            $grid->column('fame');
            $grid->column('fatigue');
            $grid->column('datetime');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');

            });
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new Townlog(), function (Show $show) {
            $show->field('id');
            $show->field('game_user_id');
            $show->field('level');
            $show->field('fame');
            $show->field('fatigue');
            $show->field('datetime');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Townlog(), function (Form $form) {
            $form->display('id');
            $form->text('game_user_id');
            $form->text('level');
            $form->text('fame');
            $form->text('fatigue');
            $form->text('datetime');
        });
    }
}