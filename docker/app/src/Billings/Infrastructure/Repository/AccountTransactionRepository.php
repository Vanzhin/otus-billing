<?php
declare(strict_types=1);


namespace App\Billings\Infrastructure\Repository;

use App\Billings\Domain\Aggregate\Account\AccountTransaction;
use App\Billings\Domain\Repository\AccountTransactionRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccountTransactionRepository extends ServiceEntityRepository implements AccountTransactionRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccountTransaction::class);
    }

    public function add(AccountTransaction $transaction): void
    {
        $this->getEntityManager()->persist($transaction);
        $this->getEntityManager()->flush();
    }
}