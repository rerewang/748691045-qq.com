<?php

namespace App;

use App\Controller\WalletController;

class WalletClient {

    public function createWallet() {
        $walletController = new WalletController();
        return $walletController->create();
    }

    public function getWallet($id) {
        $walletController = new WalletController($id);
        return $walletController->get($id);
    }
}