<?php

namespace IRFANEM\TELE_BLAST\Service;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Domain\Message;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\MessageAddRequest;
use IRFANEM\TELE_BLAST\Model\MessageAddResponse;
use IRFANEM\TELE_BLAST\Model\MessageUpdateRequest;
use IRFANEM\TELE_BLAST\Model\MessageUpdateResponse;
use IRFANEM\TELE_BLAST\Repository\MessageRepository;
use IRFANEM\TELE_BLAST\Exception\ValidationException;

class MessageService
{
    private MessageRepository $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    public function addMessage(MessageAddRequest $request): MessageAddResponse
    {
        $this->validateAddMessage($request);

        try{
            Database::beginTransaction();

            $message = $this->messageRepository->findById($request->id);
            if($message !== null) {
                throw new ValidationException('Id pesan sudah ada !');
            }

            $message = new Message();
            $message->id = uniqid();
            $message->judul = $request->judul;
            $message->pesan = $request->pesan;

            $this->messageRepository->save($message);

            $response = new MessageAddResponse();
            $response->message = $message;

            Database::commitTransactiion();
            return $response;
            
        }catch(\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    protected function validateAddMessage(MessageAddRequest $request)
    {
        if($request->id == null || $request->judul == null || $request->pesan == null ||
        trim($request->id == "") || trim($request->judul == "") || trim($request->pesan == ""))
        {
            throw new ValidationException("Id, judul dan pesan tidak boleh kosong !");
        }
    }

    public function updateMessage(MessageUpdateRequest $request): MessageUpdateResponse
    {
        $this->validateUpdateMessage($request);

        try{
            Database::beginTransaction();

            $message = $this->messageRepository->findById($request->id);
            if($message == null) {
                throw new ValidationException("Id pesan tidak ditemukan !");
            }

            $message->judul = $request->judul;
            $message->pesan = $request->pesan;

            $this->messageRepository->update($message);

            Database::commitTransactiion();

            $response = new MessageUpdateResponse();
            $response->message = $message;
            return $response;
        }catch(\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    protected function validateUpdateMessage(MessageUpdateRequest $request)
    {
        if($request->id == null || $request->judul == null || $request->pesan == null ||
        trim($request->id == "") || trim($request->judul == "") || trim($request->pesan == ""))
        {
            return new ValidationException("Judul dan pesan tidak boleh kosong !");
        }
    }

    public function deleteMessage(string $id): void
    {
        $this->validateDeleteMessage($id);

        $message = $this->messageRepository->findById($id);

        if($message === null){
            throw new ValidationException("Id pesan tidak ditemukan !");
        }

        try{
            Database::beginTransaction();

            $this->messageRepository->delete($id);

            Database::commitTransactiion();
        }catch(\Exception $e){
            Database::rollbackTransaction();
            throw $e;
        }
    }

    protected function validateDeleteMessage(string $id)
    {
        if($id == null || trim($id == ""))
        {
            return new ValidationException("Id pesan tidak boleh kosong !");
        }
    }

}
