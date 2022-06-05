<?php

class ProducteController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $producte = new Carreto();
        $producte->show();
    }

    public function add($string)
    {
        isset($_SESSION[''])
    }
}


