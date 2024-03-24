<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class CleanDungeonLog extends Model
{

    protected $table = 'clean_dungeon_logs';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(GameUser::class,'game_user_id','id');
    }
}
