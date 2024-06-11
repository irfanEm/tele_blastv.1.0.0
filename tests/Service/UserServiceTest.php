<?php

namespace IRFANEM\TELE_BLAST\Service;

use PHPUnit\Framework\TestCase;
use IRFANEM\TELE_BLAST\Domain\User;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\UserRegisterRequest;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Model\UserLoginRequest;
use IRFANEM\TELE_BLAST\Model\UserPasswordUpdateRequest;
use IRFANEM\TELE_BLAST\Model\UserProfileUpdateRequest;

class UserServiceTest extends TestCase
{
    private UserService $userService;
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
        $this->sessionRepository = new SessionRepository(Database::getConnection());
        $this->userService = new UserService($this->userRepository);

        $this->sessionRepository->deleteAll();
        $this->userRepository->deleteAll();
    }

    public function testRegisterSukses()
    {
        $request = new UserRegisterRequest();
        $request->nama = "User baru 1";
        $request->email = "newUser@user.com";
        $request->password = "newUser888";

        $this->userService->register($request);

        $response = $this->userRepository->findByEmail($request->email);

        self::assertNotNull($response);
        self::assertEquals($request->nama, $response->nama);
        self::assertEquals($request->email, $response->email);
        self::assertTrue(password_verify($request->password, $response->password));
    }

    public function testRegisterFailed()
    {
        $this->expectExceptionMessage("Nama, email dan password wajib diisi !");
        $this->expectException(ValidationException::class);
        $request = new UserRegisterRequest();
        $request->nama = "";
        $request->email = "";
        $request->password = "";

        $this->userService->register($request);
    }

    public function testRegisterDuplicate()
    {
        $user = new User();
        $user->nama = "person test 1";
        $user->email = "personTest1@user.com";
        $user->password = "rahasianegara";

        $this->userRepository->save($user);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Email sudah digunakan !");

        $request = new UserRegisterRequest();
        $request->nama = "person test 1";
        $request->email = "personTest1@user.com";
        $request->password = "rahasianegara";

        $this->userService->register($request);
    }

    public function testLoginSuccess()
    {
        $user = new User();
        $user->nama = "person test 1";
        $user->email = "personTest1@user.com";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        $request = new UserLoginRequest();
        $request->email = "personTest1@user.com";
        $request->password = "rahasianegara";

        $response = $this->userService->login($request);

        self::assertEquals($response->user->email, $request->email);
        self::assertTrue(password_verify($request->password, $response->user->password));
    }

    public function testLoginWrongPassword()
    {
        $user = new User();
        $user->nama = "person test 1";
        $user->email = "personTest1@user.com";
        $user->password = password_hash("rahasianegara", PASSWORD_BCRYPT);

        $this->userRepository->save($user);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Email atau password salah.");
        $request = new UserLoginRequest();
        $request->email = "personTest1@user.com";
        $request->password = "salah";

        $this->userService->login($request);
    }

    public function testLoginEmailNotFound()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Email tidak ditemukan, silahkan registrasi dahulu.");
        $request = new UserLoginRequest();
        $request->email = "emailNotFound@user.com";
        $request->password = "ga tau";

        $this->userService->login($request);
    }

    public function testUpdateSuccess()
    {
        $user = new User();
        $user->nama = "person test 1";
        $user->email = "personTest1@user.com";
        $user->password = "rahasianegara";

        $this->userRepository->save($user);
        
        $result = $this->userRepository->findByEmail($user->email);
        $request = new UserProfileUpdateRequest();
        $request->id = $result->id;
        $request->nama = "Orang Test 1";
        $request->email = "testOrang1@user.com";
        $request->level = 2;

        $response = $this->userService->updateProfile($request);
        self::assertEquals($response->user->id, $request->id);
        self::assertEquals($response->user->nama, $request->nama);
        self::assertEquals($response->user->email, $request->email);
        self::assertEquals($response->user->level, $request->level);
    }

    public function testUpdateValidationException()
    {
        $user = new User();
        $user->nama = "person test 1";
        $user->email = "personTest1@user.com";
        $user->password = "rahasianegara";

        $this->userRepository->save($user);
        
        $result = $this->userRepository->findByEmail($user->email);

        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Nama, email dan level wajib diisi !");

        $request = new UserProfileUpdateRequest();
        $request->nama = "";
        $request->email = "";

        $this->userService->updateProfile($request);
    }

    public function testUpdateNotFound()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("User tidak ditemukan !");
        $request = new UserProfileUpdateRequest();
        $request->id = 2000;
        $request->nama = "Test update";
        $request->email = "testUpdate@mail.com";
        $request->level = 3;

        $this->userService->updateProfile($request);
    }

    public function testUpdatePasswordSuccess()
    {
        $user = new User();
        $user->nama = "Anonymous 1";
        $user->email = "anonymous1@mail.com";
        $user->password = password_hash("anon1234", PASSWORD_BCRYPT);

        $this->userRepository->save($user);
        $result = $this->userRepository->findByEmail($user->email);

        $request = new UserPasswordUpdateRequest();
        $request->id = $result->id;
        $request->oldPassword = "anon1234";
        $request->newPassword = "rahasia999";

        $response = $this->userService->updatePassword($request);

        self::assertTrue(password_verify($request->newPassword, $response->user->password));
    }

    public function testUpdateaPasswordOldPassWrong()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Password lama salah !");
        $user = new User();
        $user->nama = "Anonymous 1";
        $user->email = "anonymous1@mail.com";
        $user->password = password_hash("anon1234", PASSWORD_BCRYPT);

        $this->userRepository->save($user);
        $result = $this->userRepository->findByEmail($user->email);

        $request = new UserPasswordUpdateRequest();
        $request->id = $result->id;
        $request->oldPassword = "salah";
        $request->newPassword = "rahasia999";

        $this->userService->updatePassword($request);
    }

    public function testUpdatePasswordValidationError()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("Id, Old Password, dan New Password wajib diisi !");

        $request = new UserPasswordUpdateRequest();
        $request->oldPassword = "";
        $request->newPassword = "";

        $this->userService->updatePassword($request);
    }

    public function testUpdatePasswordUserNotFound()
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage("User Id tidak ditemukan !");

        $request = new UserPasswordUpdateRequest();
        $request->id = 2000;
        $request->oldPassword = "passwordLama";
        $request->newPassword = "passwordBaru";

        $this->userService->updatePassword($request);
    }

}
