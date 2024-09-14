<?php
declare(strict_types=1);

namespace App\Billings\Domain\Factory;

use App\Billings\Domain\Aggregate\Account\Account;
use App\Billings\Domain\Aggregate\Account\Specification\AccountSpecification;

readonly class AccountFactory
{
    public function __construct(private AccountSpecification $accountSpecification)
    {
    }

    public function create(
        string $userId,
        float  $balance = 0,
    ): Account
    {
        return new Account($userId, $balance, $this->accountSpecification);
    }
}