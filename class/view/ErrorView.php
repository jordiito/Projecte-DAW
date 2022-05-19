<?php

class ErrorView extends View
{

    private $_exception;

    public function __construct($param = null)
    {
        parent::__construct();
        $this->_exception = $param;
    }

    public function show()
    {
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        $titol = "Procès finalitzat amb errors";
        $missatge = "Avisa a l'administrador: <br> {$this->_exception->getMessage()}";
        include "templates/tpl_error.php";

        include "templates/tpl_footer.php";
    }

    public function showMessage($titol, $missatge)
    {
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        include "templates/tpl_error.php";
        include "templates/tpl_footer.php";
    }

    public function showOk($titol, $missatge)
    {
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        include "templates/tpl_ok.php";

        include "templates/tpl_footer.php";
    }
}