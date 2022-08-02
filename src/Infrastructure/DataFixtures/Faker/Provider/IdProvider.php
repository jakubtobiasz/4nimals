<?php

declare(strict_types=1);

namespace App\Infrastructure\DataFixtures\Faker\Provider;

use App\Domain\AdminUser\AdminUserId;
use App\Domain\FrontUser\FrontUserId;
use App\Domain\Pet\PetId;
use App\Domain\Shelter\ShelterId;

final class IdProvider
{
    public static function admin_user_id(): AdminUserId
    {
        return AdminUserId::create();
    }

    public static function front_user_id(): FrontUserId
    {
        return FrontUserId::create();
    }

    public static function pet_id(): PetId
    {
        return PetId::create();
    }

    public static function shelter_id(): ShelterId
    {
        return ShelterId::create();
    }
}
