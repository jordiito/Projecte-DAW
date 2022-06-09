<?php

//Model s'encarrega de d'administrar la connexió a base de dades fent servir les dades
//Que conté l'arxiu Configuracio.php
class Model
{

    protected $config;

    protected $queryLink;

    protected $actionLink;

    protected static $_instance;

    private function __construct()
    {
        $this->config = Configuracio::getInstance();

        if ($link = new mysqli($this->config->getDbServidor(), $this->config->getDbUsernamePerConsultes(), $this->config->getDbPassword(), $this->config->getDbBaseDeDades())) {
            $this->queryLink = $link;
        } else {
            throw new Exception("problemes de conexxió a BBDD. Error: " . $link->connect_errno);
        }
        if ($link = new mysqli($this->config->getDbServidor(), $this->config->getDbUsernamePerAccions(), $this->config->getDbPassword(), $this->config->getDbBaseDeDades())) {
            $this->actionLink = $link;
        } else {
            throw new Exception("problemes de conexxió a BBDD. Error: " . $link->connect_errno);
        }
    }

    public function __destruct()
    {
        if (!isset($_POST['comprar'])) {
        $this->queryLink->close();
        $this->actionLink->close();
    }
    }

    public static function getInstance()
    {
        if (! (self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * Realita consultes sql a la base de dades.
     *
     * @param String $sql
     *            String amb la sentencia sql que volem esecutar
     * @param Array $parametres
     *            Conjunt de paràmetres de ls sentència Sql.
     * @return mixed recurs[Resource] on s'enmagatzema el resultat de la consulta
     */
    public function execute($sentencia, $parametres, $conexcio = "consulta")
    {
        if ($conexcio == "consulta") {
            if ($stmt = $this->queryLink->prepare($sentencia)) {

                if ($res = call_user_func_array(array(
                    $stmt,
                    'bind_param'
                ), $this->refValues($parametres))) {
                    if ($res = $stmt->execute()) {
                        $dades = $stmt->get_result();
                    }
                }
            }
        } else {
            if ($stmt = $this->actionLink->prepare($sentencia)) {

                if ($res = call_user_func_array(array(
                    $stmt,
                    'bind_param'
                ), $this->refValues($parametres))) {
                    if ($res = $stmt->execute()) {
                        $dades = $res;
                    } else {
                        throw new Exception("No s'ha pogut actualitzar -> " . $stmt->error);
                    }
                }
            }
        }
        return $dades;
    }

    /**
     * Obetenció d'una fila de resultats d'una sentencia sql
     *
     * @param mysqli_result $result
     *            recurs[Resource] on s'enmagatzema el resultat de la consulta i hem obtingut
     *            amb la funció ejecutar(sql)
     * @param integer $fila
     *            Numero de fila que volem recuperar.
     *            0 -> seqüencial, una fila rera l'altre.
     *            num -> una fila específica.
     * @return multitype: array amb els resultats en forma d'objecte.
     */

    public function obtenir_fila(mysqli_result $result, $fila)
    {
        if ($fila != 0) {
            $result->data_seek($fila);
        }
        return $result->fetch_object();
    }
    //Funció per comptar el nombre de files obtingudes com a resultat d'una query
    public function numeroDeFiles($result)
    {
        return $result->num_rows;
    }
    //Funció per rebre l'últim error de la base de dades
    public function getLastError()
    {
        if (isset($this->queryLink->errno)) {
            return $this->queryLink->errno;
        } else {
            return $this->actionLink->errno;
        }
    }

    //Funció que reb l'id de l'últim insert en la taula especificada.
    //Útil per insertar els detalls d'una comanda després de crear una comanda
    public function getLastId()
    {
        return $this->actionLink->insert_id;
    }

    private function refValues($arr)
    {
        $refs = array();
        foreach ($arr as $key => $value)
            $refs[$key] = &$arr[$key];
        return $refs;
    }

    public function clone()
    {}
}

