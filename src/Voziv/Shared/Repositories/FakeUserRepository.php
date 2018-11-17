<?php

namespace Voziv\Voziv\Shared\Repositories;

use Faker\Generator;
use Voziv\Shared\Models\User;
use Voziv\Voziv\Shared\Contracts\Repositories\FakeUserRepository as FakeUserRepositoryContract;

final class FakeUserRepository implements FakeUserRepositoryContract
{
    /** @var Generator */
    private $faker;

    public function __construct(Generator $faker)
    {
        $this->faker = $faker;
    }

    public function getUserById(int $id): User
    {
        return new User(
            $id,
            $this->faker->userName,
            null
        );
    }

    public function getUserByUsername(string $username): User
    {
        return new User(
            $this->faker->randomDigitNotNull,
            $username,
            null
        );
        // TODO: Implement getUserByUsername() method.
    }
}