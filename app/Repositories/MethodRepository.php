<?php

namespace App\Repositories;

use App\Interfaces\MethodRepositoryInterface;
use App\Models\Method;

class MethodRepository implements MethodRepositoryInterface{
    public function getAllMethod(){
        return Method::all();
    }
}