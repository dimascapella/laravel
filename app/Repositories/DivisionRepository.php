<?php

namespace App\Repositories;

use App\Interfaces\DivisionRepositoryInterface;
use App\Models\Division;

class DivisionRepository implements DivisionRepositoryInterface{
    public function getAllDivision(){
        return Division::all();
    }
}