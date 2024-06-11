<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Service\SessionService;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;

class HomeController
{

    private SessionService $sessionService;
    public function __construct()
    {
        $connection = Database::getConnection();
        $sessionRepository = new SessionRepository($connection);
        $userRepository = new UserRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }

    function index() {
        $user = $this->sessionService->current();
        if($user == null) {
            View::render('Home/index', [
                "title" => "Beranda"
            ]);
        } else {
            View::render('Home/dashboard', [
                "title" => "Dashboard",
                "user" => [
                    "name" => $user->nama
                ]
            ]);
        }
    }

}