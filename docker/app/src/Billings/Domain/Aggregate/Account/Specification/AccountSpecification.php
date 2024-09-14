<?php
declare(strict_types=1);


namespace App\Billings\Domain\Aggregate\Account\Specification;

use App\Shared\Domain\Specification\SpecificationInterface;

readonly class AccountSpecification implements SpecificationInterface
{
    public function __construct(
        public AccountUserIdUniqueSpecification $accountUserIdUniqueSpecification,
    ) {
    }
}