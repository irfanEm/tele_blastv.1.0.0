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

    public function sneat()
    {
        return View::render("Template/sneat", [
            "title" => "Sneat Template"
        ]);
    }

    public function test(int $id): void
    {
        echo "testing id = $id";
    }

}
