<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Vpn extends Model
{

    protected $table = 'vpn';
    public $timestamps = false;

    public function computer()
    {
        return $this->belongsTo(Computer::class,'pc_id','id');
    }
}
