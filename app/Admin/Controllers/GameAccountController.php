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
    // 方案说明
    // 方案1：隔一天玩一次，比如1号玩，然后3号再玩
    // 方案2：隔两天玩一次，比如1号玩，然后4号再玩
    // 方案3：固定星期三玩一次
    // 方案4：每天都玩
    public $plans = [
        0 => '无',
        1 => '方案1',
        2 => '方案2',
        3 => '方案3',
        4 => '方案4'
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $controller = $this;
        return Grid::make(new GameAccount(['computer', 'vpn']), function (Grid $grid) use ($controller) {
            $grid->model()->orderBy('pc_id');
//            $grid->column('id')->sortable();
            $grid->column('computer.pc_name', '所属机器');
            $grid->column('vpn.remark', '所属IP');
            $grid->column('email');
            $grid->column('email_password');
            $grid->column('account');
            $grid->column('password');
            $grid->column('plan')->display(function ($plan) use ($controller) {
                $plan = (integer)$plan;
                return $controller->plans[$plan];
            });
//            $grid->column('game_status');
//            $grid->column('user_nums');
//            $grid->column('bind_email');
            $grid->column('account_created');
//            $grid->column('user_created');
//            $grid->column('restriction_times');
//            $grid->column('restriction_time');
//            $grid->column('blocked_times');
//            $grid->column('blocked_time');
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
        return Show::make($id, new GameAccount(['computer', 'vpn']), function (Show $show) {
//            $show->field('id');
            $show->field('computer.pc_name', '所属机器');
            $show->field('vpn.remark', '所属IP');
            $show->field('email');
            $show->field('email_password');
            $show->field('account');
            $show->field('password');
            $show->field('game_status');
            $show->field('user_nums');
            $show->field('bind_email');
            $show->field('account_created');
//            $show->field('user_created');
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
        $controller = $this;
        return Form::make(new GameAccount(), function (Form $form) use ($controller) {
            $form->display('id');
            $form->select('pc_id')->options('/api/computers')->load('ip_id', '/api/vpns');
            $form->select('ip_id');
            $form->email('email');
            $form->text('email_password');
            $form->text('account');
            $form->text('password');
            $form->select('plan')->options($controller->plans);
            $form->datetime('account_created');
            if ($form->isEditing()) {
                $form->text('game_status');
                $form->text('user_nums');
                $form->text('bind_email');
//                $form->datetime('user_created');
                $form->text('restriction_times');
                $form->datetime('restriction_time');
                $form->text('blocked_times');
                $form->datetime('blocked_time');
            }
        });
    }

    public function accountList(Request $request)
    {
        $ip_id = $request->get('q');

        $data = DB::table('game_account')->where('ip_id', $ip_id)->get();

        $response = [];
        foreach ($data as $item) {
            $response[] = [
                'id' => $item->id,
                'text' => $item->email
            ];
        }

        return $response;
    }
}
