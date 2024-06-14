<?php

namespace IRFANEM\TELE_BLAST\Service;

use PHPUnit\Framework\TestCase;
use IRFANEM\TELE_BLAST\Domain\Group;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Service\GroupService;
use IRFANEM\TELE_BLAST\Model\GroupTambahRequest;
use IRFANEM\TELE_BLAST\Repository\GroupRepository;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Model\GroupDeleteRequest;
use IRFANEM\TELE_BLAST\Model\GroupUpdateRequest;

class GroupServiceTest extends TestCase
{

    private GroupRepository $groupRepository;
    private GroupService $groupService;

    protected function setUp(): void
    {
        $this->groupRepository = new GroupRepository(Database::getConnection());
        $this->groupService = new GroupService($this->groupRepository);

        $this->groupRepository->deleteAll();
    }

    public function testTambahGroupSuccess()
    {
        $request = new GroupTambahRequest();
        $request->id = '-210321';
        $request->nama = 'Group Balqis FA';
        $request->username = 't.me/balqis_fa';

        $this->groupService->tambahGrup($request);

        $response = $this->groupRepository->findById($request->id);

        self::assertNotNull($response);
        self::assertEquals($request->id, $response->id);
        self::assertEquals($request->nama, $response->nama);
        self::assertEquals($request->username, $response->username);
    }

    public function testTambahGroupValidationExcept()
    {
        self::expectException(ValidationException::class);
        self::expectExceptionMessage("Id, nama, dan username tidak boleh kosong !");
        
        $request = new GroupTambahRequest();
        $request->id = '';
        $request->nama = '';
        $request->username = '';

        $this->groupService->tambahGrup($request);
    }

    public function testTambahGroupDuplicate()
    {
        $group = new Group();
        $group->id = '-210321';
        $group->nama = 'Group Balqis FA';
        $group->username = 't.me/balqis_fa';

        $this->groupRepository->save($group);

        self::expectException(ValidationException::class);
        self::expectExceptionMessage("Id group sudah digunakan !");

        $request = new GroupTambahRequest();
        $request->id = '-210321';
        $request->nama = 'Group Balqis FA';
        $request->username = 't.me/balqis_fa';

        $this->groupService->tambahGrup($request);

    }

    public function testUpdateGroup()
    {
        $group = new Group();
        $group->id = '-210321';
        $group->nama = 'Group Balqis FA';
        $group->username = 't.me/balqis_fa';

        $this->groupRepository->save($group);
        $result = $this->groupRepository->findById($group->id);

        $request = new GroupUpdateRequest();
        $request->id = $result->id;
        $request->nama = 'shilvia_group';
        $request->username = 't.me/shilvia_group';

        $response = $this->groupService->updateGroup($request);

        self::assertNotNull($response);
        self::assertEquals($request->nama, $response->group->nama);
        self::assertEquals($request->username, $response->group->username);
    }

    public function testUpdateGroupValidationException()
    {
        $group = new Group();
        $group->id = '-210321';
        $group->nama = 'Group Balqis FA';
        $group->username = 't.me/balqis_fa';

        $this->groupRepository->save($group);
        $result = $this->groupRepository->findById($group->id);

        self::expectException(ValidationException::class);
        self::expectExceptionMessage("Nama dan Username tidak boleh kosong !");

        $request = new GroupUpdateRequest();
        $request->id = $result->id;
        $request->nama = '';
        $request->username = '';

        $this->groupService->updateGroup($request);
    }

    public function testHapusGrupById()
    {
        $group = new Group();
        $group->id = '-210321';
        $group->nama = 'Group Balqis FA';
        $group->username = 't.me/balqis_fa';

        $this->groupRepository->save($group);
        
        $request = new GroupDeleteRequest();
        $request->id = $group->id;
        $this->groupService->deleteById($request);

        $result = $this->groupRepository->findById($group->id);
        self::assertNull($result);
    }

    public function testHapusByIdValidationException()
    {
        $group = new Group();
        $group->id = '-210321';
        $group->nama = 'Group Balqis FA';
        $group->username = 't.me/balqis_fa';

        $this->groupRepository->save($group);
        
        self::expectException(ValidationException::class);
        self::expectExceptionMessage("Group Id tidak ditemukan !");
        
        $request = new GroupDeleteRequest();
        $request->id = "";
        $this->groupService->deleteById($request);

        $result = $this->groupRepository->findById($group->id);
        self::assertNotNull($result);
    }

}
