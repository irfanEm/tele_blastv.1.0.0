<?php

namespace IRFANEM\TELE_BLAST\Domain;

class User
{
    public ?int $id = null;
    public string $email;
    public string $nama;
    public string $password;
    public ?int $level = 0;
}
