<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Command\CreateAccountTransaction;

use App\Billings\Domain\Service\CreateAccountTransactionService;
use App\Shared\Application\Command\CommandHandlerInterface;

readonly class CreateAccountTransactionCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private CreateAccountTransactionService $service,
    )
    {
    }

    public function __invoke(CreateAccountTransactionCommand $command): CreateAccountTransactionCommandResult
    {
        $this->service->add($command->userId, $command->sum, $command->documentId, $command->transactionType);

        return new CreateAccountTransactionCommandResult();
    }
}
