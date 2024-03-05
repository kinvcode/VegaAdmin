<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Appversion;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

class AppversionController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Appversion(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('version');
            $grid->column('download_link');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();

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
        return Show::make($id, new Appversion(), function (Show $show) {
            $show->field('id');
            $show->field('version');
            $show->field('download_link');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Appversion(), function (Form $form) {

            $version = DB::table('appversion')->orderBy('id')->value('version');
            $version = (int)$version;
            $form->display('id');
            $form->text('version')->default($version+1);
            $form->file('download_link')->uniqueName()->accept('exe');;
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
