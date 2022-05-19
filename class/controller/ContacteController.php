<?php

class ContacteController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $contacte = new ContacteView();
        $contacte->show();
    }
}

