<?php
//Classe comanda, on es defineix quina estructura han de tenir les comandes
class Comanda
{

    private $id;

    private $user_id;

    private $pagament_id;

    private $data;

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
    public function getUserId()
    {
        return $this->user_id;
    }

    /**
     *
     * @return mixed
     */
    public function getPagamentId()
    {
        return $this->pagament_id;
    }

    /**
     *
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
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
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setPagamentId($pagament_id)
    {
        $this->pagament_id = $pagament_id;
    }

    /**
     *
     * @param mixed $nom
     */
    public function setData($data)
    {
        $this->data = $data;
    }

    public function __construct()
    {}
}