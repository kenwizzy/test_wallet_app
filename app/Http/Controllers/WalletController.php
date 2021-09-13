<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Repositories\Wallet\WalletRepository;
use App\Services\WalletService;

class WalletController extends Controller
{
    private $wallet;

    public function __construct(WalletRepository $wallet)
    {
        $this->wallet = $wallet;
    }

    public function index(){
        $data = $this->wallet->getAllWallets();
        return response()->json(['status' => 'Ok','message' => 'successful','data' => $data]);
    }

    public function show($id){
        $res = $this->wallet->getWalletById($id);
        return response()->json(['status' => 'Ok','message' => 'successful','data' => $res]);
    }

    public function transferMoney(Request $request){
        $data = $request->only([
            'amount',
            'sender_email',
            'sender_wallet',
            'receiver_email',
            'receiver_wallet'
        ]);

        $result = ['status' => 200];
        try {
            $result['message'] = (new WalletService($this->wallet))->sendMoneyService($data);
        } catch(Exception $e){
           $result = ['status' => 500,'message' => $e->getMessage()];
        }

         return response()->json($result, $result['status']);

    }

}
