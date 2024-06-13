<?php

namespace IRFANEM\TELE_BLAST\Repository;

use IRFANEM\TELE_BLAST\Domain\Group;

class GroupRepository
{
    private \PDO $connection;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(Group $group): Group
    {
        $statement = $this->connection->prepare("INSERT INTO `groups` (id, nama, username) VALUES (?, ?, ?)");
        $statement->execute([
            $group->id,
            $group->nama,
            $group->username
        ]);

        return $group;
    }

    public function getAll(): array
    {
        $groups = [];
        $result = $this->connection->query("SELECT id, nama, username, created_at, updated_at FROM groups");
        if($result != null){
            while($row = $result->fetch(\PDO::FETCH_ASSOC)){
                $groups[] = [
                    "id" => $row['id'],
                    "nama" => $row['nama'],
                    "username" => $row['username'],
                    "created_at" => $row['created_at'],
                    "updated_at" => $row['updated_at'],
                ];
            }
        }
        return $groups;
    }

    public function findById(string $id): ?Group
    {
        $statement = $this->connection->prepare("SELECT id, nama, username FROM groups WHERE id = ?");
        $statement->execute([$id]);

        try{
            if($row = $statement->fetch()){
                $group = new Group();
                $group->id = $row['id'];
                $group->nama = $row['nama'];
                $group->username = $row['username'];

                return $group;
            }else{
                return null;
            }
        }finally{
            $statement->closeCursor();
        }
    }

    public function update(Group $group): Group
    {
        $statement = $this->connection->prepare("UPDATE groups set nama = ?, username = ? WHERE id = ?");
        $statement->execute([
            $group->nama,
            $group->username,
            $group->id
        ]);

        return $group;
    }

    public function deleteById(string $id)
    {
        $statement = $this->connection->prepare("DELETE FROM groups WHERE id = ?");
        $statement->execute([$id]);
    }

    public function deleteAll()
    {
        $this->connection->query("DELETE FROM groups");
    }
}
