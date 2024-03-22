<?php

namespace App\Admin\Repositories;

use App\Models\GameUser as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class GameUser extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
