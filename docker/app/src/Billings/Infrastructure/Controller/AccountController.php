<?php
declare(strict_types=1);


namespace App\Billings\Infrastructure\Controller;

use App\Billings\Application\UseCase\Command\CreateAccount\CreateAccountCommand;
use App\Billings\Application\UseCase\Command\UpdateAccountBalance\UpdateAccountBalanceCommand;
use App\Billings\Application\UseCase\Query\FindAccount\FindAccountQuery;
use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Domain\Service\AssertService;
use App\Shared\Domain\Service\RequestHeadersService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/billing/account', name: 'app_api_billing_')]
class AccountController extends AbstractController
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
        $balance = $data['balance'] ?? null;
        $userUlid = $this->headersService->getUserUlid();
        AssertService::notNull($userUlid, 'No user\'s id provided.');
        $command = new CreateAccountCommand($userUlid, $balance ?? 0);
        $result = $this->commandBus->execute($command);

        return new JsonResponse($result);
    }
    #[Route('/balance', name: 'balance_update', methods: ['PATCH'])]
    public function balanceUpdate(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $balance = $data['balance'] ?? null;
        AssertService::notNull($balance, 'No data for balance provided.');
        $userUlid = $this->headersService->getUserUlid();
        AssertService::notNull($userUlid, 'No user\'s id provided.');
        $command = new UpdateAccountBalanceCommand($userUlid, $balance);
        $result = $this->commandBus->execute($command);

        return new JsonResponse($result);
    }

    #[Route('', name: 'find_by_user_id', methods: ['GET'])]
    public function getByUserId(): JsonResponse
    {
        $userUlid = $this->headersService->getUserUlid();
        AssertService::notNull($userUlid, 'No user\'s id provided.');
        $query = new FindAccountQuery($userUlid);
        $result = $this->queryBus->execute($query);

        return new JsonResponse($result);
    }
}