<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CleanDungeonLog;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class CleanDungeonLogController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CleanDungeonLog(), function (Grid $grid) {
//            $grid->column('id')->sortable();
            $grid->column('game_user_id');
            $grid->column('entry_time');
            $grid->column('clearance_time');
            $grid->column('time_cost');
            $grid->column('start_gold');
            $grid->column('end_gold');
            $grid->column('gold_reward');
            $grid->column('start_equipments');
            $grid->column('end_equipments');
            $grid->column('equipment_reward');
            $grid->column('dungeon_id');
            $grid->column('level');
            $grid->column('fame');
            $grid->column('fatigue');

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
        return Show::make($id, new CleanDungeonLog(), function (Show $show) {
            $show->field('id');
            $show->field('entry_time');
            $show->field('clearance_time');
            $show->field('start_gold');
            $show->field('end_gold');
            $show->field('fatigue');
            $show->field('start_equipments');
            $show->field('end_equipments');
            $show->field('equipment_reward');
            $show->field('dungeon_id');
            $show->field('level');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new CleanDungeonLog(), function (Form $form) {
            $form->display('id');
            $form->text('entry_time');
            $form->text('clearance_time');
            $form->text('start_gold');
            $form->text('end_gold');
            $form->text('fatigue');
            $form->text('start_equipments');
            $form->text('end_equipments');
            $form->text('equipment_reward');
            $form->text('dungeon_id');
            $form->text('level');
        });
    }
}
