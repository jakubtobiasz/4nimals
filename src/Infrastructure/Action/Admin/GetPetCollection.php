<?php

declare(strict_types=1);

namespace App\Infrastructure\Action\Admin;

use App\Application\Query\Pet\AdminPetCollectionQuery;
use App\Domain\Pet\PetCollectionDto;
use App\Infrastructure\ApiPlatform\Pagination\Paginator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

final class GetPetCollection
{
    use HandleTrait;

    public function __construct(MessageBusInterface $messageBus,) {
        $this->messageBus = $messageBus;
    }

    public function __invoke(Request $request): Paginator
    {
        $page = intval($request->query->get('page', 1));

        $query = new AdminPetCollectionQuery($page, 20);
        /** @var PetCollectionDto $result */
        $result = $this->handle($query);

        return new Paginator(
            $result,
            floatval($result->totalItems()),
            floatval($query->page),
            floatval($query->itemsPerPage)
        );
    }
}
