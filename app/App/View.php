<?php

namespace IRFANEM\TELE_BLAST\App;

use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Service\SessionService;

class View 
{
    private static ?SessionService $sessionService = null;

    public static function initSessionService()
    {
        if (self::$sessionService === null) {
            $userRepository = new UserRepository(Database::getConnection());
            $sessionRepository = new SessionRepository(Database::getConnection());
            self::$sessionService = new SessionService($sessionRepository, $userRepository);
        }
    }
    public static function render(string $view, array $model)
    {
        self::initSessionService();
        $user = self::$sessionService->current();

        require_once __DIR__ . "/../View/header.php";
        if($user !== null){
            require_once __DIR__ . "/../View/Dashboard/header-dashboard.php";
            require_once __DIR__ . "/../View/" . $view . ".php";
            require_once __DIR__ . "/../View/Dashboard/footer-dashboard.php";
        }else{
            require_once __DIR__ . "/../View/" . $view . ".php";
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
