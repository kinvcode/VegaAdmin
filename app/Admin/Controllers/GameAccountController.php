<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\GameAccount;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GameAccountController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new GameAccount(['computer','vpn']), function (Grid $grid) {
//            $grid->column('id')->sortable();
            $grid->column('computer.pc_name','所属机器');
            $grid->column('vpn.remark','所属IP');
            $grid->column('email');
            $grid->column('email_password');
            $grid->column('account');
            $grid->column('password');
            $grid->column('game_status');
            $grid->column('user_nums');
            $grid->column('bind_email');
            $grid->column('account_created');
            $grid->column('user_created');
            $grid->column('restriction_times');
            $grid->column('restriction_time');
            $grid->column('blocked_times');
            $grid->column('blocked_time');
//            $grid->column('owner_ip');
//            $grid->column('owner_pc');

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
        return Show::make($id, new GameAccount(['computer','vpn']), function (Show $show) {
//            $show->field('id');
            $show->field('computer.pc_name','所属机器');
            $show->field('vpn.remark','所属IP');
            $show->field('email');
            $show->field('email_password');
            $show->field('account');
            $show->field('password');
            $show->field('game_status');
            $show->field('user_nums');
            $show->field('bind_email');
            $show->field('account_created');
            $show->field('user_created');
            $show->field('restriction_times');
            $show->field('restriction_time');
            $show->field('blocked_times');
            $show->field('blocked_time');

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new GameAccount(), function (Form $form) {
            $form->display('id');
            $form->select('pc_id')->options('/api/computers')->load('ip_id','/api/vpns');
            $form->select('ip_id');
            $form->email('email');
            $form->text('email_password');
            $form->text('account');
            $form->text('password');
            if($form->isEditing())
            {
                $form->text('game_status');
                $form->text('user_nums');
                $form->text('bind_email');
                $form->text('account_created');
                $form->text('user_created');
                $form->text('restriction_times');
                $form->text('restriction_time');
                $form->text('blocked_times');
                $form->text('blocked_time');
            }
        });
    }

    public function accountList(Request $request)
    {
        $ip_id = $request->get('q');

        $data = DB::table('game_account')->where('ip_id',$ip_id)->get();

        $response = [];
        foreach ($data as $item)
        {
            $response[] = [
                'id' => $item->id,
                'text'=>$item->email
            ];
        }

        return $response;
    }
}
