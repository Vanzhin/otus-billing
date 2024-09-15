<?php

namespace App\Billings\Domain\Aggregate\Account;


enum TransactionType: string
{
    /*
     * Заказ.
     */
    case ORDER = 'order';

    /*
     * Перевод.
     */
    case TRANSFER = 'transfer';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
