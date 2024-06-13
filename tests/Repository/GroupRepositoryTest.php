<?php

namespace IRFANEM\TELE_BLAST\Repository;

use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Domain\Group;
use PHPUnit\Framework\TestCase;

class GroupRepositoryTest extends TestCase
{
    private GroupRepository $groupRepository;

    protected function setUp(): void
    {
        $this->groupRepository = new GroupRepository(Database::getConnection());

        $this->groupRepository->deleteAll();
    }

    public function testSaveSuccess()
    {
        $group = new Group();
        $group->id = '33e445';
        $group->nama = 'Group Testing';
        $group->username = 't.me/group_testing';

        $this->groupRepository->save($group);

        $result = $this->groupRepository->findById($group->id);

        self::assertNotNull($result);
        self::assertEquals($group->id, $result->id);
        self::assertEquals($group->nama, $result->nama);
        self::assertEquals($group->username, $result->username);
    }

    public function testGetAllGroups()
    {
        $group1 = new Group();
        $group1->id = '33e445';
        $group1->nama = 'Group Testing1';
        $group1->username = 't.me/group_testing1';

        $this->groupRepository->save($group1);

        $group2 = new Group();
        $group2->id = '33e447';
        $group2->nama = 'Group Testing3';
        $group2->username = 't.me/group_testing3';

        $this->groupRepository->save($group2);

        $group3 = new Group();
        $group3->id = '33e446';
        $group3->nama = 'Group Testing2';
        $group3->username = 't.me/group_testing2';

        $this->groupRepository->save($group3);

        $result = $this->groupRepository->getAll();

        self::assertNotNull($result);
        self::assertCount(3, $result);
    }

    public function testUpdateGroup()
    {
        $group = new Group();
        $group->id = '33e445';
        $group->nama = 'Group Testing';
        $group->username = 't.me/group_testing';

        $this->groupRepository->save($group);

        $group->nama = "Testing Group 1";
        $group->username = "t.me/testing_group1";

        $this->groupRepository->update($group);

        $result = $this->groupRepository->findById($group->id);

        self::assertNotNull($result);
        self::assertEquals($group->nama, $result->nama);
        self::assertEquals($group->username, $result->username);
    }

}
