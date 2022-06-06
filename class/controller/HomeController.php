<?php

class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        include_once "config.php";

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        include "templates/tpl_body_main.php";

        include "templates/tpl_footer.php";
    }
}

