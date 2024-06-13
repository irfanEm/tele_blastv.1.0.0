<?php

namespace IRFANEM\TELE_BLAST\Middleware;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Service\SessionService;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;

class MustNotLoginMiddleware
{
    private SessionService $sessionService;

    public function __construct()
    {
        $sessionRepository = new SessionRepository(Database::getConnection());
        $userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function before(): void
    {
        $user = $this->sessionService->current();
        if($user != null){
            View::redirect('/');
        }
    }
}
