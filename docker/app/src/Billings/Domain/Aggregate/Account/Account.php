<?php
declare(strict_types=1);


namespace App\Billings\Domain\Aggregate\Account;

use App\Billings\Domain\Aggregate\Account\Specification\AccountSpecification;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\UlidService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Account
{
    private readonly string $id;
    private readonly string $userId;
    private float $balance;


    /**
     * @var Collection<AccountTransaction>
     */
    private Collection $transactions;

    public function __construct(
        string                                $userId,
        float                                 $balance,
        private readonly AccountSpecification $accountSpecification,

    )
    {
        $this->setUserId($userId);
        $this->id = UlidService::generate();
        $this->transactions = new ArrayCollection();
        $this->setBalance($balance);

    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    private function setBalance(float $balance): void
    {
        AssertService::true(
            $balance >= 0,
            'Баланс не может быть отрицательным.'
        );
        $this->balance = $balance;
    }

    private function setUserId(string $userId): void
    {
        $this->userId = $userId;
        $this->accountSpecification->accountUserIdUniqueSpecification->satisfy($this);
    }

    public function updateBalance(float $sum): void
    {
        $newBalance = $this->balance + $sum;
        $this->setBalance($newBalance);
        $this->transactions[] = new AccountTransaction($this, $sum);
    }


}