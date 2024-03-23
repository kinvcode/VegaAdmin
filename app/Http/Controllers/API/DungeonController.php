<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DungeonController extends Controller
{

    public function clearDungeon(Request $request)
    {
        // 人物名称 进入时间、通关时间、通关时长、进入时金币、通关时金币、结算金币、进入时装备个数、通关时装备个数、副本ID、人物等级、人物名望、人物疲劳
        $params = [
            'username',
            'entry_time',
            'clearance_time',
            'time_cost',
            'start_gold',
            'end_gold',
            'gold_reward',
            'start_equipments',
            'end_equipments',
            'equipment_reward',
            'dungeon_id',
            'level',
            'fame',
            'fatigue'
        ];

        if(!$request->exists('clearance_time'))
        {
            return;
        }

        $data = [];
        foreach ($params as $value) {
            if ($request->exists($value)) {
                $data[$value] = $request->get($value);
            }
        }

        if (empty($data) || empty($data['username'])) {
            return;
        }

        // 如果角色不存在，则创建
        $user_exists = DB::table('game_users')->where('name', $data['username'])->exists();
        if (!$user_exists) {
            return;
        }

        $user_id = DB::table('game_users')->where('name', $data['username'])->value('id');

        $data['game_user_id'] = $user_id;
        unset($data['username']);

        // 写入通关日志
        DB::table('clean_dungeon_logs')->insert($data);
    }
}
