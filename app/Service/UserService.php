<?php

namespace IRFANEM\TELE_BLAST\Service;

use Exception;
use IRFANEM\TELE_BLAST\Domain\User;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\UserLoginRequest;
use IRFANEM\TELE_BLAST\Model\UserLoginResponse;
use IRFANEM\TELE_BLAST\Model\UserRegisterRequest;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Model\UserRegisterResponse;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Model\UserProfileUpdateRequest;
use IRFANEM\TELE_BLAST\Model\UserPasswordUpdateRequest;
use IRFANEM\TELE_BLAST\Model\UserProfileUpdateResponse;
use IRFANEM\TELE_BLAST\Model\UserPasswordUpdateResponse;

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(UserRegisterRequest $request): UserRegisterResponse
    {
        $this->validateUserRegistrationRequest($request);

        try {
            Database::beginTransaction();
            $user = $this->userRepository->findByEmail($request->email);
            if($user != null){
                throw new ValidationException("Email sudah digunakan !");
            }

            $user = new User();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->password = password_hash($request->password, PASSWORD_BCRYPT);

            $this->userRepository->save($user);

            $response = new UserRegisterResponse();
            $response->user = $user;

            Database::commitTransactiion();
            return $response;

        }catch(Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }

    }

    private function validateUserRegistrationRequest(UserRegisterRequest $request)
    {
        if($request->nama == null || $request->email == null || $request->password == null || 
        trim($request->nama) == "" || trim($request->email) == "" || trim($request->password) == "")
        {
            throw new ValidationException("Nama, email dan password wajib diisi !");
        }
    }

    public function login(UserLoginRequest $request): UserLoginResponse
    {
        $this->validateUserLoginRequest($request);

        $user = $this->userRepository->findByEmail($request->email);
        if($user == null)
        {
            throw new ValidationException("Email tidak ditemukan, silahkan registrasi dahulu.");
        }

        if(password_verify($request->password, $user->password))
        {
            $response = new UserLoginResponse();
            $response->user = $user;
            return $response;
        }else{
            throw new ValidationException("Email atau password salah.");
        }
    }

    private function validateUserLoginRequest(UserLoginRequest $request)
    {
        if($request->email == null || $request->password == null || 
        trim($request->email) == "" || trim($request->password) == "")
        {
            throw new ValidationException("Email dan password wajib diisi !");
        }
    }

    public function updateProfile(UserProfileUpdateRequest $request): UserProfileUpdateResponse
    {
        $this->validateUserProfileUpdateRequest($request);

        try{
            Database::beginTransaction();
            
            $user = $this->userRepository->findById($request->id);
            if($user == null) {
                throw new ValidationException("User tidak ditemukan !");
            }

            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->level = $request->level;
            $this->userRepository->update($user);

            Database::commitTransactiion();

            $response = new UserProfileUpdateResponse();
            $response->user = $user;
            return $response;

        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }
    }

    private function validateUserProfileUpdateRequest(UserProfileUpdateRequest $request)
    {
        if($request->nama == null || $request->email == null || $request->level == null || 
        trim($request->nama) == "" || trim($request->email) == ""|| trim($request->level) == "")
        {
            throw new ValidationException("Nama, email dan level wajib diisi !");
        }
    }

    public function updatePassword(UserPasswordUpdateRequest $request): UserPasswordUpdateResponse
    {
        $this->validationUserPasswordUpdateRequest($request);

        try{
            Database::beginTransaction();

            $user = $this->userRepository->findById($request->id);
            if ($user == null) {
                throw new ValidationException("User Id tidak ditemukan !");
            }

            if(!password_verify($request->oldPassword, $user->password)) {
                throw new ValidationException("Password lama salah !");
            }

            $user->password = password_hash($request->newPassword, PASSWORD_BCRYPT);
            $this->userRepository->update($user);

            Database::commitTransactiion();

            $response = new UserPasswordUpdateResponse();
            $response->user = $user;
            return $response;
            
        }catch(\Exception $exception){
            Database::rollbackTransaction();
            throw $exception;
        }

    }

    private function validationUserPasswordUpdateRequest(UserPasswordUpdateRequest $request)
    {
        if($request->id == null || $request->oldPassword == null || $request->newPassword == null || 
        trim($request->id) == "" || trim($request->oldPassword) == "" || trim($request->newPassword) == "")
        {
            throw new ValidationException("Id, Old Password, dan New Password wajib diisi !");
        }
    }
}
