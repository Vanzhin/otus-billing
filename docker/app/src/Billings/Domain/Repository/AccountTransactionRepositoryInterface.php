<?php
declare(strict_types=1);


namespace App\Billings\Domain\Repository;

use App\Billings\Domain\Aggregate\Account\AccountTransaction;

interface AccountTransactionRepositoryInterface
{
    public function add(AccountTransaction $transaction):void;
}