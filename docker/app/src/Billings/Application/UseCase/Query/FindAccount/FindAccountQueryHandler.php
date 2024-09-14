<?php

declare(strict_types=1);

namespace App\Billings\Application\UseCase\Query\FindAccount;

use App\Billings\Application\DTO\AccountDTOTransformer;
use App\Billings\Domain\Repository\AccountRepositoryInterface;
use App\Notifications\Application\DTO\NotificationDTOTransformer;
use App\Notifications\Domain\Repository\NotificationRepositoryInterface;
use App\Shared\Application\Query\QueryHandlerInterface;

readonly class FindAccountQueryHandler implements QueryHandlerInterface
{
    public function __construct(
        private AccountRepositoryInterface $accountRepository,
        private AccountDTOTransformer      $accountDTOTransformer,
    )
    {
    }

    public function __invoke(FindAccountQuery $query): FindAccountQueryResult
    {
        $account = $this->accountRepository->findByUserId($query->userId);
        if (!$account) {
            return new FindAccountQueryResult(null);
        }
        $notificationDTO = $this->accountDTOTransformer->fromAccountEntity($account);

        return new FindAccountQueryResult($notificationDTO);
    }
}
