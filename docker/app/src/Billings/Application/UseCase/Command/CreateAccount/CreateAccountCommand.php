<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Command\CreateAccount;

use App\Shared\Application\Command\Command;

readonly class CreateAccountCommand extends Command
{
    public function __construct(
        public string $userId,
        public ?float $balance,
    )
    {
    }
}
