<?php

//Controller de la pàgina contacte, hereda les fucions de Controller
class ContacteController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    //Funció que carrega la vista de contacte
    public function show()
    {
        $contacte = new ContacteView();
        $contacte->show();
    }
}

