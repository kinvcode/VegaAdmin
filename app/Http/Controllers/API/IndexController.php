<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function lastversion()
    {
        $data = [];
        $version = DB::table('appversion')->orderBy('id','desc')->value('version');
        $version = (int)$version;
        $data["version"] = $version;
        return $data;
    }
}
