<?php

declare(strict_types=1);

namespace App\Billings\Application\DTO;

class AccountDTO
{
    public string $id;
    public string $user_id;
    public float $balance;
}
