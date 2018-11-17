<?php

namespace Voziv\Voziv\ResultObjectsVsExceptions\ResultObjects\Controllers;

use Voziv\ResultObjectsVsExceptions\ResultObjects\Services\AuthenticationService;

final class AuthenticationController
{
    /** @var AuthenticationService */
    private $passwordAuthenticator;

    public function __construct(AuthenticationService $authenticator)
    {
        $this->passwordAuthenticator = $authenticator;
    }

    public function login(string $username, string $password)
    {
        try {
            $authenticationResult = $this->passwordAuthenticator->authenticateByPassword($username, $password);

            if ($authenticationResult->isSuccess()) {
                return ['success' => true];
            } else {
                return ['error' => 'Not logged in'];
            }
        } catch (UsernameNotFoundException $e) {
            return ['error' => 'Wrong username.'];
        } catch (UserLockedException $e) {
            return ['error' => 'Account locked. Please try again in 1 hour.'];
        } catch (PasswordMisMatchException $e) {
            return ['error' => 'Wrong password.'];
        } catch (\Exception $e) {
            return ['error' => 'Unknown error occurred while logging in.'];
        }
    }
}