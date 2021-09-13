<?php

namespace App\Repositories\Wallet;

use App\Models\TransactionHistory;
use App\Repositories\Wallet\WalletRepository;

use App\Models\Wallet;

class WalletEloquent implements WalletRepository
{
    private $model;

    public function __construct(Wallet $model){

        $this->model = $model;
    }

    public function getAllWallets(){

        return $this->model->all();

    }

    public function getWalletById($id){

        return $this->model::where('id',$id)->with('user','walletType','transactionsHistories')->first();
    }

    public function walletCount(){
        return $this->model->all()->count();
     }

     public function walletbalance(){
        return $this->model->get()->sum('balance');
     }

     public function transactionvolume(){
         return TransactionHistory::get()->sum('amount');
     }

    public function sendMoney($outcome){

        return $outcome;
    }
}
