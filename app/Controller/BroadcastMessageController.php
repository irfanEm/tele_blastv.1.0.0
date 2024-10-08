<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Helper\Alert;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\BCAddRequest;
use IRFANEM\TELE_BLAST\Service\GroupService;
use IRFANEM\TELE_BLAST\Model\BCUpdateRequest;
use IRFANEM\TELE_BLAST\Service\MessageService;
use IRFANEM\TELE_BLAST\Repository\GroupRepository;
use IRFANEM\TELE_BLAST\Repository\MessageRepository;
use IRFANEM\TELE_BLAST\Service\BroadcastMessageService;
use IRFANEM\TELE_BLAST\Repository\BroadcastMessageRepository;

class BroadcastMessageController
{
    private GroupService $groupService;
    private MessageService $messageService;
    private BroadcastMessageService $broadcastMessageService;

    public function __construct()
    {
        $groupRepo = new GroupRepository(Database::getConnection());
        $messageRepo = new MessageRepository(Database::getConnection());
        $broadcastMessageRepository = new BroadcastMessageRepository(Database::getConnection());
        $this->groupService = new GroupService($groupRepo);
        $this->messageService = new MessageService($messageRepo);
        $this->broadcastMessageService = new BroadcastMessageService($broadcastMessageRepository);
    }

    public function index()
    {
        $broadcastMessages = $this->broadcastMessageService->getAllBc();
        $alert = Alert::getFlash('alert'); // Ambil pesan dari session
        View::render('BroadcastMessage/index', [
            'title' => 'Pesan Siaran',
            'broadcastMessages' => $broadcastMessages,
            'alert' => $alert // Kirim pesan ke view
        ]);
    }

    public function tambahBcMessage()
    {
        $groups = $this->groupService->getGroups();
        $messages = $this->messageService->getAllMessages();
        View::render('BroadcastMessage/tambah', [
            'title' => 'Tambah Pesan Siaran',
            'groups' => $groups,
            'messages' => $messages
        ]);
    }

    public function postTambahBcMessage()
    {
        // echo json_encode($_POST, JSON_PRETTY_PRINT);
        $request = new BCAddRequest();
        $request->id = uniqid();
        $request->messageId = $_POST['pesan_id'];
        $request->groupId = json_encode($_POST['groups']);
        $request->days = json_encode($_POST['days']);
        $request->waktu = $_POST['waktu'];
        $request->status = $_POST['status'] ?? "off";

        try{
            $this->broadcastMessageService->simpanBc($request);
            Alert::setFlash("alert", ["success" => "Pesan siaran berhasil ditambahkan."]); // Set pesan ke session
            View::redirect('/pesan-siaran');
        }catch(\Exception $e){
            $groups = $this->groupService->getGroups();
            $messages = $this->messageService->getAllMessages();
            View::render('BroadcastMessage/tambah', [
                'title' => 'Data Broadcast Message',
                'error' => $e->getMessage(),
                'groups' => $groups,
                'messages' => $messages
            ]);
        }
    }

    public function updateBcMessage($ps_id)
    {
        $id = $ps_id;
        $bcMessage = $this->broadcastMessageService->getCurrent($id);
        print_r(json_encode($bcMessage->groupId));
        // View::render('BroadcastMessage/edit', [
        //     'title' => 'Edit pesan siaran',
        //     'broadcastMessage' => $bcMessage
        // ]);
    }

    public function postUpdateBcMessage()
    {
        $request = new BCUpdateRequest();
        $request->id = $_POST['id'];
        $request->messageId = $_POST['message_id'];
        $request->groupId = $_POST['group_id'];
        $request->waktu = $_POST['waktu'];
        $request->status = $_POST['status'];

        try{
            $this->broadcastMessageService->updateBc($request);
            Alert::setFlash("alert", ["success" => "Pesan siaran berhasil diperbarui."]); // Set pesan ke session
            View::redirect('/broadcast-message');
        }catch(\Exception $e){
            View::render('BroadcastMessage/update', [
                'title' => 'Update Broadcast Message',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function deleteBroadcastMessage()
    {
        $id = $_GET['id'];
        try{
            $this->broadcastMessageService->deleteBcMessage($id);
            Alert::setFlash("alert", ["success" => "Pesan siaran berhasil dihapus."]); // Set pesan ke session
            View::redirect("/broadcast-pesan");
        }catch(\Exception $e){
            View::render('BroadcastMessage/index', [
                'title' => 'Data Broadcast Message',
                'error' => $e->getMessage()
            ]);
        }
    }

}
