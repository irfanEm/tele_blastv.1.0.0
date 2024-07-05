<?php

namespace IRFANEM\TELE_BLAST\Helper;

class Alert
{
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        self::start();
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    public static function remove($key)
    {
        self::start();
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    public static function setFlash($key, $message)
    {
        self::set($key, $message);
    }

    public static function getFlash($key)
    {
        $message = self::get($key);
        self::remove($key);
        return $message;
    }

}