<?php

use IRFANEM\TELE_BLAST\App\Router;
use IRFANEM\TELE_BLAST\Controller\HomeController;
use IRFANEM\TELE_BLAST\Controller\UserController;
use IRFANEM\TELE_BLAST\Controller\TemplateController;

require_once __DIR__ . "/../vendor/autoload.php";

Router::add("GET", "/", HomeController::class, "index", []);
Router::add("GET", "/template", TemplateController::class, "index", []);
Router::add("GET", "/template-sneat", TemplateController::class, "sneat", []);

Router::add("GET", "/user/daftar", UserController::class, "daftar", []);
Router::add("POST", "/user/daftar", UserController::class, "posDaftar", []);
Router::add("GET", "/user/login", UserController::class, "login", []);
Router::add("POST", "/user/login", UserController::class, "postLogin", []);

Router::run();