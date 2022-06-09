<?php
// Class modelo de usuario
class UsuarioModelo extends Model
{
    // Constructor, inicialitzar les conexions
    function __construct()
    {
        $this->queryLink = parent::getInstance()->queryLink;
        $this->actionLink = parent::getInstance()->actionLink;
    }
     // Obtenir les dades de usuari segons el email
    public function getByEmailTot($email)
    {
        // query sql
        $sSql = "SELECT * FROM usuari WHERE email=?;";
        $parametros = array(
            "s",
            $email
        );

        // Si hi ha error, retorna un error de bd
        if (! ($result = $this->execute($sSql, $parametros))) {
            $retorn['bbdd'] = "</br> Problema a l'executar la sentencia: <br> $sSql <br>" . mysqli_error($rConexion);
        } else {
            // Si no hi ha error, obtenir el resultat            
            $usuario = new Usuario();
            while ($row = $result->fetch_assoc()) {
                $usuario->setNom($row['nom']);
                $usuario->setCognoms($row['cognoms']);
                $usuario->setEmail($row['email']);
                $usuario->setPassword($row['contrasenya'], $row['contrasenya']);
                $usuario->setSexe($row['sex']);
                $usuario->setDatanaixement($row['data_nac']);
                $usuario->setTelefon($row['telefon']);
                $usuario->setPais($row['pais']);
                $usuario->setAdreca($row['direccio']);
                $usuario->setCodiPostal($row['codi_postal']);
                $usuario->setPoblacio($row['poblacio']);
                $usuario->setProvincia($row['provincia']);
                return $usuario;
            }
        }
        return $retorn;
    }
    // Obtenir les dades de usuari segons el email i la contrasenya
    public function getByEmail(Usuario $oUsuario)
    {
        $sSql = "SELECT * FROM usuari WHERE email=? AND contrasenya=?;";
        $parametros = array(
            "ss",
            $oUsuario->getEmail(),
            $oUsuario->getPassword()
        );

        if (! ($result = $this->execute($sSql, $parametros))) {

            $retorn['bbdd'] = "</br> Problema a l'executar la sentencia: <br> $sSql <br>" . mysqli_error($rConexion);
        } else if (($nfilas = $this->numeroDeFiles($result)) === 0) {
            $retorn['bbdd'] = "</br> Usuari o contrasenya incorrect<br>";
        } else {
            $retorn = $result->fetch_object("Usuario");
        }
        return $retorn;
    }
// Comprovar si el email és unic
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
// Guardar el usuari
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
    // Actualizar les dades d'usuari
    public function change(Usuario $usuario)
    {
        $sSql = "UPDATE usuari set nom=?,cognoms=?, sex=?, data_nac=?, telefon=?, pais=?, direccio=?, codi_postal=?, poblacio=?, provincia=? WHERE email=?";

        $telef = ($usuario->getTelefon() == "") ? null : $usuario->getTelefon();
        $sParam = array(
            "sssssssssss",
            $usuario->getNom(),
            $usuario->getCognoms(),
            $usuario->getSexe(),
            $usuario->getDatanaixement(),
            $telef,
            $usuario->getPais(),
            $usuario->getAdreca(),
            $usuario->getCodiPostal(),
            $usuario->getPoblacio(),
            $usuario->getProvincia(),
            $usuario->getEmail()
        );

        if ($resultatConsulta = $this->execute($sSql, $sParam, "action")) {
            return $this->getLastId();
        } else {
            return $errorsDetectats["baseDades"] = "Hi ha un error en al consulta a la BBDD: " . $this->getLastError();
        }
    }
    
    // canviar el password d'usuari
    public function changePass($email, $contra)
    {
        $sSql = "UPDATE usuari set contrasenya=? WHERE email=?";

        $sParam = array(
            "ss",
            $contra,
            $email
        );

        if ($resultatConsulta = $this->execute($sSql, $sParam, "action")) {
            return $this->getLastId();
        } else {
            return $errorsDetectats["baseDades"] = "Hi ha un error en al consulta a la BBDD: " . $this->getLastError();
        }
    }
}

