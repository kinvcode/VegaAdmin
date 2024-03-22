<?php

namespace App\Admin\Repositories;

use App\Models\Vpn as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Vpn extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
