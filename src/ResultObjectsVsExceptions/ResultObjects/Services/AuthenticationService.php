<?php

namespace Voziv\ResultObjectsVsExceptions\ResultObjects\Services;

use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\AuthenticationException;
use Voziv\Voziv\ResultObjectsVsExceptions\ResultObjects\Models\AuthenticationResult;

final class AuthenticationService
{
    /**
     * @param string $username
     * @param string $password
     * @return AuthenticationResult
     * @throws AuthenticationException
     */
    public function authenticateByPassword(string $username, string $password): AuthenticationResult
    {
        try {
            if (empty($username)) {
                return new AuthenticationResult(false, AuthenticationResult::ERROR_USER_NOT_FOUND);
            }

            if (empty($password)) {
                return new AuthenticationResult(false, AuthenticationResult::ERROR_PASSWORD_MISMATCH);
            }

            /**
             * FIXME: May the RNG gods be with you.
             */
            $rand = rand(1, 10);
            if ($username !== 'BOB') {
                return new AuthenticationResult(false, AuthenticationResult::ERROR_USER_NOT_FOUND);
            } elseif ($password !== 'LOLOL') {
                return new AuthenticationResult(false, AuthenticationResult::ERROR_PASSWORD_MISMATCH);
            } elseif ($rand === 1) {
                return new AuthenticationResult(false, AuthenticationResult::ERROR_ACCOUNT_LOCKED);
            } elseif ($rand === 2) {
                throw new AuthenticationException('Some generic failure. Random chance.');
            } elseif ($rand === 3) {
                throw new \Exception('Database error. Random chance');
            }

            return new AuthenticationResult(true);
        } catch (\Exception $e) {
            throw new AuthenticationException('Unhandled error.', 0, $e);
        }
    }
}