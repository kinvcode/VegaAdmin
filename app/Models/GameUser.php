<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class GameUser extends Model
{

    protected $table = 'game_users';
    public $timestamps = false;

    public function computer()
    {
        return $this->belongsTo(Computer::class,'pc_id','id');
    }

    public function vpn()
    {
        return $this->belongsTo(Vpn::class,'ip_id','id');
    }

    public function account()
    {
        return $this->belongsTo(GameAccount::class,'account_id','id');
    }

    public function clean_times()
    {
        $today_five= date('Y-m-d H:i:s',strtotime("today 17:00"));
        return $this->hasMany(CleanDungeonLog::class,'game_user_id','id')->where('clean_dungeon_logs.clearance_time','>',$today_five);
    }
}
