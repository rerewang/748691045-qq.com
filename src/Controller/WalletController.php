<?php

namespace Rere\Wallet\Controller;

use Rere\Wallet\Entity\Wallet;
use Rere\Wallet\Foundation;

class WalletController extends Foundation
{
    public function create() {
        $wallet = new Wallet();
        $wallet->setBalance(1000);

        $this->db->persist($wallet);
        $this->db->flush();

        return $wallet;
    }
}