<?php

namespace IRFANEM\TELE_BLAST\Repository;

use PHPUnit\Framework\TestCase;
use IRFANEM\TELE_BLAST\Domain\User;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    public function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());

        $this->userRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $user = new User();
        $user->email = "person1@user.com";
        $user->password = "rahasia";

        $this->userRepository->save($user);
        $result = $this->userRepository->findByEmail("person1@user.com");

        self::assertNotNull($result);
        self::assertEquals("person1@user.com", $result->email);
        self::assertEquals("rahasia", $result->password);
        self::assertEquals(0, $result->level);

    }

    public function testFindNotFound()
    {
        $user = $this->userRepository->findByEmail("notFound");
        self::assertNull($user);
    }

    public function testUpdate()
    {
        $user = new User();
        $user->email = "person1@user.com";
        $user->password = "rahasia";

        $this->userRepository->save($user);
        $current = $this->userRepository->findByEmail($user->email);

        $user->id = $current->id;
        $user->password = "123qwerty";
        $user->level = 2;
        $this->userRepository->update($user);

        
        $result = $this->userRepository->findByEmail($user->email);
        
        self::assertNotNull($result);
        self::assertEquals($user->email, $result->email);
        self::assertEquals($user->password, $result->password);
        self::assertEquals($user->level, $result->level);
    }

}
