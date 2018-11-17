<?php

namespace Voziv\ResultObjectsVsExceptions\Exceptions\Services;

use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\AuthenticationException;
use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\PasswordMisMatchException;
use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\UserLockedException;
use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\UsernameNotFoundException;

final class AuthenticationService
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     * @throws AuthenticationException
     * @throws PasswordMisMatchException
     * @throws UserLockedException
     * @throws UsernameNotFoundException
     * @throws \Exception
     */
    public function authenticateByPassword(string $username, string $password): bool
    {
        if (empty($username)) {
            throw new UsernameNotFoundException('You didn\'t even try');
        }

        if (empty($password)) {
            throw new PasswordMisMatchException('You didn\'t even try');
        }

        /**
         * FIXME: May the RNG gods be with you.
         */
        $rand = rand(1, 10);
        if ($username !== 'BOB') {
            throw new UsernameNotFoundException('BOB is the only good username');
        } elseif ($password !== 'LOLOL') {
            throw new PasswordMisMatchException('At least you tried.');
        } elseif ($rand === 1) {
            throw new UserLockedException('Random chance, sorries.');
        } elseif ($rand === 2) {
            throw new AuthenticationException('Some generic failure. Random chance.');
        } elseif ($rand === 3) {
            throw new \Exception('Database error. Random chance');
        }

        return true;
    }
}