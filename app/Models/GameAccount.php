<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class GameAccount extends Model
{

    protected $table = 'game_account';
    public $timestamps = false;

    public function computer()
    {
        return $this->belongsTo(Computer::class,'pc_id','id');
    }

    public function vpn()
    {
        return $this->belongsTo(Vpn::class,'ip_id','id');
    }
}
