<?php

class Usuario
{

    private $id;

    private $email;

    private $password;

    private $nom;

    private $cognoms;

    private $sexe;

    private $datanaixement;

    private $adreca;

    private $codiPostal;

    private $pais;

    private $poblacio;

    private $provincia;

    private $telefon;

    public $errorsDetectats;

    public function __construct()
    {}

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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     *
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
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
    public function getCognoms()
    {
        return $this->cognoms;
    }

    /**
     *
     * @return mixed
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     *
     * @return mixed
     */
    public function getDatanaixement()
    {
        return $this->datanaixement;
    }

    /**
     *
     * @return mixed
     */
    public function getAdreca()
    {
        return $this->adreca;
    }

    /**
     *
     * @return mixed
     */
    public function getCodiPostal()
    {
        return $this->codiPostal;
    }

    /**
     *
     * @return mixed
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     *
     * @return mixed
     */
    public function getPoblacio()
    {
        return $this->poblacio;
    }

    /**
     *
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     *
     * @return mixed
     */
    public function getTelefon()
    {
        return $this->telefon;
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
     * @param mixed $email
     */
    public function setEmail($email)
    {
        include "config.php";

        if ($email == "") {
            $this->errorsDetectats["email"] = "l'email és una dada obligatòria, si us plau indica-la.";
        } else {
            if (! $this->esEmail($email)) {
                $this->errorsDetectats["email"] = "l'email no té un format adient.";
            } else {
                $this->email = $email;
            }
        }
    }

    /**
     *
     * @param mixed $password
     */
    public function setPassword($sPassword, $cPassword)
    {
        if (($sPassword == "") || ($cPassword == "")) {
            $this->errorsDetectats["pass"] = "El password és una dada obligatòria, si us plau indica-la.";
        } else {
            if ($sPassword != $cPassword) {
                $this->errorsDetectats["cpass"] = "La repetició del password no correspon amb el password entrat.";
            } else {
                $this->password = $sPassword;
            }
        }
    }

    /**
     *
     * @param mixed $nom
     */
    public function setNom($sNom)
    {
        if ($sNom == "") {
            $this->errorsDetectats["nom"] = "El nom és una dada obligatòria, si us plau indica-la.";
        } else {
            if (! $this->esNom($sNom)) {
                $this->errorsDetectats["nom"] = "El nom no té un format correcte.";
            } else {
                $this->nom = $sNom;
            }
        }
    }

    /**
     *
     * @param mixed $cognoms
     */
    public function setCognoms($sCognoms)
    {
        if ($sCognoms == "") {
            $this->errorsDetectats["cognoms"] = "El nom és una dada obligatòria, si us plau indica-la.";
        } else {
            if (! $this->esNom($sCognoms)) {
                $this->errorsDetectats["cognoms"] = "Els cognoms no tenen un format correcte.";
            } else {
                $this->cognoms = $sCognoms;
            }
        }
    }

    /**
     *
     * @param mixed $sexe
     */
    public function setSexe($sSexe)
    {
        if (! $this->esSexe($sSexe)) {
            $this->errorsDetectats["sexe"] = "Hi ha hagut algun problema amb la seleccio de sexe.";
        } else {
            $this->sexe = $sSexe;
        }
    }

    /**
     *
     * @param mixed $datanaixement
     */
    public function setDatanaixement($dNaixement)
    {
        if ($dNaixement == "") {
            $this->errorsDetectats["dNaixement"] = "La data de naixement és una dada obligatòria, si us plau indica-la.";
        } else {
            $this->datanaixement = $dNaixement;
        }
    }

    /**
     *
     * @param mixed $adreca
     */
    public function setAdreca($adreca)
    {
        $this->adreca = $adreca;
    }

    /**
     *
     * @param mixed $codiPostal
     */
    public function setCodiPostal($sCP)
    {
        if (($sCP != "") && (! $this->esCodiPostal($sCP))) {
            $this->errorsDetectats["cp"] = "Els codi postal no correspon a cap població.";
        } else {
            $this->codiPostal = $sCP;
        }
    }

    /**
     *
     * @param mixed $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     *
     * @param mixed $poblacio
     */
    public function setPoblacio($poblacio)
    {
        $this->poblacio = $poblacio;
    }

    /**
     *
     * @param mixed $provincia
     */
    public function setProvincia($sProvincia)
    {
        if (($sProvincia != "") && (! $this->esProvincia($sProvincia))) {
            $this->errorsDetectats["provincia"] = "La provincia no és una de les espanyoles.";
        } else {
            $this->provincia = $sProvincia;
        }
    }

    /**
     *
     * @param mixed $telefon
     */
    public function setTelefon($sTelefon)
    {
        if (($sTelefon != "") && (! $this->esTelefon($sTelefon))) {
            $this->errorsDetectats["telefon"] = "El format del telèfon no és correcte.";
        } else {
            $this->telefon = $sTelefon;
        }
    }

    function esTipus($dadaAVerificar)
    {
        $tipusValids = array(
            "NIF",
            "NIE",
            "PAS"
        );
        if (in_array($dadaAVerificar, $tipusValids)) {
            $esCorrecte = true;
        } else {
            $esCorrecte = false;
        }
        return $esCorrecte;
    }

    function esSexe($dadaAVerificar)
    {
        $tipusValids = array(
            "H",
            "D"
        );
        if (in_array($dadaAVerificar, $tipusValids)) {
            $esCorrecte = true;
        } else {
            $esCorrecte = false;
        }
        return $esCorrecte;
    }

    function esEmail($emailAVerificar)
    {
        if (filter_var($emailAVerificar, FILTER_VALIDATE_EMAIL)) {
            $esEmail = true;
        } else {
            $esEmail = false;
        }
        return $esEmail;
    }

    function esNom($nomAValidar)
    {
        if (preg_match("/^[a-z ']*$/", $nomAValidar)) {
            $esNom = true;
        } else {
            $esNom = false;
        }
        return $esNom;
    }

    function esCodiPostal($codiPostalAVerificar)
    {
        if ((strlen($codiPostalAVerificar) == 5) && (is_numeric($codiPostalAVerificar))) {
            $esCP = true;
        } else {
            $esCP = false;
        }
        return $esCP;
    }

    function esProvincia($provinciaAVerificar)
    {
        $provincias = array(
            'alava',
            'arava',
            'albacete',
            'alacant',
            'alicante',
            'almería',
            'asturias',
            'avila',
            'badajoz',
            'barcelona',
            'burgos',
            'cáceres',
            'cádiz',
            'cantabria',
            'castelló',
            'castellón',
            'ciudad real',
            'córdoba',
            'la coruña',
            'cuenca',
            'girona',
            'gerona',
            'granada',
            'guadalajara',
            'guipuzkoa',
            'guipúzcoa',
            'huelva',
            'huesca',
            'illes balears',
            'islas baleares',
            'jaén',
            'león',
            'lleida',
            'lérida',
            'lugo',
            'madrid',
            'málaga',
            'murcia',
            'navarra',
            'orense',
            'palencia',
            'las palmas',
            'pontevedra',
            'la rioja',
            'salamanca',
            'segovia',
            'sevilla',
            'soria',
            'tarragona',
            'santa cruz de tenerife',
            'teruel',
            'toledo',
            'valència',
            'valencia',
            'valladolid',
            'bizkaia',
            'vizcaya',
            'zamora',
            'zaragoza'
        );
        if (in_array($provinciaAVerificar, $provincias)) {
            $esUnProvincia = true;
        } else {
            $esUnProvincia = false;
        }
        return $esUnProvincia;
    }

    function esTelefon($telefonAVerificar)
    {
        if ((strlen($telefonAVerificar) == 9) && (is_numeric($telefonAVerificar))) {
            $esTelefon = true;
        } else {
            $esTelefon = false;
        }
        return $esTelefon;
    }
}
