<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;
use IRFANEM\TELE_BLAST\Service\SessionService;
use IRFANEM\TELE_BLAST\Repository\UserRepository;

class TemplateController
{
    private SessionService $sessionService;

    public function __construct()
    {
        $userRepository = new UserRepository(Database::getConnection());
        $sessionRepository = new SessionRepository(Database::getConnection());
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    public function index()
    {
        return View::render("Template/index",[
            "title" => "Template"
        ]);
    }

    public function index_ku()
    {
        $this->sessionService->destroy();
        return View::render("Template/templat-ku",[
            "title" => "Templat-Ku"
        ]);
    }

    public function sneat()
    {
        return View::render("Template/sneat", [
            "title" => "Sneat Template"
        ]);
    }

    public function test(string $id): void
    {
        echo "testing id = $id";
    }

}
