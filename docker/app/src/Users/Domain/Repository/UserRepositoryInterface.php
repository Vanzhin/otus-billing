<?php

declare(strict_types=1);

namespace App\Users\Domain\Repository;

use App\Users\Domain\Entity\User;

interface UserRepositoryInterface
{
    public function add(User $user): void;

    public function getByUlid(string $ulid): ?User;

    public function getByEmail(string $email): ?User;

    public function delete(User $user): void;

}
