<?php

namespace IRFANEM\TELE_BLAST\Service;

use IRFANEM\TELE_BLAST\Domain\User;
use IRFANEM\TELE_BLAST\Domain\Session;
use IRFANEM\TELE_BLAST\Repository\UserRepository;
use IRFANEM\TELE_BLAST\Repository\SessionRepository;

class SessionService
{

    public static string $COOKIE_NAME = "X-IRFANEM-SESSION";

    private SessionRepository $sessionRepository;
    private UserRepository $userRepository;

    public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
    {
        $this->sessionRepository = $sessionRepository;
        $this->userRepository = $userRepository;
    }
    
    public function create(string $email): Session
    {

        $session = new Session();
        $session->id = uniqid();
        $session->email = $email;

        $this->sessionRepository->save($session);

        setcookie(self::$COOKIE_NAME, $session->id, time() + 3600, "/");

        return $session;
    }

    public function destroy()
    {

        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $this->sessionRepository->deleteById($sessionId);
        setcookie(self::$COOKIE_NAME, '', 1, "/");

    }

    public function current(): ?User
    {

        $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? '';
        $session = $this->sessionRepository->findById($sessionId);
        if($session == null) {
            return null;
        }

        return $this->userRepository->findByEmail($session->email);
    }

}
