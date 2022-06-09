<?php
//Controlador de productes
class ProducteController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }
    //Carrega la vista dels productes (pàgina de producte en concret)
    public function show()
    {
        $producte = new ProducteView();
        $producte->show();
    }
    //Serveix per a desar els productes emmagatzemats en "catàleg.json"
    public function save($string)
    {
        $insertProductes = new ProducteModelo();
        $insertProductes->insert(getcwd() . "/cataleg.json");
    }
}

