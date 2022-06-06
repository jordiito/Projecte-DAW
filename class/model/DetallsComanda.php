<?php

class DetallsComanda
{

    private $id;

    private $producte_id;

    private $comanda_id;

    private $quantitat;

    private $preu;

    private $subTotal;

    /**
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return mixed
     */
    public function getProducteId()
    {
        return $this->producte_id;
    }

    /**
     *
     * @return mixed
     */
    public function getComandaId()
    {
        return $this->comanda_id;
    }

    /**
     *
     * @return mixed
     */
    public function getQuantitat()
    {
        return $this->quantitat;
    }

    /**
     *
     * @return mixed
     */
    public function getPreu()
    {
        return $this->preu;
    }

    /**
     *
     * @return mixed
     */
    public function getSubtotal()
    {
        return $this->subTotal;
    }


    /**
     *
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     *
     * @param mixed $gtin
     */
    public function setProducteId($producte_id)
    {
        $this->producte_id = $producte_id;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setComandaId($comanda_id)
    {
        $this->comanda_id = $comanda_id;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setQuantitat($quantitat)
    {
        $this->quantitat = $quantitat;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setPreu($preu)
    {
        $this->preu = $preu;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setSubtotal($subTotal)
    {
        $this->subTotal = $subTotal;
    }


    public function __construct()
    {}
}