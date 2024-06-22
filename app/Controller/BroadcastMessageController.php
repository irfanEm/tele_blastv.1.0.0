<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;
use IRFANEM\TELE_BLAST\Config\Database;
use IRFANEM\TELE_BLAST\Model\BCAddRequest;
use IRFANEM\TELE_BLAST\Model\BCUpdateRequest;
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

        try{
            $this->broadcastMessageService->simpanBc($request);
            View::redirect('/broadcast-messages');
        }catch(\Exception $e){
            View::render('BroadcastMessage/tambah', [
                'title' => 'Data Broadcast Message',
                'error' => $e->getMessage()
            ]);
        }
    }

    public function updateBcMessage()
    {
        $id = $_GET['id'];
        $bcMessage = $this->broadcastMessageService->getCurrent($id);

        View::render('BroadcastMessage/index', [
            'title' => 'Tambah Broadcast Message',
            'broadcastMessage' => $bcMessage
        ]);
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
        }catch(\Exception $e){
            View::render('BroadcastMessage/index', [
                'title' => 'Data Broadcast Message',
                'error' => $e->getMessage()
            ]);
        }
    }

}
