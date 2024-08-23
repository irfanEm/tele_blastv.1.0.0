<?php

namespace IRFANEM\TELE_BLAST\Helper;

class Alert
{
    public static function setFlash(string $key, array $message): void
    {
        $_SESSION[$key] = $message;
    }

    public static function getFlash(string $key): ?array
    {
        if (isset($_SESSION[$key])) {
            $message = $_SESSION[$key];
            unset($_SESSION[$key]); // Hapus pesan setelah diambil
            return $message;
        }
        return null;
    }
}
