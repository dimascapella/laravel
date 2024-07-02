<?php

namespace App\Repositories;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface{
    public function getAllUser(){
        return User::orderBy('id', 'desc')->paginate(5);
    }

    public function createUser($data){
        return User::create($data);
    }

    public function findById($id){
        $user = User::where('id', $id)->first();

        if(!$user){
            return 'error_data_not_found';
        }

        return $user;
    }

    public function delete($id){
        return User::where('id', $id)->delete();
    }

    public function updateRefund($id, $data){
        $user = User::where('id', $id)->first();

        if(!$user){
            return 'error_data_not_found';
        }

        $user->name = $data['name'];
        $user->division_id = $data['division_id'];
        $user->save();
    }
}