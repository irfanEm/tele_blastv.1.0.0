<?php

namespace IRFANEM\TELE_BLAST\Repository;

use IRFANEM\TELE_BLAST\Domain\User;

class Repository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(User $user): User
    {
        $statement = $this->connection->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $statement->execute([
            $user->email,
            $user->password
        ]);

        return $user;
    }

    public function getAll(): array
    {
        $results = [];
        $users = $this->connection->query("SELECT * FROM users");
        if($users != null){
            while($row = $users->fetch()) {
                $results [] = [
                    "id" => $row['id'],
                    "email" => $row['email'],
                    "password" => $row['password'],
                    "level" => $row['level'],
                    "created_at" => $row['created_at'],
                    "updated_at" => $row['updated_at']
                ];
            }
        }

        return $results;
    }
    
    public function update(User $user): User
    {
        $statement = $this->connection->prepare("UPDATE users set email = ?, password = ?, level = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $statement -> execute([
            $user->email,
            $user->password,
            $user->level,
            $user->id
        ]);
        return $user;
    }

    public function findById(int $id): ?User
    {
        $statement = $this->connection->prepare("SELECT id, email, password, level, created_at, updated_at FROM users WHERE id = ?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->level = $row['level'];

                return $user;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function findByEmail(string $email): ?User
    {
        $statement = $this->connection->prepare("SELECT id, email, password, level, created_at, updated_at FROM users WHERE email = ?");
        $statement->execute([$email]);

        try{
            if($row = $statement->fetch()) {
                $user = new User();
                $user->id = $row['id'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->level = $row['level'];

                return $user;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function deleteById(int $id): void
    {
        $statement = $this->connection->prepare("DELETE * FROM users WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll(): void
    {
        $this->connection->exec("DELETE FROM users");
    }
}
