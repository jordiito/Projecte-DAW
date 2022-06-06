<?php

class DetallsComandaModelo extends Model
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
            $detallsComanda = new DetallsComanda();
            $detallsComanda->setProducteId($j["user_id"]);
            $detallsComanda->setQuantitat($j["user_id"]);
            $detallsComanda->setPreu($j["pagament_id"]);
            $detallsComanda->setSubtotal($j["user_id"]);

            $this->save($detallsComanda);
        }
    }

    public function save(DetallsComanda $detallsComanda)
    {
        $sSql = "INSERT INTO comanda (id, producte_id, comanda_id, quantitat, preu, subTotal)";
        $sSql .= "VALUES (NULL, ?, ?, ?, ?, ?);";

        $sParam = array(
            "sssss",
            $detallsComanda->getProducteId(),
            $detallsComanda->getQuantitat(),
            $detallsComanda->getPreu(),
            $detallsComanda->getSubtotal(),
        );

        $this->execute($sSql, $sParam, "action");
    }
}

