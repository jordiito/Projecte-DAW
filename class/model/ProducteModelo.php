<?php
// Class Modelo de producte
class ProducteModelo extends Model
{
    // constructor, inicialitzar les conexions
    function __construct()
    {
        $this->queryLink = parent::getInstance()->queryLink;
        $this->actionLink = parent::getInstance()->actionLink;
    }
    // Insertar el producte a la base de dades
    public function insert($string)
    {
        $strJsonFileContents = file_get_contents("$string");
        // Convert to array
        $array = json_decode($strJsonFileContents, true);
        // crear el object producte
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
            // Guardar el objecte a la bd
            $this->save($producte);
        }
    }
    // Guardar el producte
    public function save(Producte $producte)
    {
// la sentencia mysql
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

