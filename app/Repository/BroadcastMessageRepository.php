<?php

namespace IRFANEM\TELE_BLAST\Repository;

use IRFANEM\TELE_BLAST\Domain\BroadcastMessage;

class BroadcastMessageRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(BroadcastMessage $broadcastMessage): BroadcastMessage
    {
        $statement = $this->connection->prepare("INSERT INTO broadcast_messages (id, id_pesan, id_group, waktu, status) VALUES (?, ?, ?, ?, ?)");
        $statement->execute([
            $broadcastMessage->id, 
            $broadcastMessage->messageId, 
            $broadcastMessage->groupId, 
            $broadcastMessage->waktu, 
            $broadcastMessage->status
        ]);

        return $broadcastMessage;
    }

    public function update(BroadcastMessage $broadcastMessage): BroadcastMessage
    {
        $statement = $this->connection->prepare("UPDATE broadcast_messages SET id_pesan = ?, id_group = ?, waktu = ?, status = ? WHERE id = ?");
        $statement->execute([
            $broadcastMessage->messageId, 
            $broadcastMessage->groupId, 
            $broadcastMessage->waktu, 
            $broadcastMessage->status, 
            $broadcastMessage->id
        ]);

        return $broadcastMessage;
    }

    public function findById(string $id): ?BroadcastMessage
    {
        $statement = $this->connection->prepare("SELECT id, id_pesan, id_group, waktu, status FROM broadcast_messages WHERE id = ?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fetch()){
                $broadcastMessage = new BroadcastMessage();
                $broadcastMessage->id = $row['id'];
                $broadcastMessage->messageId = $row['id_pesan'];
                $broadcastMessage->groupId = $row['id_group'];
                $broadcastMessage->waktu = $row['waktu'];
                $broadcastMessage->status = $row['status'];

                return $broadcastMessage;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function delete(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM broadcast_messages WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll()
    {
        $this->connection->query("DELETE FROM broadcast_messages");
    }

    public function getAll(): array
    {
        $result = $this->connection->query("SELECT id, id_group, id_pesan, waktu, status FROM broadcast_messages");
        $broadcastMessages = [];

        if($result !== null) {
            while($row = $result->fetch()){
                $broadcastMessages[] = [
                    'id' => $row['id'],
                    'id_pesan' => $row['id_pesan'],
                    'id_group' => $row['id_group'],
                    'waktu' => $row['waktu'],
                    'status' => $row['status'],
                    'created_at' => $row['created_at']
                ];
            }
        }

        return $broadcastMessages;
    }

}
