<?php

namespace IRFANEM\TELE_BLAST\Service;

use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Domain\Message;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Model\MessageAddRequest;
use IRFANEM\TELE_BLAST\Model\MessageUpdateRequest;
use IRFANEM\TELE_BLAST\Repository\MessageRepository;
use PHPUnit\Framework\TestCase;

class MessageServiceTest extends TestCase
{
    private MessageRepository $messageRepository;
    private MessageService $messageService;

    protected function setUp(): void
    {
        $this->messageRepository = new MessageRepository(Database::getConnection());
        $this->messageService = new MessageService($this->messageRepository);

        $this->messageRepository->deleteAll();
    }

    public function testSaveMessageSuccess()
    {
        $request = new MessageAddRequest();
        $request->id = uniqid();
        $request->judul = 'Judul Test 1';
        $request->pesan = 'Esse tempor incididunt sint labore. Exercitation nulla sit veniam amet. Cillum pariatur do culpa eu excepteur sint fugiat veniam Lorem. Amet et dolor nulla in irure cupidatat est nulla adipisicing. Eu pariatur magna amet culpa sint qui ex eu ipsum. Laboris duis non amet nostrud occaecat Lorem duis. Magna eu exercitation proident in duis non sunt pariatur velit ut ex ullamco.';

        $response = $this->messageService->addMessage($request);

        self::assertNotNull($response);
        self::assertEquals($request->judul, $response->message->judul);
        self::assertEquals($request->pesan, $response->message->pesan);
    }

    public function testSaveMessageValidationExcept()
    {
        self::expectException(ValidationException::class);
        self::expectExceptionMessage("Id, judul dan pesan tidak boleh kosong !");

        $request = new MessageAddRequest();
        $request->id = uniqid();
        $request->judul = '';
        $request->pesan = 'Esse tempor incididunt sint labore. Exercitation nulla sit veniam amet. Cillum pariatur do culpa eu excepteur sint fugiat veniam Lorem. Amet et dolor nulla in irure cupidatat est nulla adipisicing. Eu pariatur magna amet culpa sint qui ex eu ipsum. Laboris duis non amet nostrud occaecat Lorem duis. Magna eu exercitation proident in duis non sunt pariatur velit ut ex ullamco.';

        $response = $this->messageService->addMessage($request);

        self::assertNull($response);
    }

    public function testUpdateMessageSuccess()
    {
        $message = new Message();
        $message->id = uniqid();
        $message->judul = 'Judul Test 1';
        $message->pesan = 'Laborum tempor aliqua laboris veniam consequat dolore esse dolore esse dolor. Anim amet qui do sunt ut sunt aliqua occaecat non mollit ea duis. Non quis pariatur ad nostrud ea officia ex fugiat voluptate magna voluptate amet. Ut cupidatat laborum duis sint est nisi officia laborum magna aute exercitation reprehenderit proident sint. Eu commodo excepteur sunt pariatur anim. Ullamco velit incididunt excepteur labore laboris deserunt nulla nisi enim est quis ipsum.';

        $this->messageRepository->save($message);

        $request = new MessageUpdateRequest();
        $request->id = $message->id;
        $request->judul = 'Judul Test Update';
        $request->pesan = 'Qui ipsum id labore quis. Duis esse consectetur sint mollit ut magna veniam. Consequat officia culpa aliquip aliqua mollit in officia. Minim veniam voluptate magna deserunt. Voluptate nostrud ut qui qui deserunt ad magna exercitation veniam esse officia exercitation dolore voluptate. Aliquip aliqua ad occaecat Lorem laborum irure. Mollit sint proident nostrud qui.';

        $response = $this->messageService->updateMessage($request);

        self::assertNotNull($response);
        self::assertEquals($request->judul, $response->message->judul);
        self::assertEquals($request->pesan, $response->message->pesan);
    }

    public function testUpdateMessageValidationExcept()
    {
        $message = new Message();
        $message->id = uniqid();
        $message->judul = 'Judul Test 1';
        $message->pesan = 'Laborum tempor aliqua laboris veniam consequat dolore esse dolore esse dolor. Anim amet qui do sunt ut sunt aliqua occaecat non mollit ea duis. Non quis pariatur ad nostrud ea officia ex fugiat voluptate magna voluptate amet. Ut cupidatat laborum duis sint est nisi officia laborum magna aute exercitation reprehenderit proident sint. Eu commodo excepteur sunt pariatur anim. Ullamco velit incididunt excepteur labore laboris deserunt nulla nisi enim est quis ipsum.';

        $this->messageRepository->save($message);

        self::expectException(ValidationException::class);
        self::expectExceptionMessage("Id pesan tidak ditemukan !");

        $request = new MessageUpdateRequest();
        $request->id = 'notfound';
        $request->judul = 'Judul Test Update';
        $request->pesan = 'Qui ipsum id labore quis. Duis esse consectetur sint mollit ut magna veniam. Consequat officia culpa aliquip aliqua mollit in officia. Minim veniam voluptate magna deserunt. Voluptate nostrud ut qui qui deserunt ad magna exercitation veniam esse officia exercitation dolore voluptate. Aliquip aliqua ad occaecat Lorem laborum irure. Mollit sint proident nostrud qui.';

        $response = $this->messageService->updateMessage($request);

        self::assertNull($response);
    }

    public function testDeleteMessageById()
    {
        $message = new Message();
        $message->id = uniqid();
        $message->judul = 'Judul Test 1';
        $message->pesan = 'Laborum tempor aliqua laboris veniam consequat dolore esse dolore esse dolor. Anim amet qui do sunt ut sunt aliqua occaecat non mollit ea duis. Non quis pariatur ad nostrud ea officia ex fugiat voluptate magna voluptate amet. Ut cupidatat laborum duis sint est nisi officia laborum magna aute exercitation reprehenderit proident sint. Eu commodo excepteur sunt pariatur anim. Ullamco velit incididunt excepteur labore laboris deserunt nulla nisi enim est quis ipsum.';

        $response = $this->messageRepository->save($message);

        $this->messageService->deleteMessage($response->id);

        $result = $this->messageRepository->findById($response->id);

        self::assertNull($result);
    }

    public function testDeleteMessageByIdValidationException()
    {
        self::expectException(ValidationException::class);
        self::expectExceptionMessage("Id pesan tidak ditemukan !");

        $this->messageService->deleteMessage('notFound');
    }

}
