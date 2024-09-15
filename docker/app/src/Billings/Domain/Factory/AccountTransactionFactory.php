<?php
declare(strict_types=1);

namespace App\Billings\Domain\Factory;

use App\Billings\Domain\Aggregate\Account\Account;
use App\Billings\Domain\Aggregate\Account\AccountTransaction;
use App\Billings\Domain\Aggregate\Account\TransactionType;

readonly class AccountTransactionFactory
{
    public function create(
        Account         $account,
        float           $sum,
        TransactionType $type,
        string          $documentId,
    ): AccountTransaction
    {
        return new AccountTransaction($account, $sum, $type, $documentId);
    }
}