<?php

declare(strict_types=1);

namespace Ajo\Tdd\Examples\Marketplace\Controller;

use Ajo\Tdd\Examples\Marketplace\Application\CommandHandler\PostAdCommandHandler;
use Ajo\Tdd\Examples\Marketplace\Application\DTO\PostAdInput;
use Ajo\Tdd\Examples\Marketplace\Application\Exceptions\AccountMissingException;
use Ajo\Tdd\Examples\Marketplace\Application\Exceptions\UserMissingException;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\AdRepositoryInterface;
use Ajo\Tdd\Examples\Marketplace\Domain\Ads\Commands\PostAdCommand;
use Brick\Money\Money;
use JsonMapper\JsonMapperInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdsController extends AbstractController
{
    public function __construct(
        private AdRepositoryInterface $adRepository,
        private JsonMapperInterface $jsonMapper
    ) {
    }

    #[Route('/ads', 'listAds', methods: ['GET'])]
    public function listAds(): JsonResponse
    {
        return new JsonResponse(
            json_encode($this->adRepository->findAll())
        );
    }

    #[Route('/ads', 'postAd', methods: ['POST'])]
    public function postAd(Request $request, PostAdCommandHandler $commandHandler): JsonResponse
    {
        $postAdInput = new PostAdInput();
        $response = new JsonResponse();

        try {
            $postAdInput = $this->jsonMapper->mapObjectFromString(
                $request->getContent(),
                $postAdInput
            );
        } catch (\Throwable $exception) {
            return $response->setStatusCode(400);
        }

        try {

            $output = $commandHandler->handle(new PostAdCommand(
                $postAdInput->accountId,
                $postAdInput->createdByUserId,
                Money::of($postAdInput->price, 'EUR')
            ));
            $response->setData(
                json_encode($output)
            );
            $response->setStatusCode(201);
        } catch (\Throwable $exception) {

            $errorMessgae = match (true) {
                $exception instanceof UserMissingException => 'User not found',
                $exception instanceof AccountMissingException => 'Account not found',
                default => 'Unknown error'
            };
            $response->setStatusCode(400);
            $response->setData(
                json_encode((object)['error' => $errorMessgae])
            );
        }

        return $response;
    }
}
