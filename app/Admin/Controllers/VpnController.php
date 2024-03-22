<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Vpn;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VpnController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Vpn(['computer']), function (Grid $grid) {
//            $grid->column('id')->sortable();
            $grid->column('computer.pc_name','所属机器');
//            $grid->column('IP');
            $grid->column('remark');
//            $grid->column('password');
//            $grid->column('port');
            $grid->column('area');
            $grid->column('platform')->display(function($platform){
                $link = "<a href='$this->platform_web'>$platform</a>";
                return $link;
            });
//            $grid->column('platform_web');
//            $grid->column('price');
//            $grid->column('payment_cycle');
            $grid->column('expiration_date');
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
        return Show::make($id, new Vpn(), function (Show $show) {
            $show->field('id');
            $show->field('IP');
            $show->field('password');
            $show->field('port');
            $show->field('pc_id');
            $show->field('remark');
            $show->field('vmess');
            $show->field('area');
            $show->field('platform');
            $show->field('platform_web');
            $show->field('price');
            $show->field('payment_cycle');
            $show->field('expiration_date');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new Vpn(), function (Form $form) {
            $form->display('id');
            $form->select('pc_id')->options('/api/computers');
            $form->text('IP');
            $form->text('password');
            $form->number('port')->default(22);
            $form->text('remark');
            $form->text('vmess');
            $form->text('area');
            $form->text('platform');
            $form->text('platform_web');
            $form->text('price');
            $form->text('payment_cycle');
            $form->text('expiration_date');
        });
    }

    public function vpnList(Request $request)
    {
        $pc_id = $request->get('q');

        $data = DB::table('vpn')->where('pc_id',$pc_id)->get();

        $response = [];
        foreach ($data as $item)
        {
            $response[] = [
                'id' => $item->id,
                'text'=>$item->remark
            ];
        }

        return $response;
    }
}
