<?php

namespace App\Application\Controller\UserPosts;

use App\Application\Controller\BaseController;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserPostsList extends BaseController
{
    public function __invoke(Request $request, Response $response): Response
    {
        $response->getBody()->write(json_encode($this->fetchUserPostsList()));
        return $response->withHeader('Content-Type', 'application/json');
    }

    private function fetchUserPostsList()
    {
        try {
            $pdo = $this->getContainer->get('db');
            $stmt = $pdo->query('SELECT up.id as id, u.username as username, up.title as title, up.body as body 
                                 FROM user_posts as up JOIN users as u 
                                 on u.id = up.userId
                                 where isnull(up.deleted_at)   
                                 ');
            return $stmt->fetchAll();
        } catch (\PDOException $e) {
            $this->logger->error('DB Connection Failed: ' . $e->getMessage());
            return 'DB Connection Failed: ' . $e->getMessage();
        }
    }

}