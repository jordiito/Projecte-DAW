<?php

class ErrorController
{

    private $thrownException;

    public function __construct($thrownEx)
    {
        $this->thrownException = $thrownEx;
    }

    public function show()
    {
        include_once "config.php";

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        $titol = "S'ha produit un error";
        $missatge = $this->thrownException->getMessage();
        include "templates/tpl_error.php";

        include "templates/tpl_footer.php";
    }
}

