<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Command\CreateAccount;

class CreateAccountCommandResult
{
    public function __construct(
        public string $id,
    )
    {
    }
}
