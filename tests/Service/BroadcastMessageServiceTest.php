<?php

namespace IRFANEM\TELE_BLAST\Service;

use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Domain\BroadcastMessage;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Model\BCAddRequest;
use IRFANEM\TELE_BLAST\Model\BCUpdateRequest;
use IRFANEM\TELE_BLAST\Repository\BroadcastMessageRepository;
use PHPUnit\Framework\TestCase;

class BroadcastMessageServiceTest extends TestCase
{
    private BroadcastMessageRepository $broadcastMessageRepository;
    private BroadcastMessageService $broadcastMessageService;

    protected function setUp(): void
    {
        $this->broadcastMessageRepository = new BroadcastMessageRepository(Database::getConnection());
        $this->broadcastMessageService = new BroadcastMessageService($this->broadcastMessageRepository);

        $this->broadcastMessageRepository->deleteAll();
    }

    public function testAddBCMessageSuccess()
    {
        $request = new BCAddRequest();
        $request->id = uniqid();
        $request->groupId = '-210321';
        $request->messageId = uniqid();
        $request->waktu = '12:00:21';
        $request->status = 1;

        $response = $this->broadcastMessageService->simpanBc($request);

        self::assertNotNull($response);
        self::assertEquals($response->broadcastMessage->groupId, $request->groupId);
        self::assertEquals($response->broadcastMessage->messageId, $request->messageId);
        self::assertEquals($response->broadcastMessage->waktu, $request->waktu);
        self::assertEquals($response->broadcastMessage->status, $request->status);
    }

    public function testAddBCMessageValException()
    {
        self::expectException(ValidationException::class);
        self::expectExceptionMessage('Id pesan, group, waktu dan status wajib diisi !');

        $request = new BCAddRequest();
        $request->id ='';
        $request->groupId = '-210321';
        $request->messageId = uniqid();
        $request->waktu = '12:00:21';
        $request->status = 1;

        $response = $this->broadcastMessageService->simpanBc($request);

        self::assertNull($response);
    }

    public function testAddBCMessageIdFound()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = '-210321';
        $bcMessage->messageId = uniqid();
        $bcMessage->waktu = '12:34:00';
        $bcMessage->status = 0;

        $response = $this->broadcastMessageRepository->save($bcMessage);

        self::expectException(ValidationException::class);
        self::expectExceptionMessage('Pesan broadcast dengan Id tersebut sudah ada !');

        $request = new BCAddRequest();
        $request->id = $response->id;
        $request->groupId = '-210321';
        $request->messageId = uniqid();
        $request->waktu = '12:00:21';
        $request->status = 1;

        $this->broadcastMessageService->simpanBc($request);
    }

    public function testBCUpdateSuccess()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = '-210321';
        $bcMessage->messageId = uniqid();
        $bcMessage->waktu = '12:34:00';
        $bcMessage->status = 0;

        $bcCurrent = $this->broadcastMessageRepository->save($bcMessage);

        $bcMessageUpdate = new BCUpdateRequest();
        $bcMessageUpdate->id = $bcCurrent->id;
        $bcMessageUpdate->groupId = '-271197';
        $bcMessageUpdate->messageId = uniqid();
        $bcMessageUpdate->waktu = '23:10:00';
        $bcMessageUpdate->status = 2;

        $response = $this->broadcastMessageService->updateBc($bcMessageUpdate);

        self::assertNotNull($response);
        self::assertEquals($response->broadcastMessage->id, $bcMessageUpdate->id);
        self::assertEquals($response->broadcastMessage->groupId, $bcMessageUpdate->groupId);
        self::assertEquals($response->broadcastMessage->messageId, $bcMessageUpdate->messageId);
        self::assertEquals($response->broadcastMessage->waktu, $bcMessageUpdate->waktu);
        self::assertEquals($response->broadcastMessage->status, $bcMessageUpdate->status);
    }

    public function testBCUpdateValidationException()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = '-210321';
        $bcMessage->messageId = uniqid();
        $bcMessage->waktu = '12:34:00';
        $bcMessage->status = 0;

        $this->broadcastMessageRepository->save($bcMessage);

        self::expectException(ValidationException::class);
        self::expectExceptionMessage('Id pesan, group, waktu dan status wajib diisi !');

        $bcMessageUpdate = new BCUpdateRequest();
        $bcMessageUpdate->id = '';
        $bcMessageUpdate->groupId = '';
        $bcMessageUpdate->messageId = uniqid();
        $bcMessageUpdate->waktu = '23:10:00';
        $bcMessageUpdate->status = 2;

        $response = $this->broadcastMessageService->updateBc($bcMessageUpdate);

        self::assertNull($response);
    }

    public function testBCUpdateIdNotFound()
    {
        self::expectException(ValidationException::class);
        self::expectExceptionMessage('Id broadcast message tidak ditemukan !');

        $bcMessageUpdate = new BCUpdateRequest();
        $bcMessageUpdate->id = 'notFound';
        $bcMessageUpdate->groupId = '-271197';
        $bcMessageUpdate->messageId = uniqid();
        $bcMessageUpdate->waktu = '23:10:00';
        $bcMessageUpdate->status = 2;

        $response = $this->broadcastMessageService->updateBc($bcMessageUpdate);

        self::assertNull($response);
    }

    public function testDeleteById()
    {
        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = '-210321';
        $bcMessage->messageId = uniqid();
        $bcMessage->waktu = '12:34:00';
        $bcMessage->status = 0;

        $response = $this->broadcastMessageRepository->save($bcMessage);

        $this->broadcastMessageService->deleteBcMessage($response->id);

        $result = $this->broadcastMessageRepository->findById($response->id);

        self::assertNull($result);
    }

    public function testDeleteBroadcastMessageValidationException()
    {
        self::expectException(ValidationException::class);
        self::expectExceptionMessage('Id tidak boleh kosong !');

        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = '-210321';
        $bcMessage->messageId = uniqid();
        $bcMessage->waktu = '12:34:00';
        $bcMessage->status = 0;

        $this->broadcastMessageRepository->save($bcMessage);

        $this->broadcastMessageService->deleteBcMessage('');
    }

    public function testDeleteBroadcastMessageIdNotFound()
    {
        self::expectException(ValidationException::class);
        self::expectExceptionMessage('Id tidak ditemukan !');

        $bcMessage = new BroadcastMessage();
        $bcMessage->id = uniqid();
        $bcMessage->groupId = '-210321';
        $bcMessage->messageId = uniqid();
        $bcMessage->waktu = '12:34:00';
        $bcMessage->status = 0;

        $this->broadcastMessageRepository->save($bcMessage);

        $this->broadcastMessageService->deleteBcMessage('notFound');
    }

}
