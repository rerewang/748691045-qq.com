<?php

namespace Rere\Wallet;

use Rere\Wallet\Controller\WalletController;

class WalletClient {

    public function createWallet() {
        $walletController = new WalletController();
        return $walletController->create();
    }
}