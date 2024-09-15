<?php
declare(strict_types=1);


namespace App\Billings\Domain\Aggregate\Account;

use App\Shared\Domain\Service\UlidService;

class AccountTransaction
{
    private readonly string $id;
    private readonly Account $account;
    private \DateTimeImmutable $createdAt;

    public function __construct(
        Account                  $account,
        private float            $sum,
        private readonly TransactionType $type,
        private readonly string $documentId,
    )
    {
        $this->id = UlidService::generate();
        $this->account = $account;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAccount(): Account
    {
        return $this->account;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function getDocumentId(): ?string
    {
        return $this->documentId;
    }

    public function getType(): TransactionType
    {
        return $this->type;
    }
}