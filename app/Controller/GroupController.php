<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\GroupDeleteRequest;
use IRFANEM\TELE_BLAST\Model\GroupGetByIdRequest;
use IRFANEM\TELE_BLAST\Model\GroupTambahRequest;
use IRFANEM\TELE_BLAST\Model\GroupUpdateRequest;
use IRFANEM\TELE_BLAST\Repository\GroupRepository;
use IRFANEM\TELE_BLAST\Service\GroupService;

class GroupController
{
    private GroupService $groupService;
    private GroupRepository $groupRepository;

    public function __construct()
    {
        $conn = Database::getConnection();
        $this->groupRepository = new GroupRepository($conn);
        $this->groupService = new GroupService($this->groupRepository);
    }

    public function index(): void
    {
        $groups = $this->groupService->getGroups();

        View::render('Group/index', [
            'title' => 'Grup Telegram',
            'groups' => $groups
        ]);
    }

    public function tambah(): void
    {
        View::render('Group/tambah', [
            'title' => 'Tambah Group',
        ]);
    }

    public function postTambah()
    {
        $request = new GroupTambahRequest();
        $request->id = $_POST['id'];
        $request->nama = $_POST['nama'];
        $request->username = $_POST['username'];

        try{
            $this->groupService->tambahGrup($request);
            View::redirect('/group');
        }catch(\Exception $e){
            View::render('Group/tambah',[
                'title' => 'Tambah Group',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function update(string $id)
    {
        $request = new GroupGetByIdRequest();
        $request->id = $id;
        $response = $this->groupService->getGroupById($request);

        View::render('Group/edit',[
            'title' => 'Update Group',
            'id' => $response->group->id,
            'nama' => $response->group->nama,
            'username' => $response->group->username
        ]);
    }

    public function postUpdate()
    {
        $request = new GroupUpdateRequest();
        $request->id = $_POST['id'];
        $request->nama = $_POST['nama'];
        $request->username = $_POST['username'];

        try{
            $this->groupService->updateGroup($request);
            View::redirect('/group');
        }catch(\Exception $e){
            View::render('Group/edit',[
                'title' => 'Tambah Group',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function hapus(string $id)
    {
        $request = new GroupDeleteRequest();
        $request->id = htmlspecialchars($id);
        try{
            $this->groupService->deleteById($request);
            View::redirect("/group");
        }catch (\Exception $e){
            View::render('Group/tambah',[
                'title' => 'Tambah Group',
                'error' => $e->getMessage()
            ]);
        }
    }

}
