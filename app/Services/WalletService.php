<?php

namespace App\Services;

use App\Models\User;
use App\Models\Wallet;
use App\Models\WalletType;
use Illuminate\Http\Request;
use InvalidArgumentException;
use App\Models\TransactionHistory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Repositories\Wallet\WalletRepository;

class WalletService{

    private $walletRepo;

    public function __construct(WalletRepository $walletRepo)
    {
        $this->walletRepo = $walletRepo;

    }

    public function sendMoneyService($data){

        $validator = Validator::make($data, [
            'amount' => 'required|numeric',
            'sender_email' => 'required|email',
            'sender_wallet' => 'required|string',
            'receiver_email' => 'required|email',
            'receiver_wallet' => 'required|string'
        ]);
        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $amount = $this->walletRepo->sendMoney($data['amount']);
        $senderWalletType = $this->getWalletType($this->walletRepo->sendMoney($data['sender_wallet']));
        $sender = $this->getUser($this->walletRepo->sendMoney($data['sender_email']));
        $senderWallet = $this->getWallet($sender->id, $senderWalletType->id);

        $receiverWalletType = $this->getWalletType($this->walletRepo->sendMoney($data['receiver_wallet']));
        $receiver = $this->getUser($this->walletRepo->sendMoney($data['receiver_email']));
        $receiverWallet = $this->getWallet($receiver->id, $receiverWalletType->id);

        $details = [$senderWallet, $receiverWallet];
        if ($senderWallet->balance >= $senderWallet->walletType->min_bal && ($senderWallet->balance - $senderWallet->walletType->min_bal) >= $amount) {
            DB::transaction(function () use ($senderWallet, $receiverWallet, $amount, $details) {
                $senderWallet->update([
             'balance' => $senderWallet->balance - $amount,
            ]);

                $receiverWallet->update([
                'balance' => $receiverWallet->balance + $amount,
            ]);

                for ($i = 1; $i <= count($details); $i++) {
                    TransactionHistory::create([
                'wallet_id' => $i==1? $senderWallet->id : $receiverWallet->id,
                'user_id' => $i==1? $senderWallet->user_id : $receiverWallet->user_id,
                'transac_type' => $i==1? 'Debit' : 'Credit',
                'amount' => $i==1? '-'.$amount : $amount
            ]);
                }
            });

            return 'Money sent successfully, Please check your transaction history.';
        }
        throw new InvalidArgumentException('Amount exceeded the wallet minimum balance, Please fund account');
    }


    private function getWalletType($data){
        return WalletType::whereName($data)->first();
     }

     private function getUser($data){
         return User::whereEmail($data)->first();
     }

     private function getWallet($output, $result){
        return Wallet::whereHas('user',function ($query) use($output) {
             $query->where('user_id', $output);
         })
         ->where('wtype_id', $result)
         ->first();
     }
}
