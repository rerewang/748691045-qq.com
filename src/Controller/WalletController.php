<?php

namespace App\Controller;

use App\Entity\Wallet;
use App\Foundation;

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