<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Query\FindAccount;

use App\Shared\Application\Query\Query;

readonly class FindAccountQuery extends Query
{
    public function __construct(public string $userId)
    {
    }
}
