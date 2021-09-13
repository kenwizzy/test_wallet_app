<?php

namespace App\Repositories\User;

use App\Models\User;
use App\Models\Wallet;
use App\Repositories\User\UserRepository;

class UserEloquent implements UserRepository{

    private $model;

    public function __construct(User $model){
        $this->model = $model;
    }

    public function getAllUsers(){
        return $this->model->all();
    }

    public function getUserById($id){
        return $this->model->where('id',$id)->with('wallets','transactionsHistories')->first();
    }

    public function userCount(){
       return $this->model->all()->count();
    }
}
