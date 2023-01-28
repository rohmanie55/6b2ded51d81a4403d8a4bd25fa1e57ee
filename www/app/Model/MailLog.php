<?php

namespace Simple\Mail\App\Model;

use Simple\Mail\App\Core\Model;

class MailLog extends Model
{
    protected $table = 'mail_logs';

    public function paginate($perpage=10){
        $page = (@$_GET['page']>1) ? (@$_GET['page'] * $perpage) - $perpage : 0;
        $statement = $this->db->prepare("select * from $this->table limit $perpage offset $page");
        $statement->execute();

        return $statement->fetchAll(\PDO::FETCH_OBJ);
    }

    public function findID($id){
        $statement = $this->db->prepare("select id, subject, send_to, body, created_at from $this->table where id=?");
        $statement->execute([$id]);

        return $statement->fetch(\PDO::FETCH_OBJ);
    }


    public function insert($data){
        $statement = $this->db->prepare("INSERT INTO $this->table(subject, send_to, body, status) VALUES (:subject, :send_to, :body, :status)");

        return $statement->execute($data);
    }

    public function update($data, $id){
        $statement = $this->db->prepare("UPDATE $this->table SET subject=:subject, send_to=:send_to, body=:body where id=:id");
        $data['id'] = $id;
        return $statement->execute($data);
    }

    public function delete($id){
        $statement = $this->db->prepare("DELETE from $this->table where id=:id");
        return $statement->execute(['id'=>$id]);
    }
}