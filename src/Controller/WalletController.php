<?php

namespace App\Controller;

use App\Entity\Wallet;
use App\Foundation;

class WalletController extends Foundation
{
    /**
     * @return Wallet
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
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

    public function updateBalance($id, $balance)
    {
        $walletRepository = $this->db->getRepository(Wallet::class);
        $wallet = $walletRepository->find($id);

        $wallet->setBalance($balance);
        $this->db->flush();

        return $wallet;
    }
}