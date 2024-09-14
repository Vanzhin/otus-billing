<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Command\UpdateAccountBalance;

use App\Billings\Domain\Factory\AccountFactory;
use App\Billings\Domain\Repository\AccountRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;
use App\Shared\Domain\Service\AssertService;

readonly class UpdateAccountBalanceCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private AccountFactory             $accountFactory,
        private AccountRepositoryInterface $accountRepository,
    )
    {
    }

    public function __invoke(UpdateAccountBalanceCommand $command): UpdateAccountBalanceCommandResult
    {

        $exist = $this->accountRepository->findByUserId($command->userId);
        AssertService::notNull(
            $exist,
            'No account found.'
        );
        $exist->updateBalance($command->balance);
        $this->accountRepository->add($exist);

        return new UpdateAccountBalanceCommandResult();
    }
}
