<?php

namespace IRFANEM\TELE_BLAST\App;

use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Service\SessionService;

class View 
{
    private SessionService $sessionService;
    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $sessionService = new SessionService($sessionRepository, $userRepository);
    }
    public static function render(string $view, $model)
    {
        require_once __DIR__ . "/../View/header.php";
        if($sessionService->current() == null){
            require_once __DIR__ . "/../View/" . $view . ".php";
        }else{
            require_once __DIR__ . "/../View/Dashboard/header.php";
            require_once __DIR__ . "/../View/Dashboard/aside.php";
            require_once __DIR__ . "/../View/" . $view . ".php";
            require_once __DIR__ . "/../View/Dashboard/footer.php";
        }
        require_once __DIR__ . "/../View/footer.php";
    }

    public static function redirect(string $url)
    {
        header("Location: $url");
        if(getenv("mode") != "test") {
            exit();
        }
    }
}
