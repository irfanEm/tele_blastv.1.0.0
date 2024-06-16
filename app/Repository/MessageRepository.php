<?php

namespace IRFANEM\TELE_BLAST\Repository;

use PDO;
use IRFANEM\TELE_BLAST\Domain\Message;

class MessageRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Message $message): Message
    {
        $statement = $this->connection->prepare("INSERT INTO messages (id, judul , pesan) VALUES (?, ?, ?)");
        $statement->execute([$message->id, $message->judul, $message->pesan]);

        return $message;
    }

    public function findById(string $id): Message
    {
        $statement = $this->connection->prepare("SELECT id, judul, pesan FROM messages WHERE id = ?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fetch()) {
                $message = new Message();
                $message->id = $row['id'];
                $message->judul = $row['judul'];
                $message->pesan = $row['pesan'];

                return $message;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function update(Message $message): Message
    {
        $statement = $this->connection->prepare("UPDATE messages set judul = ?, pesan = ?, updated_at = CURRENT_TIME WHERE id = ?");
        $statement->execute([$message->judul, $message->pesan, $message->id]);

        return $message;
    }

    public function delete(Message $message): void
    {
        $statement = $this->connection->prepare("DELETE FROM messages WHERE id = ?");
        $statement->execute([$message->id]);
    }

    public function getAll(): array
    {
        $statement = $this->connection->query("SELECT id, judul, pesan, created_at, updated_at");
        $messages = [];
        if($statement !== null){
            while ($row = $statement->fetch()) {
                $messages[] = [
                    'id' => $row['id'],
                    'judul' => $row['judul'],
                    'pesan' => $row['pesan'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at'],
                ];
            }
        }

        return $messages;
    }

    public function deleteAll()
    {
        $this->connection->query("DELETE FROM messages");
    }

}
