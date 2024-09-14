<?php
declare(strict_types=1);

namespace App\Billings\Domain\Repository;

use App\Billings\Domain\Aggregate\Account\Account;

interface AccountRepositoryInterface
{
    public function add(Account $account): void;

    public function findOneById(string $id): ?Account;

    public function findByUserId(string $userId): ?Account;
}