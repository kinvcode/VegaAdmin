<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Computer;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Support\Facades\DB;

class ComputerController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Computer(), function (Grid $grid) {
//            $grid->column('id')->sortable();
            $grid->column('pc_name');

//            $grid->filter(function (Grid\Filter $filter) {
//                $filter->equal('id');
//            });
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
        return Show::make($id, new Computer(), function (Show $show) {
            $show->field('id');
            $show->field('pc_name');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Computer(), function (Form $form) {
            $form->display('id');
            $form->text('pc_name');
        });
    }

    public function computerList()
    {
        $data = DB::table('computers')->get();

        $response = [];
        foreach ($data as $item)
        {
            $response[] = [
                'id' => $item->id,
                'text'=>$item->pc_name
            ];
        }

        return $response;
    }
}
