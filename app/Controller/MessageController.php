<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Exception\ValidationException;
use IRFANEM\TELE_BLAST\Helper\Alert;
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
            'title' => 'Pesan',
            'messages' => $messages
        ]);
    }

    public function addMessage()
    {
        View::render('Pesan/tambah', [
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
            echo "<script>alert('Berhasil menambah pesan.');</script>";
            View::redirect('/pesan');
        }catch(ValidationException $er){
            View::render('Pesan/tambah', [
                'title' => 'Tambah pesan',
                'error' => $er->getMessage()
            ]);
        }
    }

    public function updateMessage(string $id)
    {
        $msgId = htmlspecialchars($id);
        $message = $this->messageService->currentMessage($msgId);
        View::render('Pesan/edit',[
            'title' => 'Update pesan',
            'id' => $message->id,
            'judul' => $message->judul,
            'pesan' => $message->pesan
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
            Alert::setFlash("alert", ["success"=>"Data berhasil diedit."]);
            View::redirect("/pesan");

        }catch(ValidationException $e){
            $error = $e->getMessage();
            Alert::setFlash("alert", ["danger"=>"Data gagal diedit : $error"]);
            View::redirect("pesan/update/$request->id");

        }
    }

    public function hapusPesan(string $id)
    {
        $idMsg = htmlspecialchars($id);
        
        try{
            $this->messageService->deleteMessage($idMsg);
            View::redirect('/pesan');
        }catch(ValidationException $e){
            View::render('Pesan/index', [
                'title' => 'Data pesan',
                'error' => $e->getMessage()
            ]);
        }
    }

}
