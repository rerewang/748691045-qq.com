<?php

namespace App;

use App\Controller\WalletController;

class WalletClient {

    public function createWallet() {
        $walletController = new WalletController();
        return $walletController->create();
    }
}