<?php

namespace IRFANEM\TELE_BLAST\Repository;

use IRFANEM\TELE_BLAST\Domain\Session;

class SessionRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Session $session): Session
    {
        $statement = $this->connection->prepare("INSERT INTO sessions (id, user_email) VALUES (?, ?)");
        $statement->execute([$session->id, $session->email]);

        return $session;
    }

    public function update(Session $session): Session
    {
        $statement = $this->connection->prepare("UPDATE sessions set user_email = ? WHERE id = ?");
        $statement->execute([$session->email, $session->id]);

        return $session;
    }

    public function findById(string $id): ?Session
    {
        $statement = $this->connection->prepare("SELECT id, user_email FROM sessions WHERE id = ?");
        $statement->execute([$id]);
        
        try{
            if($row = $statement->fetch()) {
                $session = new Session();
                $session->id = $row['id'];
                $session->email = $row['user_email'];
                return $session;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function deleteById(string $id): void
    {
        $statement = $this->connection->prepare("DELETE FROM sessions WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM sessions");
    }

}
