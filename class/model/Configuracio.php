<?php

class Configuracio
{
    // Dades de configuració per accés a base de dades
    private $_dbServidor;

    private $_dbUsernamePerConsultes;

    private $_dbUsernamePerAccions;

    private $_dbPassword;

    private $_dbBaseDeDades;

    private static $_instance;

    private function __construct()
    {
        include "config.php";

        $this->_dbServidor = $dbServidor;
        $this->_dbUsernamePerConsultes = $dbUsernamePerConsultes;
        $this->_dbUsernamePerAccions = $dbUsernamePerAccions;
        $this->_dbPassword = $dbPassword;
        $this->_dbBaseDeDades = $dbBaseDeDades;
    }

    public static function getInstance()
    {
        if (! (self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function clone()
    {}

    /**
     *
     * @return mixed
     */
    public function getDirectoriDePujades()
    {
        return $this->_directoriDePujades;
    }

    /**
     *
     * @return mixed
     */
    public function getFormatsImatgesPermesos()
    {
        return $this->_formatsImatgesPermesos;
    }

    /**
     *
     * @return mixed
     */
    public function getMimesImatgesPermesos()
    {
        return $this->_mimesImatgesPermesos;
    }

    /**
     *
     * @return mixed
     */
    public function getDbServidor()
    {
        return $this->_dbServidor;
    }

    /**
     *
     * @return mixed
     */
    public function getDbUsernamePerConsultes()
    {
        return $this->_dbUsernamePerConsultes;
    }

    /**
     *
     * @return mixed
     */
    public function getDbUsernamePerAccions()
    {
        return $this->_dbUsernamePerAccions;
    }

    /**
     *
     * @return mixed
     */
    public function getDbPassword()
    {
        return $this->_dbPassword;
    }

    /**
     *
     * @return mixed
     */
    public function getDbBaseDeDades()
    {
        return $this->_dbBaseDeDades;
    }
}

