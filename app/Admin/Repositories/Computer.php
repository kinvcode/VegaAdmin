<?php

namespace App\Admin\Repositories;

use App\Models\Computer as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Computer extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
