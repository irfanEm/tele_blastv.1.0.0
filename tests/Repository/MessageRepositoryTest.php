<?php

namespace IRFANEM\TELE_BLAST\Repository;

use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Domain\Message;
use PHPUnit\Framework\TestCase;

class MessageRepositoryTest extends TestCase
{
    private MessageRepository $messageRepository;

    public function setUp(): void
    {
        $this->messageRepository = new MessageRepository(Database::getConnection());

        $this->messageRepository->deleteAll();
    }

    public function testSaveMessageSuccess()
    {
        $msg = new Message();
        $msg->id = uniqid();
        $msg->judul = 'Judul Test';
        $msg->pesan = 'Lorem IpsumConsequatur beatae consectetur voluptate quod fugit esse quae. Numquam exercitationem voluptatum fugiat cupiditate consequatur. Dignissimos magni et perspiciatis. Nobis voluptatibus quo et quia error. Aut consequuntur magni ipsa eos sequi quas.';

        $this->messageRepository->save($msg);

        $result = $this->messageRepository->findById($msg->id);

        self::assertNotNull($result);
        self::assertEquals($msg->id, $result->id);
        self::assertEquals($msg->judul, $result->judul);
        self::assertEquals($msg->pesan, $result->pesan);
    }

    public function testFindByIdNotFound()
    {
        $msg = $this->messageRepository->findById('notFound');
        self::assertNull($msg);
    }

    public function testUpdate()
    {
        $msg = new Message();
        $msg->id = uniqid();
        $msg->judul = 'Judul Test';
        $msg->pesan = 'Lorem IpsumConsequatur beatae consectetur voluptate quod fugit esse quae. Numquam exercitationem voluptatum fugiat cupiditate consequatur. Dignissimos magni et perspiciatis. Nobis voluptatibus quo et quia error. Aut consequuntur magni ipsa eos sequi quas.';

        $this->messageRepository->save($msg);

        $msg->judul = 'Judul Revisi';
        $msg->pesan = 'Dolor expedita et. Aliquam eum error corporis et ratione asperiores molestiae architecto. At dignissimos ipsum enim doloremque sequi minus voluptas.
 
        Eligendi expedita aperiam repellendus minus. Quaerat voluptas in numquam temporibus rerum deserunt esse ullam. Et veniam voluptatem.
        
        Quibusdam incidunt delectus debitis dolor. Et corrupti optio veniam officia. Exercitationem culpa maiores qui eveniet et eum harum ut quae.';

        $result = $this->messageRepository->findById($msg->id);

        self::assertNotNull($result);
        self::assertEquals($msg->id, $result->id);
        self::assertEquals($msg->judul, $result->judul);
        self::assertEquals($msg->pesan, $result->pesan);
    }

    public function testDeleteById()
    {
        $msg = new Message();
        $msg->id = uniqid();
        $msg->judul = 'Judul Test 4';
        $msg->pesan = 'Ut et pariatur quia quaerat maxime rerum. Qui aut accusamus quod optio autem sed iusto eum. Quis enim et consequatur repudiandae architecto voluptatibus. Qui et eos asperiores quidem.';

        $this->messageRepository->save($msg);

        $this->messageRepository->delete($msg->id);

        $result = $this->messageRepository->findById($msg->id);

        self::assertNull($result);
    }

    public function testGetAllUsers()
    {
        $msg = new Message();
        $msg->id = uniqid();
        $msg->judul = 'Judul Test';
        $msg->pesan = 'Dicta dolorum commodi quas repellendus consequatur exercitationem esse. Omnis doloribus voluptate quam sed delectus commodi in. Provident delectus sit fugit aperiam earum consequatur et. Quas dolor ratione quaerat optio animi asperiores.';

        $this->messageRepository->save($msg);

        $msg = new Message();
        $msg->id = uniqid();
        $msg->judul = 'Judul Test 2';
        $msg->pesan = 'Voluptas dicta suscipit ut qui molestiae quidem in iure. Est a aut rerum. Animi cumque iste beatae et ut magni consequatur.';

        $this->messageRepository->save($msg);

        $msg = new Message();
        $msg->id = uniqid();
        $msg->judul = 'Judul Test 3';
        $msg->pesan = 'Illo nulla accusamus hic quos enim et sed qui ea. Nemo nulla perspiciatis neque ut eaque quos consequatur. Iusto rerum deleniti voluptatem consequuntur eos. Incidunt temporibus cumque voluptatem quasi excepturi et consequatur id ut. Enim temporibus nemo fugit blanditiis beatae voluptatem tempora.';

        $this->messageRepository->save($msg);

        $messages = $this->messageRepository->getAll();

        self::assertNotNull($messages);
        self::assertCount(3, $messages);
    }

}
