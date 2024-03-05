<?php

namespace App\Admin\Repositories;

use App\Models\Appversion as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Appversion extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
