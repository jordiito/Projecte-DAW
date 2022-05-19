<?php

class ProducteController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function show()
    {
        $producte = new ProducteView();
        $producte->show();
    }

    public function save($string)
    {
        $insertProductes = new ProducteModelo();
        $insertProductes->insert(getcwd() . "/cataleg.json");
    }
}

