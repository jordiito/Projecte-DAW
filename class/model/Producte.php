<?php
// Definició de l'estructura de dades dels productes
class Producte
{
    // les variables
    private $id;

    private $gtin;

    private $marca;

    private $model;

    private $categoria;

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
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     *
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
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
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
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