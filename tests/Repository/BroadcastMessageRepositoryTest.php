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
        $this->messageRepository = new MessageRepository(Database::getConnection());
        $this->groupRepository = new GroupRepository(Database::getConnection());
        $this->bcRepository = new BroadcastMessageRepository(Database::getConnection());

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

        $this->messageId = $message->id;
        $this->groupId = $group->id;

        $this->bcRepository->deleteAll();
        $this->groupRepository->deleteAll();
        $this->messageRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = $this->groupId;
        $bcMessage->messageId = $this->messageId;
        $bcMessage->waktu = '12:00:00';
        $bcMessage->status = 1;

        $this->bcRepository->save($bcMessage);

        $result = $this->bcRepository->findById($bcMessage->id);

        self::assertNotNull($result);
        self::assertEquals($result->groupId, $bcMessage->groupId);
        self::assertEquals($result->messageId, $bcMessage->messageId);
        self::assertEquals($result->waktu, $bcMessage->waktu);
        self::assertEquals($result->status, $bcMessage->status);
    }

    public function testUpdate()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = $this->groupId;
        $bcMessage->messageId = $this->messageId;
        $bcMessage->waktu = '12:00:00';
        $bcMessage->status = 1;
        $this->bcRepository->save($bcMessage);

        $bcMessage->groupId = uniqid();
        $bcMessage->messageId = uniqid();
        $bcMessage->waktu = '15:00:00';
        $bcMessage->status = 0;

        $this->bcRepository->update($bcMessage);

        $result = $this->bcRepository->findById($bcMessage->id);

        self::assertNotNull($result);
        self::assertEquals($result->groupId, $bcMessage->groupId);
        self::assertEquals($result->messageId, $bcMessage->messageId);
        self::assertEquals($result->waktu, $bcMessage->waktu);
        self::assertEquals($result->status, $bcMessage->status);
    }

    public function testDeleteById()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = $this->groupId;
        $bcMessage->messageId = $this->messageId;
        $bcMessage->waktu = '12:00:00';
        $bcMessage->status = 1;
        $this->bcRepository->save($bcMessage);

        $this->bcRepository->delete($bcMessage->id);

        $result = $this->bcRepository->findById($bcMessage->id);

        self::assertNull($result);
    }

    public function testGetAll()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = $this->groupId;
        $bcMessage->messageId = $this->messageId;
        $bcMessage->waktu = '2024-11-27 12:00:00';
        $bcMessage->status = 1;
        $this->bcRepository->save($bcMessage);

        $group1 =  new Group();
        $group1->id = uniqid();
        $group1->nama = 'grupTest01';
        $group1->username = 't.me/grup_test01';
        $this->groupRepository->save($group1);

        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = $this->groupId;
        $bcMessage->messageId = $this->messageId;
        $bcMessage->waktu = '2024-11-27 12:00:00';
        $bcMessage->status = 1;
        $this->bcRepository->save($bcMessage);

        $group2 =  new Group();
        $group2->id = uniqid();
        $group2->nama = 'grupTest02';
        $group2->username = 't.me/grup_test02';
        $this->groupRepository->save($group2);

        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = $this->groupId;
        $bcMessage->messageId = $this->messageId;
        $bcMessage->waktu = '2024-11-27 12:00:00';
        $bcMessage->status = 1;
        $this->bcRepository->save($bcMessage);

        $result = $this->bcRepository->getAll();

        self::assertNotNull($result);
        self::assertCount(3, $result);

    }

}
