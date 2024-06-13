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
        $user->nama = "Test Person 1";
        $user->email = "person1@user.com";
        $user->password = "rahasia";

        $this->userRepository->save($user);
        $result = $this->userRepository->findByEmail("person1@user.com");

        self::assertNotNull($result);
        self::assertEquals("Test Person 1", $result->nama);
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
        $user->nama = "Person Test 1";
        $user->email = "person1@user.com";
        $user->password = "rahasia";

        $this->userRepository->save($user);
        $current = $this->userRepository->findByEmail($user->email);

        $user->id = $current->id;
        $user->nama = "Person Test 2";
        $user->password = "123qwerty";
        $user->level = 2;
        $this->userRepository->update($user);

        
        $result = $this->userRepository->findByEmail($user->email);
        
        self::assertNotNull($result);
        self::assertEquals($user->nama, $result->nama);
        self::assertEquals($user->email, $result->email);
        self::assertEquals($user->password, $result->password);
        self::assertEquals($user->level, $result->level);
    }

    public function testGetAllUsers()
    {
        $user1 = new User();
        $user1->nama = "Person Test 1";
        $user1->email = "person1@user.com";
        $user1->password = "rahasia";

        $this->userRepository->save($user1);

        $user2 = new User();
        $user2->nama = "Person Test 2";
        $user2->email = "person2@user.com";
        $user2->password = "rahasia2";

        $this->userRepository->save($user2);

        $user3 = new User();
        $user3->nama = "Person Test 3";
        $user3->email = "person3@user.com";
        $user3->password = "rahasia3";

        $this->userRepository->save($user3);

        $result = $this->userRepository->getAll();

        self::assertNotNull($result);
        self::assertCount(3, $result);
    }

}
