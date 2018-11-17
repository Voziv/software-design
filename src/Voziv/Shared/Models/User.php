<?php

namespace Voziv\Shared\Models;

final class User
{
    /** @var int */
    private $id;

    /** @var string */
    private $username;

    /** @var \DateTimeImmutable */
    private $lockedAt;

    public function __construct(int $id, string $username, ?\DateTimeImmutable $lockedAt)
    {
        $this->id = $id;
        $this->username = $username;
        $this->lockedAt = $lockedAt;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getLockedAt(): ?\DateTimeImmutable
    {
        return $this->lockedAt;
    }
}