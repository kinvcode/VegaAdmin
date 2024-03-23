<?php

namespace App\Admin\Repositories;

use App\Models\CleanDungeonLog as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class CleanDungeonLog extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
