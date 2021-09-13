<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Repositories\User\UserRepository;
use App\Repositories\Wallet\WalletRepository;

class UserController extends Controller
{
    private $user;
    private $wallet;

    public function __construct(UserRepository $user, WalletRepository $wallet)
    {
        $this->user = $user;
        $this->wallet = $wallet;
    }

    public function index(){
        $data = $this->user->getAllUsers();
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful',
            'data' => $data,
        ]);
    }

    public function show($id){
        $res = $this->user->getUserById($id);
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful',
            'data' => $res,
        ]);
    }

    public function getCount(){
        //try{
        $userCount = $this->user->userCount();
        $walletCount = $this->wallet->walletCount();
        $walletbal = $this->wallet->walletbalance();
        $transactionVol = $this->wallet->transactionVolume();
        return response()->json([
            'status' => 'Ok',
            'message' => 'successful',
            'data' => [
                'users_count' => $userCount,
                'wallets_count' => $walletCount,
                'wallet_balance' => number_format($walletbal, 2),
                'transaction_volume' => number_format($transactionVol, 2)
            ]
        ]);
    // } catch (\Throwable $exception){
    //     //report($exception);

    //     return response()->json($exception->getMessage());
    // }

        }

}
