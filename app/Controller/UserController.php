<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Service\UserService;
use IRFANEM\TELE_BLAST\Model\UserLoginRequest;
use IRFANEM\TELE_BLAST\Service\SessionService;
use IRFANEM\TELE_BLAST\Model\UserRegisterRequest;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Model\UserProfileUpdateRequest;
use IRFANEM\TELE_BLAST\Model\UserPasswordUpdateRequest;

class UserController
{
    private UserService $userService;
    private SessionService $sessionService;

    /**
     * Class constructor.
     */
    public function __construct()
    {
        $connection = Database::getConnection();
        $userRepository = new UserRepository($connection);
        $this->userService = new UserService($userRepository);

        $sessionRepository = new SessionRepository($connection);
        $this->sessionService = new SessionService($sessionRepository, $userRepository);
    }
    public function daftar()
    {
        View::render('User/daftar', [
            "title" => "Daftar",
        ]);
    }
    public function posDaftar()
    {
        $request = new UserRegisterRequest();
        $request->nama = $_POST['nama'];
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];

        try{
            $this->userService->register($request);
            View::redirect('/user/login');
        }catch(ValidationException $exception){
            View::render('User/daftar', [
                "title" => "Daftar",
                "error" => [
                    "pesan" => $exception->getMessage(),
                    "type" => "danger"
                ]
            ]);
        }
    }

    public function login()
    {
        View::render('User/login', [
            "title" => "Login"
        ]);
    }

    public function postLogin()
    {
        $request = new UserLoginRequest();
        $request->email = $_POST['email'];
        $request->password = $_POST['password'];

        try {
            $response = $this->userService->login($request);
            $this->sessionService->create($response->user->email);
            View::redirect('/');
        } catch (ValidationException $exception) {
            View::render('User/login', [
                "title" => "Login",
                "error" => [
                    "pesan" => $exception->getMessage(),
                    "type" => "danger"
                ]
            ]);
        }
    }

    public function logout()
    {
        $this->sessionService->destroy();
        View::redirect('/');
    }

    public function updateProfile()
    {
        $user = $this->sessionService->current();

        View::render('User/profile', [
            "title" => "Update User Profile",
            "user" => [
                'id' => $user->id,
                'nama' => $user->nama
            ]
        ]);
    }

    public function postUpdateProfile()
    {
        $user = $this->sessionService->current();

        $request = new UserProfileUpdateRequest();
        $request->id = $user->id;
        $request->nama = $_POST['nama'];

        try{
            $this->userService->updateProfile($request);
            View::redirect('/');
        }catch(ValidationException $exception){

            View::render('User/profile', [
                "title" => "Update User Profile",
                "error" => $exception->getMessage(),
                "user" => [
                    'id' => $user->id,
                    'nama' => $_POST['nama']
                ]
            ]);

        }
    }

    public function updatePassword()
    {
        $user = $this->sessionService->current();

        View::render('User/password', [
            "title" => "Update User Password",
            "user" => [
                'id' => $user->id
            ]
        ]);
    }

    public function postUpdatePassword()
    {
        $user = $this->sessionService->current();

        $request = new UserPasswordUpdateRequest();
        $request->id = $user->id;
        $request->oldPassword = $_POST['oldPassword'];
        $request->newPassword = $_POST['newPassword'];

        try{
            $this->userService->updatePassword($request);
            View::redirect('/');
        }catch(ValidationException $exception){
            View::render('User/password', [
                "title" => "Update User Password",
                "error" => $exception->getMessage(),
                "user" => [
                    'id' => $user->id
                ]
            ]);
        }
    }

}
