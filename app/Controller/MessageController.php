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
        $alert = Alert::getFlash('alert'); // Ambil pesan dari session
        View::render('Pesan/index', [
            'title' => 'Pesan',
            'messages' => $messages,
            'alert' => $alert // Kirim pesan ke view
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

        try {
            $this->messageService->addMessage($request);
            Alert::setFlash("alert", ["success" => "Pesan berhasil ditambahkan."]); // Set pesan ke session
            View::redirect('/pesan');
        } catch (ValidationException $er) {
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

        try {
            $this->messageService->updateMessage($request);
            Alert::setFlash("alert", ["success" => "Pesan berhasil diperbarui."]); // Set pesan ke session
            View::redirect("/pesan");
        } catch (ValidationException $e) {
            $error = $e->getMessage();
            Alert::setFlash("alert", ["danger" => "Data gagal diperbarui: $error"]); // Set pesan gagal ke session
            View::redirect("pesan/edit/$request->id");
        }
    }

    public function hapusPesan(string $id)
    {
        $idMsg = htmlspecialchars($id);
        
        try{
            $this->messageService->deleteMessage($idMsg);
            Alert::setFlash("alert", ["success" => "Pesan berhasil dihapus."]); // Set pesan ke session
            View::redirect('/pesan');
        }catch(ValidationException $e){
            View::render('Pesan/index', [
                'title' => 'Data pesan',
                'error' => $e->getMessage()
            ]);
        }
    }

}
