<?php

class Post {

    private $db = null;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function findPosts($param)
    {
        $statement = "
            SELECT 
                id, title, author_fullname, ups, num_comments, created
            FROM
                post
            WHERE
                created BETWEEN :initial_date AND :final_date
            ORDER BY " . $param['order'] . " DESC;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->bindValue(':initial_date', $param['initial_date'], PDO::PARAM_INT);
            $statement->bindValue(':final_date', $param['final_date'], PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function findAuthors($param)
    {
        $statement = "
            SELECT
                author_fullname, ups, num_comments
            FROM
                post
            ORDER BY " . $param['order'] . " DESC;
        ";

        try {
            $statement = $this->db->prepare($statement);
            $statement->execute();
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