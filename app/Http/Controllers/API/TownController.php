<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TownController extends Controller
{
    public function updateUserTownInfo(Request $request)
    {
        $params = ['username', 'level', 'character_base', 'character_class', 'fame', 'fatigue'];
        $data = [];
        foreach ($params as $value) {
            if ($request->exists($value)) {
                $data[$value] = $request->get($value);
            }
        }

        if (empty($data) || empty($data['username'])) {
            return;
        }

        $cur_date = date('Y-m-d H:i:s');
        $update_data = [
            'name' => $data['username'],
            'level' => $data['level'],
            'character_base' => $data['character_base'],
            'character_class' => $data['character_class'],
            'fame' => $data['fame'],
            'last_online_time' => $cur_date,
        ];

        // 如果角色不存在，则创建
        $user_exists = DB::table('game_users')->where('name', $data['username'])->exists();
        if (!$user_exists) {
            $update_data['created_time'] = $cur_date;
            DB::table('game_users')->insert($update_data);
        } else {
            DB::table('game_users')->where('name', $data['username'])->update($update_data);
        }

        $user = DB::table('game_users')->where('name', $data['username'])->first();

        // 写入城镇日志：等级、名望、疲劳
        $log_exists = DB::table('townlogs')->where('game_user_id', $user->id)->exists();
        if ($log_exists) {
            $last_log_date = DB::table('townlogs')->where('game_user_id', $user->id)->value('datetime');
            if (time() - strtotime($last_log_date) < 30) {
                return;
            }
        }
        DB::table('townlogs')->insert([
            'game_user_id' => $user->id,
            'level' => $data['level'],
            'fame' => $data['fame'],
            'fatigue' => $data['fatigue'],
            'datetime' => $cur_date,
        ]);
    }
}
