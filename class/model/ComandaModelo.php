<?php
//Model de comanda, hereda les funcions de Model.
//Es defineixen les queries necessàries per cada funció que es crida des de controller.
class ComandaModelo extends Model
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
            $comanda = new Comanda();
            $comanda->setUserId($j["user_id"]);
            $comanda->setPagamentId($j["pagament_id"]);

            $this->save($comanda);
        }
    }

    //Query per guardar la comanda a base de dades
    public function save(Comanda $comanda)
    {
        $sSql = "INSERT INTO comanda (id, user_id, pagament_id, data)";
        $sSql .= "VALUES (NULL, ?, ?, NULL);";

        $sParam = array(
            "ss",
            $comanda->getUserId(),
            $comanda->getPagamentId(),
        );

        $this->execute($sSql, $sParam, "action");
    }
}

