<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Command\CreateAccount;

use App\Billings\Domain\Factory\AccountFactory;
use App\Billings\Domain\Repository\AccountRepositoryInterface;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class CreateAccountCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private AccountFactory             $accountFactory,
        private AccountRepositoryInterface $accountRepository,
    )
    {
    }

    public function __invoke(CreateAccountCommand $command): CreateAccountCommandResult
    {
        $account = $this->accountFactory->create(
            $command->userId,
            $command->balance,
        );
        $this->accountRepository->add($account);

        return new CreateAccountCommandResult(
            $account->getId()
        );
    }
}
