<?php

namespace IRFANEM\TELE_BLAST\Model;

class UserPasswordUpdateRequest
{
    public ?int $id = null;
    public ?string $email = null;
    public ?string $oldPassword = null;
    public ?string $newPassword = null;
}
