<?php

declare(strict_types=1);

namespace App\Billings\Domain\Aggregate\Account\Specification;

use App\Billings\Domain\Aggregate\Account\Account;
use App\Billings\Domain\Repository\AccountRepositoryInterface;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Specification\SpecificationInterface;

readonly class AccountUserIdUniqueSpecification implements SpecificationInterface
{
    public function __construct(
        private AccountRepositoryInterface $accountRepository,
    )
    {
    }

    public function satisfy(Account $account): void
    {
        $exist = $this->accountRepository->findByUserId($account->getUserId());
        AssertService::null(
            $exist,
            'This user has account already.');
    }
}
