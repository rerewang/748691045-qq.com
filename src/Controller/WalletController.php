<?php

namespace Rcomponent\Wallet\Controller;

use Rcomponent\Wallet\Entity\Wallet;
use Rcomponent\Wallet\Foundation;

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

        $this->entityManager->persist($wallet);
        $this->entityManager->flush();

        return $wallet;
    }

    /**
     * @param $id
     * @return Wallet|null
     */
    public function get($id)
    {
        $walletRepository = $this->entityManager->getRepository(Wallet::class);
        return $walletRepository->find($id);
    }

    public function updateBalance($id, $balance)
    {
        $walletRepository = $this->entityManager->getRepository(Wallet::class);
        $wallet = $walletRepository->find($id);

        $wallet->setBalance($balance);
        $this->entityManager->flush();

        return $wallet;
    }
}