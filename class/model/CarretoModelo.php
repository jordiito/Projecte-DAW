<?php

class CarretoModelo extends Model
{

    function __construct()
    {
        $this->queryLink = parent::getInstance()->queryLink;
        $this->actionLink = parent::getInstance()->actionLink;
    }
    

    
    public function save( $idUser, $idProducte)
    {
        $sSql = "INSERT INTO comanda (user_id, producte_id)";
        $sSql .= "VALUES ( ?, ?);";
        
        $sParam = array(
            "ss",
            $idUser,
            $idProducte  
        );
        $this->execute($sSql, $sParam, "action");   
    }
    
    public function getCarreto($idUser){
        $sSql = "INSERT INTO comanda (user_id, producte_id)";
        $sSql .= "VALUES ( ?, ?);";
        
        $sParam = array(
            "ss",
            $idUser,
            $idProducte
        );
        $this->execute($sSql, $sParam, "action");   
    }
}


