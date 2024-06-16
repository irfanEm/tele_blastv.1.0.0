<?php

namespace IRFANEM\TELE_BLAST\Domain;

use DateTime;

class BroadcastMessage
{
    public string $id;
    public string $messageId;
    public string $groupId;
    public DateTime $waktu;
    public int $status;
}
