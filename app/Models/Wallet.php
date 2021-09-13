<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $guarded = ['created_at', 'updated_at'];

    public function walletType(){
        return $this->belongsTo(WalletType::class, 'wtype_id');
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function transactionsHistories(){
        return $this->hasMany(TransactionHistory::class);
    }


}
