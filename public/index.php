<?php
session_start();

use IRFANEM\TELE_BLAST\App\Router;
use IRFANEM\TELE_BLAST\Controller\HomeController;
use IRFANEM\TELE_BLAST\Controller\UserController;
use IRFANEM\TELE_BLAST\Controller\GroupController;
use IRFANEM\TELE_BLAST\Controller\MessageController;
use IRFANEM\TELE_BLAST\Controller\TemplateController;
use IRFANEM\TELE_BLAST\Middleware\MustLoginMiddleware;
use IRFANEM\TELE_BLAST\Middleware\MustNotLoginMiddleware;
use IRFANEM\TELE_BLAST\Controller\BroadcastMessageController;

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

Router::add("GET", "/group", GroupController::class, "index", [MustLoginMiddleware::class]);
Router::add("GET", "/group/add", GroupController::class, "tambah", [MustLoginMiddleware::class]);
Router::add("POST", "/group", GroupController::class, "postTambah", [MustLoginMiddleware::class]);
Router::add("GET", "/group/edit/([0-9a-zA-Z\-\_]*)", GroupController::class, "update", [MustLoginMiddleware::class]);
Router::add("POST", "/group/edit", GroupController::class, "postUpdate", [MustLoginMiddleware::class]);
Router::add("GET", "/group/hapus/([0-9a-zA-Z\-\_]*)", GroupController::class, "hapus", [MustLoginMiddleware::class]);

Router::add("GET", "/pesan", MessageController::class, "index", [MustLoginMiddleware::class]);
Router::add("GET", "/pesan/add", MessageController::class, "addMessage", [MustLoginMiddleware::class]);
Router::add("POST", "/pesan/add", MessageController::class, "postAddMessage", [MustLoginMiddleware::class]);
Router::add("GET", "/pesan/edit/([0-9a-zA-Z]*)", MessageController::class, "updateMessage", [MustLoginMiddleware::class]);
Router::add("POST", "/pesan/edit", MessageController::class, "postUpdateMessage", [MustLoginMiddleware::class]);
Router::add("GET", "/pesan/hapus/([0-9a-zA-Z]*)", MessageController::class, "hapusPesan", [MustLoginMiddleware::class]);

Router::add("GET", "/pesan-siaran", BroadcastMessageController::class, "index", [MustLoginMiddleware::class]);
Router::add("GET", "/pesan-siaran/tambah", BroadcastMessageController::class, "tambahBcMessage", [MustLoginMiddleware::class]);
Router::add("POST", "/pesan-siaran", BroadcastMessageController::class, "postTambahBcMessage", [MustLoginMiddleware::class]);

Router::add("GET", "/test/id/([0-9a-zA-Z]*)", TemplateController::class, "test", []);

Router::run();