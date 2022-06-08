<?php

class ProducteModelo extends Model
{

    function __construct()
    {
        $this->queryLink = parent::getInstance()->queryLink;
        $this->actionLink = parent::getInstance()->actionLink;
    }

    public function insert($string)
    {
        $strJsonFileContents = file_get_contents("$string");
        // Convert to array
        $array = json_decode($strJsonFileContents, true);

        foreach ($array as $i => $j) {
            $producte = new Producte();
            $producte->setGtin($j["pid"]);
            $producte->setMarca($j["marca"]);
            $producte->setModel($j["model"]);
            $producte->setCategoria($j["tipus"]);
            $producte->setDescripcio($j["descripcio"]);
            $producte->setImatge($j["imatge"]);
            $producte->setPreu($j["preu"]);
            $producte->setPes($j["polzades"]);

            $this->save($producte);
        }
    }

    public function save(Producte $producte)
    {
        $sSql = "INSERT INTO producte (id, gtin, marca, model, categoria, descripcio, imatge, preu, pes)";
        $sSql .= "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?);";

        $sParam = array(
            "ssssssss",
            $producte->getGtin(),
            $producte->getMarca(),
            $producte->getModel(),
            $producte->getCategoria(),
            $producte->getDescripcio(),
            $producte->getImatge(),
            $producte->getPreu(),
            $producte->getPes()
        );

        $this->execute($sSql, $sParam, "action");
    }
}

