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
            $producte->setNom($j["marca"] . " - " . $j["tipus"]);
            $producte->setDescripcio($j["valoracio"]);
            $producte->setImatge($j["imatge"]);
            $producte->setPreu($j["preu"]);
            $producte->setPes($j["polzades"]);

            $this->save($producte);
        }
    }

    public function save(Producte $producte)
    {
        $sSql = "INSERT INTO producte (id, gtin, nom, descripcio, imatge, preu, pes)";
        $sSql .= "VALUES (NULL, ?, ?, ?, ?, ?, ?);";

        $sParam = array(
            "ssssss",
            $producte->getGtin(),
            $producte->getNom(),
            $producte->getDescripcio(),
            $producte->getImatge(),
            $producte->getPreu(),
            $producte->getPes()
        );

        $this->execute($sSql, $sParam, "action");
    }
}

