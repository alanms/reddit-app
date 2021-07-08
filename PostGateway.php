<?php

class PostGateway {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findAll()
    {
        $statement = "
            SELECT 
                id, title, author_fullname, ups, num_comments, created
            FROM
                post;
        ";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function find($id)
    {
        $statement = "
            SELECT 
                id, title, author_fullname, ups, num_comments, created
            FROM
                post
            WHERE id = ?;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($id));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }

    public function insert(Array $input)
    {
        $statement = "
            INSERT INTO post 
                (title, author_fullname, ups, num_comments, created)
            VALUES
                (:title, :author_fullname, :ups, :num_comments, :created);
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'title' => $input['title'],
                'author_fullname'  => $input['author_fullname'],
                'ups' => $input['ups'],
                'num_comments' => $input['num_comments'],
                'created' => $input['created']
            ));
            return $statement->rowCount();
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }    
    }
}