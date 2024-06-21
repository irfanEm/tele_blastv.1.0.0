<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\BCAddRequest;
use IRFANEM\TELE_BLAST\Repository\BroadcastMessageRepository;
use IRFANEM\TELE_BLAST\Service\BroadcastMessageService;

class BroadcastMessageController
{
    private BroadcastMessageService $broadcastMessageService;

    public function __construct()
    {
        $broadcastMessageRepository = new BroadcastMessageRepository(Database::getConnection());
        $this->broadcastMessageService = new BroadcastMessageService($broadcastMessageRepository);
    }

    public function index()
    {
        $broadcastMessages = $this->broadcastMessageService->getAllBc();

        View::render('BroadcastMessage/index', [
            'title' => 'Data Broadcast Message',
            'broadcastMessages' => $broadcastMessages
        ]);
    }

    public function tambahBcMessage()
    {
        View::render('BroadcastMessage/tambah', [
            'title' => 'Tambah Broadcast Message'
        ]);
    }

    public function postTambahBcMessage()
    {
        $request = new BCAddRequest();
        $request->id = uniqid();
        $request->messageId = $_POST['message_id'];
        $request->groupId = $_POST['group_id'];
        $request->waktu = $_POST['waktu'];
        $request->status = $_POST['status'];
    }

}
