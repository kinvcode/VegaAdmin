<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function lastfile()
    {
        $link = DB::table('appversion')->orderBy('id','desc')->value('download_link');

        if($link != ''){
            return response()->download(storage_path('app/public/').$link, 'Vega.exe');
        }
        return null;
    }
}
