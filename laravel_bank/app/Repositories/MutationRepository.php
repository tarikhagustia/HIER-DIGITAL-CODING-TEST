<?php
/**
 * Created by PhpStorm.
 * User: tarikhagustua
 * Date: 3/27/2019
 * Time: 8:32 PM
 */

namespace App\Repositories;

use App\Models\Mutation;

class MutationRepository
{
    protected $model;

    public function __construct(Mutation $model)
    {
        $this->model = $model;
    }

    public function getPaginate()
    {
        return $this->model->paginate(10);
    }
}