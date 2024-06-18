<?php

namespace IRFANEM\TELE_BLAST\Repository;

use IRFANEM\TELE_BLAST\Domain\Message;
use PHPUnit\Framework\TestCase;
use IRFANEM\TELE_BLAST\Domain\Group;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Domain\BroadcastMessage;
use IRFANEM\TELE_BLAST\Repository\GroupRepository;
use IRFANEM\TELE_BLAST\Repository\MessageRepository;

class BroadcastMessageRepositoryTest extends TestCase
{
    private BroadcastMessageRepository $bcRepository;
    private MessageRepository $messageRepository;
    private GroupRepository $groupRepository;
    private string $messageId;
    private string $groupId;

    protected function setUp(): void
    {
        $group = new Group();
        $group->id = '-210321';
        $group->nama = 'BalqisGroup';
        $group->username = 't.me/balqis_telegroup';

        $this->groupRepository->save($group);
        
        $message = new Message();
        $message->id = uniqid();
        $message->judul = 'Judul Test';
        $message->pesan = 'Est totam et dolor. Adipisci ipsa eum enim et. Voluptas et est voluptatem fugit labore maiores. In distinctio vitae fuga asperiores. Doloremque labore cumque officia harum dolor.';
        
        $this->messageRepository->save($message);

        $this->bcRepository = new BroadcastMessageRepository(Database::getConnection());
        $this->messageId = $message->id;
        $this->groupId = $group->id;

        $this->bcRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = $this->groupId;
        $bcMessage->messageId = $this->messageId;
        $bcMessage->waktu = '2024-11-27 12:00:00';
        $bcMessage->status = 1;

        $this->bcRepository->save($bcMessage);

        $result = $this->bcRepository->findById($bcMessage->id);

        self::assertNotNull($result);
        self::assertEquals($result->groupId, $bcMessage->groupId);
        self::assertEquals($result->messageId, $bcMessage->messageId);
        self::assertEquals($result->waktu, $bcMessage->waktu);
        self::assertEquals($result->status, $bcMessage->status);

        var_dump($result);
    }

}
