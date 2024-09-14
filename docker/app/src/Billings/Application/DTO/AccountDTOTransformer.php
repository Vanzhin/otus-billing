<?php

declare(strict_types=1);

namespace App\Billings\Application\DTO;


use App\Billings\Domain\Aggregate\Account\Account;

class AccountDTOTransformer
{
    public function fromAccountEntity(Account $account): AccountDTO
    {
        $dto = new AccountDTO();
        $dto->id = $account->getId();
        $dto->user_id = $account->getUserId();
        $dto->balance = $account->getBalance();

        return $dto;
    }
}
