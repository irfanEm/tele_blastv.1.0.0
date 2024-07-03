<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Model\MessageAddRequest;
use IRFANEM\TELE_BLAST\Model\MessageUpdateRequest;
use IRFANEM\TELE_BLAST\Repository\MessageRepository;
use IRFANEM\TELE_BLAST\Service\MessageService;

class MessageController
{
    private MessageService $messageService;

    public function __construct()
    {
        $messageRepository = new MessageRepository(Database::getConnection());
        $this->messageService = new MessageService($messageRepository);
    }

    public function index()
    {
        $messages = $this->messageService->getAllMessages();
        View::render('Pesan/index', [
            'title' => 'Data Pesan',
            'messages' => $messages
        ]);
    }

    public function addMessage()
    {
        View::render('Message/tambah', [
            'title' => 'Tambah pesan'
        ]);
    }

    public function postAddMessage()
    {
        $request = new MessageAddRequest();
        $request->id = uniqid();
        $request->judul = $_POST['judul'];
        $request->pesan = $_POST['pesan'];

        try{
            $this->messageService->addMessage($request);
            View::redirect('/messages');
        }catch(ValidationException $er){
            View::render('Message/tambah', [
                'title' => 'Tambah pesan',
                'error' => $er->getMessage()
            ]);
        }
    }

    public function updateMessage()
    {
        $id = $_GET['id'];
        $message = $this->messageService->currentMessage($id);
        View::render('Message/update',[
            'title' => 'Update pesan',
            'message' => $message
        ]);
    }

    public function postUpdateMessage()
    {
        $request = new MessageUpdateRequest();
        $request->id = $_POST['id'];
        $request->judul = $_POST['judul'];
        $request->pesan = $_POST['pesan'];

        try{

            $this->messageService->updateMessage($request);
            View::redirect("/messages");

        }catch(ValidationException $e){

            $message = $this->messageService->currentMessage($request->id);
            View::render('Message/update', [
                'title' => 'Update pesan',
                'message' => $message,
                'error' => $e->getMessage()
            ]);

        }
    }

    public function hapusPesan()
    {
        $id = $_GET['id'];
        
        try{
            $this->messageService->deleteMessage($id);
            View::redirect('/messages');
        }catch(ValidationException $e){
            View::render('Message/index', [
                'title' => 'Data pesan',
                'error' => $e->getMessage()
            ]);
        }
    }

}
