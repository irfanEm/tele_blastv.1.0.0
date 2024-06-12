<?php

namespace IRFANEM\TELE_BLAST\Service;

require_once __DIR__ . "/../Helper/helper.php";

use PHPUnit\Framework\TestCase;
use IRFANEM\TELE_BLAST\Domain\User;
use IRFANEM\TELE_BLAST\Domain\Session;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Service\SessionService;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;

class SessionServiceTest extends TestCase
{

    private SessionService $sessionService;
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionService = new SessionService($this->sessionRepository, $this->userRepository);

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->nama = "Balqis Farah Anabila";
        $user->email = "blqs2103@mail.com";
        $user->password = "blqs2103@mail.com";
        $this->userRepository->save($user);
    }

    public function testCreate()
    {
        $session = $this->sessionService->create("blqs2103@mail.com");

        $this->expectOutputRegex("[X-IRFANEM-SESSION: $session->id]");

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals("blqs2103@mail.com", $result->email);
    }

    public function testDestroy()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->email = "blqs2103@mail.com";

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $this->sessionService->destroy();

        $this->expectOutputRegex("[X-IRFANEM-SESSION: ]");

        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }

    public function testCurrent()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->email = "blqs2103@mail.com";

        $this->sessionRepository->save($session);

        $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

        $user = $this->sessionService->current();

        self::assertEquals($session->email, $user->email);
    }

}
