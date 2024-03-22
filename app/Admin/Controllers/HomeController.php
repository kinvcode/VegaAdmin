<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\Examples;
use App\Http\Controllers\Controller;
use Dcat\Admin\Admin;
use Dcat\Admin\Http\Controllers\Dashboard;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Modal;
use Dcat\Admin\Widgets\Table;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
//    use PreviewCode;
    public function index(Content $content)
    {
        return $content
            ->header('Dashboard')
            ->description('Description...')
            ->body(function (Row $row) {
                $row->column(6, function (Column $column) {
                    $column->row($this->title());
                    $column->row(new Examples\Tickets());
                });

                $row->column(6, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(6, new Examples\NewUsers());
                        $row->column(6, new Examples\NewDevices());
                    });

                    $column->row(new Examples\Sessions());
                    $column->row(new Examples\ProductOrders());
                });
            });
    }

    protected function title()
    {
        return <<<HTML
<style>
.number {
    display: flex;
    height: 3rem;
    justify-content: center;
    align-items: center;
    background-image: linear-gradient(to right, #fad0c4 0%, #fad0c4 1%, #ffd1ff 100%);
    cursor: pointer;
}
</style>
<div class="dashboard-title card bg-white50">
    <div class="card-body">
        <div class="row" style="margin-top: 3rem">
            <div class="col-3">
                {$this->allPCModal()}
            </div>
        </div>
    </div>
</div>
HTML;
    }



    protected function allPCModal()
    {
        return Modal::make()
            ->lg()
            ->title('所有机器今日任务')
            ->body($this->allPCTable())
            ->button("<button class='btn card number'>所有机器任务</button>");
    }

    protected function allPCTable()
    {
        Admin::style('.table td{padding: .85rem .55rem}');

        $data = [];

        $today_five_pm_timestamp = strtotime("today 17:00");
        $two_days_ago_timestamp = strtotime("-2 days 17:00");
        $current_timestamp = time();
        $current_hour = date("H", $current_timestamp);
        $current_weekday = date("w", $current_timestamp);
        $vpslist = DB::table('vpn')->orderBy('pc_id')->get();

        foreach ($vpslist as $vps) {
            $accounts = DB::table('game_account')
                ->where('pc_id',$vps->pc_id)
                ->where('ip_id', $vps->id)
                ->get();
            $pc_name = DB::table('computers')->where('id', $vps->pc_id)->value('pc_name');

            // 检测创建账号频率：IP下是否存在账号
            $create_account = ['pc' => $pc_name, 'ip' => $vps->remark,'account'=>'-', 'action' => '创建账号和角色'];
            if ($accounts->isEmpty()) {
                // 不存在账号：直接创建
                $data[] = $create_account;
            } else {

                foreach ($accounts as $account)
                {
                    // 找到最近创建的账号

                    $account_last_created = DB::table('game_account')
                        ->where('ip_id', $vps->id)
                        ->orderBy('account_created', 'desc')
                        ->value('account_created');
                    // 创建时间是否是昨天
                    if ($today_five_pm_timestamp - strtotime($account_last_created) > 0) {
                        $data[] = $create_account;
                    }

                    $users = DB::table('game_users')
                        ->where('account_id', $account->id)
                        ->get();
                    if($users->isNotEmpty()){
                        // 检测可升级账号
                        foreach ($users as $user){
                            // 执行方案
                            $upgrade_level = ['pc'=>$pc_name,'ip'=>$vps->remark,'account'=>$account->email,'action'=>'升级'];
                            switch ($account->plan){
                                case 1:
                                    // 检查创建角色时间是否是昨天
                                    if($today_five_pm_timestamp - strtotime($account->account_created) > 0)
                                    {
                                        if($user->last_online_time){
                                            if($today_five_pm_timestamp - strtotime($user->last_online_time) > 86400)
                                            {
                                                $data[] = $upgrade_level;
                                            }
                                        }else{
                                            $data[] = $upgrade_level;
                                        }
                                    }
                                    break;
                                case 2:
                                    // 检查创建角色时间是否是昨天
                                    if($today_five_pm_timestamp - strtotime($account->account_created) > 0)
                                    {
                                        if($user->last_online_time){
                                            if($today_five_pm_timestamp - strtotime($user->last_online_time) > 172800)
                                            {
                                                $data[] = $upgrade_level;
                                            }
                                        }else{
                                            $data[] = $upgrade_level;
                                        }
                                    }
                                    break;
                                case 3:
                                    if (($current_weekday == 3 && $current_hour >= 17) || ($current_weekday == 4 && $current_hour < 17)) {
                                        $data[] = $upgrade_level;
                                    }
                                    break;
                                case 4:
                                    $data[] = $upgrade_level;
                                    break;
                                default:
                                    $upgrade_level['action'] = '无';
                                    $data[] = $upgrade_level;
                                    break;
                            }
                        }
                    }
                }
            }
        }

        return Table::make(['机器', 'ip','账号', '行为'], $data);
    }
}
