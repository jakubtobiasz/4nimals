<?php

declare(strict_types=1);

namespace App\Tests\Behat\Helper;

use RuntimeException;

interface SharedStorageInterface
{
    public function get(string $key);

    public function has(string $key): bool;

    public function set(string $key, $resource): void;

    public function remove(string $key): void;

    public function getLatestResource();

    /**
     * @throws RuntimeException
     */
    public function setClipboard(array $clipboard);
}
