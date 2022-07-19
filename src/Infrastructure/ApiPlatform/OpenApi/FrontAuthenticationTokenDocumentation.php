<?php

declare(strict_types=1);

namespace App\Infrastructure\ApiPlatform\OpenApi;

use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\OpenApi;
use Symfony\Component\HttpFoundation\Response;

final class FrontAuthenticationTokenDocumentation implements OpenApiFactoryInterface
{
    public function __construct(private readonly OpenApiFactoryInterface $decoratedFactory)
    {
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decoratedFactory->__invoke($context);
        $openApi
            ->getPaths()
            ->addPath(
                '/api/front/authenticate',
                new PathItem(
                    post: new Operation(
                        operationId: 'front-authenticate',
                        tags: ['Authentication'],
                        responses: [
                            Response::HTTP_NO_CONTENT => [
                                'content' => null,
                                'description' => 'Authentication successful',
                            ],
                            Response::HTTP_UNAUTHORIZED => [
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'code' => [
                                                    'type' => 'integer',
                                                ],
                                                'message' => [
                                                    'type' => 'string',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                                'description' => 'Authentication failed',
                            ]
                        ],
                        description: 'Authenticates front user',
                        requestBody: new RequestBody(
                            description: 'Authentication credentials',
                            content: new \ArrayObject(
                                [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'object',
                                            'properties' => [
                                                'username' => [
                                                    'type' => 'string',
                                                    'example' => 'user@example.com',
                                                ],
                                                'password' => [
                                                    'type' => 'string',
                                                    'example' => 'password',
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            )
                        )
                    ),
                )
            )
        ;

        return $openApi;
    }
}
