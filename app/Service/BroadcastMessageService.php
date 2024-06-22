<?php

namespace IRFANEM\TELE_BLAST\Service;

use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\BCAddRequest;
use IRFANEM\TELE_BLAST\Model\BCAddResponse;
use IRFANEM\TELE_BLAST\Model\BCUpdateRequest;
use IRFANEM\TELE_BLAST\Model\BCUpdateResponse;
use IRFANEM\TELE_BLAST\Domain\BroadcastMessage;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Repository\BroadcastMessageRepository;

class BroadcastMessageService
{
    private BroadcastMessageRepository $broadcastMessageRepository;

    public function __construct(BroadcastMessageRepository $broadcastMessageRepository)
    {
        $this->broadcastMessageRepository = $broadcastMessageRepository;
    }

    public function getAllBc()
    {
        return $this->broadcastMessageRepository->getAll();
    }

    public function getCurrent(string $id): BroadcastMessage
    {
        return $this->broadcastMessageRepository->findById($id);
    }

    public function simpanBc(BCAddRequest $request): BCAddResponse
    {
        $this->validateSimpanBC($request);

        try{
            Database::beginTransaction();

            $broadcastMessage = $this->broadcastMessageRepository->findById($request->id);
            if($broadcastMessage !== null){
                throw new ValidationException("Pesan broadcast dengan Id tersebut sudah ada !");
            }

            $broadcastMessage = new BroadcastMessage();
            $broadcastMessage->id = $request->id;
            $broadcastMessage->messageId = $request->messageId;
            $broadcastMessage->groupId = $request->groupId;
            $broadcastMessage->waktu = $request->waktu;
            $broadcastMessage->status = $request->status;

            $this->broadcastMessageRepository->save($broadcastMessage);

            $response = new BCAddResponse();
            $response->broadcastMessage = $broadcastMessage;

            Database::commitTransactiion();
            
            return $response;
        }catch(\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    protected function validateSimpanBc(BCAddRequest $request)
    {
        if($request->id == null || $request->messageId == null || $request->groupId == null || $request->waktu == null || $request->status == null ||
        trim($request->id) == "" || trim($request->messageId) == "" || trim($request->groupId) == "" || trim($request->waktu) == "" || trim($request->status) == "")
        {
            throw new ValidationException("Id pesan, group, waktu dan status wajib diisi !");
        }
    }

    public function updateBc(BCUpdateRequest $request): BCUpdateResponse
    {
        $this->validateUpdateBc($request);

        try{
            Database::beginTransaction();

            $bcMessage = $this->broadcastMessageRepository->findById($request->id);
            if($bcMessage == null) {
                throw new ValidationException("Id broadcast message tidak ditemukan !");
            }

            $bcMessage->groupId = $request->groupId;
            $bcMessage->messageId = $request->messageId;
            $bcMessage->waktu = $request->waktu;
            $bcMessage->status = $request->status;

            $this->broadcastMessageRepository->update($bcMessage);

            $response = new BCUpdateResponse();
            $response->broadcastMessage = $bcMessage;

            Database::commitTransactiion();
            return $response;

        }catch(\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    protected function validateUpdateBc(BCUpdateRequest $request): void
    {
        if($request->messageId == null || $request->groupId == null || $request->waktu == null || $request->status == null ||
        trim($request->messageId) == "" || trim($request->groupId) == "" || trim($request->waktu) == "" || trim($request->status) == "")
        {
            throw new ValidationException("Id pesan, group, waktu dan status wajib diisi !");
        }
    }

    public function deleteBcMessage(string $id)
    {

        // $this->broadcastMessageRepository->delete($id);

        $this->validateDeleteBroadcastMessage($id);

        $bcMessage = $this->broadcastMessageRepository->findById($id);

        if($bcMessage === null){
            throw new ValidationException("Id tidak ditemukan !");
        }

        try{
            Database::beginTransaction();

            $this->broadcastMessageRepository->delete($id);

            Database::commitTransactiion();
        }catch(\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    protected function validateDeleteBroadcastMessage(string $id)
    {
        if($id == null || trim($id) == ''){
            throw new ValidationException("Id tidak boleh kosong !");
        }
    }

}
