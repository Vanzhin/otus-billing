<?php
declare(strict_types=1);


namespace App\Billings\Domain\Service;

use App\Billings\Domain\Aggregate\Account\TransactionType;
use App\Billings\Domain\Factory\AccountTransactionFactory;
use App\Billings\Domain\Repository\AccountRepositoryInterface;
use App\Billings\Domain\Repository\AccountTransactionRepositoryInterface;
use App\Shared\Domain\Service\AssertService;

readonly class CreateAccountTransactionService
{
    public function __construct(
        private AccountRepositoryInterface            $accountRepository,
        private AccountTransactionRepositoryInterface $transactionRepository,
        private AccountTransactionFactory             $accountTransactionFactory
    )
    {
    }

    public function add(string $userId, float $sum, string $documentId, string $transactionType): void
    {
        $account = $this->accountRepository->findByUserId($userId);
        AssertService::notNull(
            $account,
            "No account found."
        );
        $transaction = $this->accountTransactionFactory->create($account, $sum, TransactionType::from($transactionType), $documentId);
        $account->updateBalance($transaction->getSum());
        $this->transactionRepository->add($transaction);
    }

}