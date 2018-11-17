<?php

namespace Voziv\Voziv\ResultObjectsVsExceptions\ResultObjects\Models;

final class AuthenticationResult
{
    const ERROR_USER_NOT_FOUND = 1;
    const ERROR_PASSWORD_MISMATCH = 2;
    const ERROR_ACCOUNT_LOCKED = 3;


    /** @var bool */
    private $success;

    /** @var int */
    private $errorCode;

    public function __construct(bool $success, int $errorCode = 0)
    {
        $this->success = $success;
        $this->errorCode = $errorCode;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function isError(): bool
    {
        return !$this->success;
    }

    public function getErrorCode(): int
    {
        return $this->errorCode;
    }
}