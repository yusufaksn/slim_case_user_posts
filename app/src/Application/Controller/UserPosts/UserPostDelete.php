<?php

namespace App\Application\Controller\UserPosts;

use App\Application\Controller\BaseController;
use PDO;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserPostDelete extends BaseController
{
    public function __invoke(
        Request  $request,
        Response $response,
        array    $args
    ): Response
    {
        $postId = $args['id'];
        if (isset($postId) && is_numeric($postId) && $postId > 0) {
            $response->getBody()->write(json_encode($this->fetchUserPostsDelete($postId, date('Y-m-d H:i:s'))));
        } else {
            $response->getBody()->write(json_encode("Failed"));
        }
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Accept, Origin, Content-Type, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    }

    private function fetchUserPostsDelete($postId, $nowDate): string|bool
    {
        try {
            $stmt = $this->getContainer->get('db')->prepare("UPDATE user_posts 
                           SET deleted_at = :nowDate 
                           WHERE deleted_at IS NULL AND id = :postId");
            $stmt->bindParam(':nowDate', $nowDate, PDO::PARAM_STR);
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();
            return True;
        } catch (\PDOException $e) {

            return 'DB Connection Failed: ' . $e->getMessage();
        }
    }

}