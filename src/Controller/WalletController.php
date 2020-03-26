<?php

namespace App\Controller;

use App\Entity\Wallet;
use App\Foundation;

class WalletController extends Foundation
{
    public function create()
    {
        $wallet = new Wallet();
        $wallet->setBalance(1000);

        $this->db->persist($wallet);
        $this->db->flush();

        return $wallet;
    }

    /**
     * @param $id
     * @return Wallet|null
     */
    public function get($id)
    {
        $walletRepository = $this->db->getRepository(Wallet::class);
        return $walletRepository->find($id);
    }
}