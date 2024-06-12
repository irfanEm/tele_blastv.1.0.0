<?php

namespace IRFANEM\TELE_BLAST\Repository;

use PHPUnit\Framework\TestCase;
use IRFANEM\TELE_BLAST\Domain\User;
use IRFANEM\TELE_BLAST\Domain\Session;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;

class SessionRepositoryTest extends TestCase
{
    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository = new SessionRepository(Database::getConnection());

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();

        $user = new User();
        $user->nama = "Person Test 1";
        $user->email = "balqis@email.com";
        $user->password = "balqis@email.com";
        $this->userRepository->save($user);
    }

    public function testSaveSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->email = "balqis@email.com";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals($result->id, $session->id);
        self::assertEquals($result->email, $session->email);
    }

    public function testDeleteByIdSuccess()
    {
        $session = new Session();
        $session->id = uniqid();
        $session->email = "balqis@email.com";

        $this->sessionRepository->save($session);

        $result = $this->sessionRepository->findById($session->id);

        self::assertEquals($result->id, $session->id);
        self::assertEquals($result->email, $session->email);

        $this->sessionRepository->deleteById($session->id);

        $result = $this->sessionRepository->findById($session->id);
        self::assertNull($result);
    }

    public function testFindByIdNotFound()
    {
        $result = $this->sessionRepository->findById('notfound');
        self::assertNull($result);
    }
}
