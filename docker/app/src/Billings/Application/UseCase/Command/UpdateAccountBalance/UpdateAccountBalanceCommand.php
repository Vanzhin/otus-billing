<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Command\UpdateAccountBalance;

use App\Shared\Application\Command\Command;

readonly class UpdateAccountBalanceCommand extends Command
{
    public function __construct(
        public string $userId,
        public float  $balance,
    )
    {
    }
}
