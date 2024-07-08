<?php

namespace App\Application\Controller\UserPosts;

use App\Application\Controller\BaseController;
use App\Application\Traits\FetchService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserPostsCreate extends BaseController
{
    use FetchService;
    public function __invoke(Request $request, Response $response): Response
    {
        $userPostsData = $this->getService('https://jsonplaceholder.typicode.com/posts');
        try {
            $stmt = $this->getContainer->get('db')->prepare("INSERT INTO user_posts (id, userId, title, body) VALUES (?, ?, ?, ?)");
            foreach ($userPostsData as $post) {
                $stmt->execute([$post['id'], $post['userId'], $post['title'], $post['body']]);
            }
            $response->getBody()->write('Success.');
        } catch (\PDOException $e) {
            $response->getBody()->write('Failed: ' . $e->getMessage());
        }
        return $response->withHeader('Content-Type', 'application/json');
    }



}