<?php
namespace App\Repositories\Wallet;

interface WalletRepository
{
    function getAllWallets();

    public function getWalletById($id);

    public function sendMoney($outcome);

    public function walletCount();

    public function walletbalance();

    public function transactionvolume();
}
