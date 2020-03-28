<?php

namespace Rcomponent\Wallet;

use Rcomponent\Wallet\Controller\WalletController;

class WalletClient {

    public function createWallet() {
        $walletController = new WalletController();
        return $walletController->create();
    }

    public function getWallet($id) {
        $walletController = new WalletController();
        return $walletController->get($id);
    }

    public function updateBalance($id, $balance) {
        $walletController = new WalletController();
        return $walletController->updateBalance($id, $balance);
    }
}