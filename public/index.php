<?php

use IRFANEM\TELE_BLAST\App\Router;
use IRFANEM\TELE_BLAST\Controller\TemplateController;

require_once __DIR__ . "/../vendor/autoload.php";

Router::add("GET", "/template", TemplateController::class, "index", []);

Router::run();