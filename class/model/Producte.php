<?php

class Producte
{

    private $id;

    private $gtin;

    private $nom;

    private $descripcio;

    private $imatge;

    private $preu;

    private $pes;

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
    public function getGtin()
    {
        return $this->gtin;
    }

    /**
     *
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *
     * @return mixed
     */
    public function getDescripcio()
    {
        return $this->descripcio;
    }

    /**
     *
     * @return mixed
     */
    public function getImatge()
    {
        return $this->imatge;
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
    public function getPes()
    {
        return $this->pes;
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
    public function setGtin($gtin)
    {
        $this->gtin = $gtin;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     *
     * @param mixed $descripcio
     */
    public function setDescripcio($descripcio)
    {
        $this->descripcio = $descripcio;
    }

    /**
     *
     * @param mixed $imatge
     */
    public function setImatge($imatge)
    {
        $this->imatge = $imatge;
    }

    /**
     *
     * @param mixed $preu
     */
    public function setPreu($preu)
    {
        $this->preu = $preu;
    }

    /**
     *
     * @param mixed $pes
     */
    public function setPes($pes)
    {
        $this->pes = $pes;
    }

    public function __construct()
    {}
}