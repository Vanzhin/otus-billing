<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Command\CreateAccountTransaction;

use App\Shared\Application\Command\Command;

readonly class CreateAccountTransactionCommand extends Command
{
    public function __construct(
        public string $userId,
        public ?float $sum,
        public string $documentId,
        public string $transactionType
    )
    {
    }
}
