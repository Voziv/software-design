<?php

namespace Voziv\Voziv\Shared\Contracts\Repositories;

use Voziv\Shared\Models\User;

interface FakeUserRepository
{
    public function getUserById(int $id): User;

    public function getUserByUsername(string $username): User;
}