<?php

namespace IRFANEM\TELE_BLAST\Controller;

use IRFANEM\TELE_BLAST\App\View;

class TemplateController
{
    public function index()
    {
        return View::render("Template/index",[
            "title" => "Template"
        ]);
    }

    public function index_ku()
    {
        return View::render("Template/templat-ku",[
            "title" => "Templat-Ku"
        ]);
    }

    public function sneat()
    {
        return View::render("Template/sneat", [
            "title" => "Sneat Template"
        ]);
    }

    public function test(string $id): void
    {
        echo "testing id = $id";
    }

}
