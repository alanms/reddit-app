<?php

require ('Post.php');

class PostController {

    private $db;

    private $post;

    public function __construct($db)
    {
        $this->db = $db;

        $this->post = new Post($db);
    }

    public function processRequest($type, $param) 
    {
        switch ($type) {
            case 'post':
                $response = $this->getPosts($param);
                break;
            case 'author':
                $response = $this->getAuthors($param);
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }

        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    public function getPosts($param)
    {
        $result = $this->post->findPosts($param);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    public function getAuthors($param)
    {
        $result = $this->post->findAuthors($param);
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

}
