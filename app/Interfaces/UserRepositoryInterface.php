<?php

namespace App\Interfaces;

interface UserRepositoryInterface{
    public function getAllUser();
    public function createUser($data);
    public function findById($id);
    public function delete($id);
}