<?php

declare(strict_types=1);

use Slim\App;
use App\Application\Controller\Users;
use App\Application\Controller\UserPosts;

return function (App $app) {
    $app->get('/api/bulk-user-insert', Users\UsersCreate::class);
    $app->get('/api/bulk-post-insert', UserPosts\UserPostsCreate::class);
    $app->get('/api/user-post', UserPosts\UserPostsList::class);
    $app->delete('/api/user-post/{id}', UserPosts\UserPostDelete::class);
};
