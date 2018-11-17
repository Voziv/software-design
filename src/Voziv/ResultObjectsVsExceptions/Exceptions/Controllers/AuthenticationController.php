<?php

namespace Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Controllers;

use Voziv\ResultObjectsVsExceptions\Exceptions\Services\AuthenticationService;
use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\AuthenticationException;
use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\PasswordMisMatchException;
use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\UserLockedException;
use Voziv\Voziv\ResultObjectsVsExceptions\Exceptions\Exceptions\UsernameNotFoundException;

final class AuthenticationController
{
    /** @var AuthenticationService */
    private $passwordAuthenticator;

    public function __construct(AuthenticationService $passwordAuthenticator)
    {
        $this->passwordAuthenticator = $passwordAuthenticator;
    }

    public function login(string $username, string $password)
    {
        try {
            $loggedIn = $this->passwordAuthenticator->authenticateByPassword($username, $password);

            if ($loggedIn) {
                return ['success' => true];
            } else {
                return ['error' => 'Not logged in'];
            }
        } catch (\InvalidArgumentException $e) {
            return ['error' => 'You must provide a username and password.'];
        } catch (UsernameNotFoundException $e) {
            return ['error' => 'Wrong username.'];
        } catch (UserLockedException $e) {
            return ['error' => 'Account locked. Please try again in 1 hour.'];
        } catch (PasswordMisMatchException $e) {
            return ['error' => 'Wrong password.'];
        } catch (AuthenticationException $e) {
            return ['error' => 'Wrong username or password.']; // FIXME: But why though?
        } catch (\Exception $e) {
            return ['error' => 'Unknown error occurred while logging in.'];
        }
    }
}