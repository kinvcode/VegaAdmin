<?php

namespace App\Admin\Repositories;

use App\Models\GameAccount as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class GameAccount extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
