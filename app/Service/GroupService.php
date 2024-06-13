<?php

namespace IRFANEM\TELE_BLAST\Service;

use Exception;
use IRFANEM\TELE_BLAST\Domain\Group;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\GroupTambahRequest;
use IRFANEM\TELE_BLAST\Model\GroupUpdateRequest;
use IRFANEM\TELE_BLAST\Model\GroupTambahResponse;
use IRFANEM\TELE_BLAST\Model\GroupUpdateResponse;
use IRFANEM\TELE_BLAST\Repository\GroupRepository;
use IRFANEM\TELE_BLAST\Exception\ValidationException;

class GroupService
{
    private GroupRepository $groupRepository;

    public function __construct()
    {
        $this->groupRepository = new GroupRepository(Database::getConnection());
    }

    public function tambahGrup(GroupTambahRequest $request): GroupTambahResponse
    {
        $this->validateTambahGroup($request);

        try{
            Database::beginTransaction();
            $group = new Group();
            $group->id = $request->id;
            $group->nama = $request->nama;
            $group->username = $request->username;

            $this->groupRepository->save($group);
            $response = new GroupTambahResponse();
            $response->group = $group;

            Database::commitTransactiion();
            return $response;
        }catch(Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }

    }

    private function validateTambahGroup(GroupTambahRequest $request)
    {
        if($request->id == null || $request->nama == null || $request->username == null ||
        trim($request->id == "") || trim($request->nama == "") || trim($request->username == "")){
            throw new ValidationException("Id, nama, dan username tidak boleh kosong !");
        }
    }

    public function updateGroup(GroupUpdateRequest $request): GroupUpdateResponse
    {
        $this->validateUpdateGroup($request);

        try{
            Database::beginTransaction();
            $group = new Group();
            $group->nama = $request->nama;
            $group->username = $request->username;

            $this->groupRepository->update($group);
            $response = new GroupUpdateResponse();
            $response->group = $group;

            Database::commitTransactiion();
            return $response;
        }catch(Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }

    }

    private function validateUpdateGroup(GroupUpdateRequest $request)
    {
        if($request->nama == null || $request->username == null || trim($request->nama) == "" || trim($request->username) == ""){
            throw new ValidationException("Nama dan Username tidak boleh kosong !");
        }
    }

}
