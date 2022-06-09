<?php
// Class Homecontroller, class fill de Controller
// per la pàgina inici
class HomeController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    //Inclou els arxius necessaris per mostrar la pàgina d'inici
    public function show()
    {
        include_once "config.php";

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        include "templates/tpl_body_main.php";

        include "templates/tpl_footer.php";
    }
}

