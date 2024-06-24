<?php

use IRFANEM\TELE_BLAST\App\Router;
use IRFANEM\TELE_BLAST\Controller\HomeController;
use IRFANEM\TELE_BLAST\Controller\UserController;
use IRFANEM\TELE_BLAST\Controller\TemplateController;
use IRFANEM\TELE_BLAST\Middleware\MustLoginMiddleware;
use IRFANEM\TELE_BLAST\Middleware\MustNotLoginMiddleware;

require_once __DIR__ . "/../vendor/autoload.php";

Router::add("GET", "/", HomeController::class, "index", []);
Router::add("GET", "/template", TemplateController::class, "index", []);
Router::add("GET", "/template-ku", TemplateController::class, "index_ku", []);
Router::add("GET", "/template-sneat", TemplateController::class, "sneat", []);

Router::add("GET", "/user/daftar", UserController::class, "daftar", [MustNotLoginMiddleware::class]);
Router::add("POST", "/user/daftar", UserController::class, "posDaftar", [MustNotLoginMiddleware::class]);
Router::add("GET", "/user/login", UserController::class, "login", [MustNotLoginMiddleware::class]);
Router::add("POST", "/user/login", UserController::class, "postLogin", [MustNotLoginMiddleware::class]);
Router::add("GET", "/logout", UserController::class, "logout", [MustLoginMiddleware::class]);

Router::add("GET", "/test/id/([0-9a-zA-Z]*)", TemplateController::class, "test", []);

Router::run();