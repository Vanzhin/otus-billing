<?php
declare(strict_types=1);


namespace App\Billings\Infrastructure\Controller;

use App\Billings\Application\UseCase\Command\CreateAccountTransaction\CreateAccountTransactionCommand;
use App\Billings\Domain\Aggregate\Account\TransactionType;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\RequestHeadersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/billing/account/transaction', name: 'app_api_billing_transaction')]
class AccountTransactionController extends AbstractController
{
    public function __construct(
        private readonly QueryBusInterface     $queryBus,
        private readonly CommandBusInterface   $commandBus,
        private readonly RequestHeadersService $headersService,
    )
    {
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        //проверка
        $sum = $data['sum'] ?? null;
        AssertService::numeric($sum, 'Sum must be numeric.');
        $userUlid = $this->headersService->getUserUlid();
        AssertService::notNull($userUlid, 'No user\'s id provided.');
        $documentId = $data['document_id'] ?? null;
        AssertService::notNull($documentId, 'Property \'document_id\' required.');
        $type = $data['type'] ?? null;
        AssertService::inArray($type,
            TransactionType::values(),
            'Invalid type provided.');

        $command = new CreateAccountTransactionCommand($userUlid, $sum, $documentId, $type);
        $result = $this->commandBus->execute($command);

        return new JsonResponse($result);
    }
}