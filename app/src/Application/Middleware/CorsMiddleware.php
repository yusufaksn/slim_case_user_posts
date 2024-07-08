<?php
use Slim\App;
use Slim\Routing\RouteContext;
use Slim\Cors\CorsMiddleware;

require __DIR__ . '/vendor/autoload.php';

// Create Slim App
$app = AppFactory::create();

// Add CORS middleware
$app->add(new CorsMiddleware([
    "origin" => ["*"],
    "methods" => ["GET", "POST", "PUT", "PATCH", "DELETE"],
    "headers.allow" => [],
    "headers.expose" => [],
    "credentials" => false,
    "cache" => 0,
]));

// Define routes and handle API requests

$app->run();
