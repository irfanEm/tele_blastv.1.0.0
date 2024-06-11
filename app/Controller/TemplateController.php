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

}
