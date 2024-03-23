<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('appversion','AppversionController');
    $router->resource('accounts','GameAccountController');
    $router->resource('vps','VpnController');
    $router->resource('computers','ComputerController');
    $router->resource('gameusers','GameUserController');
    $router->resource('townlogs','TownlogController');
    $router->resource('cleandungeonlogs','CleanDungeonLogController');

    $router->group([
        'prefix'=>'api'
    ],function(Router $router){
        $router->get('computers','ComputerController@computerList');
        $router->get('vpns','VpnController@vpnList');
        $router->get('accounts','GameAccountController@accountList');
        $router->get('character_bases','GameUserController@characterBase');
        $router->get('character_classes','GameUserController@characterClass');
    });
});
