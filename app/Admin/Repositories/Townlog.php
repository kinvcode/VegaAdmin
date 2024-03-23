<?php

namespace App\Admin\Repositories;

use App\Models\Townlog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Townlog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
