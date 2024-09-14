<?php

declare(strict_types=1);


namespace App\Billings\Application\UseCase\Query\FindAccount;

use App\Billings\Application\DTO\AccountDTO;

readonly class FindAccountQueryResult
{
    public function __construct(public ?AccountDTO $account)
    {
    }
}
