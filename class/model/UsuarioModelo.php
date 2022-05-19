<?php

class UsuarioModelo extends Model
{

    function __construct()
    {
        $this->queryLink = parent::getInstance()->queryLink;
        $this->actionLink = parent::getInstance()->actionLink;
    }

    public function getByEmail(Usuario $oUsuario)
    {
        $sSql = "SELECT * FROM usuari WHERE email=? AND contrasenya=?;";
        $parametros = array(
            "ss",
            $oUsuario->getEmail(),
            $oUsuario->getPassword()
        );

        if (! ($result = $this->execute($sSql, $parametros))) {
            $retorn['bbdd'] = "</br> Error 006 - Problema a l'executar la sentencia: <br> $sSql <br>" . mysqli_error($rConexion);
        } else if (($nfilas = $this->numeroDeFiles($result)) === 0) {
            $retorn['bbdd'] = "</br> Error 007 - La combinació d'usuari i contrasenya no existeix<br>";
        } else {
            $retorn = $result->fetch_object("Usuario");
        }
        return $retorn;
    }

    public function isEmailUnic(Usuario $oUser)
    {
        $sSql = "SELECT COUNT(*) AS res FROM usuari WHERE email = ?";
        $parametres = array(
            "s",
            $oUser->getEmail()
        );

        if ($resultatConsulta = $this->execute($sSql, $parametres)) {
            $registreResultat = $this->obtenir_fila($resultatConsulta, 0);
            if ($registreResultat->res == 0) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function save(Usuario $usuario)
    {
        $sSql = "INSERT INTO usuari (id, nom, cognoms, email, contrasenya, sex, data_nac, telefon, pais, direccio, codi_postal, poblacio, provincia)";
        $sSql .= "VALUES (NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $telef = ($usuario->getTelefon() == "") ? null : $usuario->getTelefon();
        $sParam = array(
            "ssssssssssss",
            $usuario->getNom(),
            $usuario->getCognoms(),
            $usuario->getEmail(),
            $usuario->getPassword(),
            $usuario->getSexe(),
            $usuario->getDatanaixement(),
            $telef,
            $usuario->getPais(),
            $usuario->getAdreca(),
            $usuario->getCodiPostal(),
            $usuario->getPoblacio(),
            $usuario->getProvincia()
        );

        if ($resultatConsulta = $this->execute($sSql, $sParam, "action")) {
            return $this->getLastId();
        } else {
            return $errorsDetectats["baseDades"] = "Hi ha un error en al consulta a la BBDD: " . $this->getLastError();
        }
    }
}

