<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Townlog extends Model
{

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(GameUser::class,'game_user_id','id');
    }
}
