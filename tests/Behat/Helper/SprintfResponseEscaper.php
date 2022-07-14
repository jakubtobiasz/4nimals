<?php

declare(strict_types=1);

namespace App\Tests\Behat\Helper;

use Symfony\Component\HttpFoundation\Response;

final class SprintfResponseEscaper
{
    public static function provideMessageWithEscapedResponseContent(string $message, Response $response): string
    {
        return sprintf(
            '%s Received response: %s',
            $message,
            str_replace(
                '%',
                '%%',
                json_encode(json_decode($response->getContent(), true), \JSON_PRETTY_PRINT)
            )
        );
    }
}
