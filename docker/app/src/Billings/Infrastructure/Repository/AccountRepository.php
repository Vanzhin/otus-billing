<?php
declare(strict_types=1);

namespace App\Billings\Infrastructure\Repository;

use App\Billings\Domain\Aggregate\Account\Account;
use App\Billings\Domain\Repository\AccountRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccountRepository extends ServiceEntityRepository implements AccountRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Account::class);
    }

    public function add(Account $account): void
    {
        $this->getEntityManager()->persist($account);
        $this->getEntityManager()->flush();
    }

    public function findByUserId(string $userId): ?Account
    {
        return $this->findOneBy(['userId' => $userId]);
    }

    public function findOneById(string $id): ?Account
    {
        return $this->find($id);
    }

}