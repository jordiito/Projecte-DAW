<?php

class UsuarioView extends View
{

    private $_user;

    public function __construct(Usuario $param = null)
    {
        parent::__construct();
        if (isset($param)) {
            $this->_user = $param;
        } else {
            $this->_user = new Usuario();
        }
    }

    public function login($errorsDetectats = null)
    {
        if (isset($this->_user)) {
            $frmNom = $this->_user->getEmail();
            $frmContrasenya = $this->_user->getPassword();
        }

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        include "templates/tpl_body_login.php";

        include "templates/tpl_footer.php";
    }

    public function logout($errorsDetectats = null)
    {
        if (isset($this->_user)) {
            $frmNom = $this->_user->getNom();
            $frmCognoms = $this->_user->getCognoms();
            $frmEmail = $this->_user->getEmail();
            $frmPass = $this->_user->getPassword();
            $frmSex = $this->_user->getSexe();
            if ($frmSex == "D") {
                $frmSex = "Dona";
            } else {
                $frmSex = "Home";
            }
            $frmData = $this->_user->getDatanaixement();
            $frmTel = $this->_user->getTelefon();
            $frmPais = $this->_user->getPais();
            $frmAdr = $this->_user->getAdreca();
            $frmCod = $this->_user->getCodiPostal();
            $frmPob = $this->_user->getPoblacio();
            $frmPro = $this->_user->getProvincia();
        }

        $options = [
            "type" => "password",
            "name" => "pass",
            "placeholder" => "Contrasenya Anterior",
            "class" => "llarg",
            "value" => "",
            "span" => $errorsDetectats["pass"]
        ];
        $input_pass = $this->html_generaInput($options);

        $options = [
            "type" => "password",
            "name" => "cpass",
            "placeholder" => "Nou contrasenya ",
            "class" => "llarg",
            "value" => "",
            "span" => $errorsDetectats["cpass"]
        ];
        $input_cpass = $this->html_generaInput($options);

        $options = [
            "type" => "text",
            "name" => "nom",
            "placeholder" => $frmNom,
            "class" => "llarg",
            "value" => $frmNom,
            "span" => $errorsDetectats["nom"]
        ];
        $input_nom = $this->html_generaInput($options);

        $options = [
            "type" => "text",
            "name" => "cognoms",
            "placeholder" => $frmCognoms,
            "class" => "llarg",
            "value" => $frmCognoms,
            "span" => $errorsDetectats["cognoms"]
        ];
        $input_cognoms = $this->html_generaInput($options);

        $opcions = [
            "sexe1" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "H",
                "checked" => ($frmSex == "Home") ? true : false,
                "label" => "Home"
            ],
            "sexe2" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "D",
                "checked" => ($frmSex == "Dona") ? true : false,
                "label" => "Dona"
            ]
        ];
        $select_Sexe = $this->html_generateRadioButon($opcions);

        $options = [
            "type" => "text",
            "name" => "naixement",
            "placeholder" => $frmData,
            "class" => "llarg",
            "value" => $frmData,
            "span" => $errorsDetectats["dNaixement"]
        ];
        $input_naixement = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "name" => "adreca",
            "placeholder" => $frmAdr,
            "value" => $frmAdr,
            "span" => $errorsDetectats["adreca"]
        ];
        $input_adreca = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "name" => "pais",
            "placeholder" => $frmPais,
            "value" => $frmPais,
            "span" => $errorsDetectats["pais"]
        ];
        $input_pais = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "cp",
            "placeholder" => $frmCod,
            "value" => $frmCod,
            "span" => $errorsDetectats["cp"]
        ];
        $input_cp = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "poblacio",
            "placeholder" => $frmPob,
            "value" => $frmPob,
            "span" => $errorsDetectats["poblacio"]
        ];
        $input_poblacio = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "provincia",
            "placeholder" => $frmPro,
            "value" => $frmPro,
            "span" => $errorsDetectats["provincia"]
        ];
        $input_provincia = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "telefon",
            "placeholder" => $frmTel,
            "value" => $frmTel,
            "span" => $errorsDetectats["telefon"]
        ];
        $input_telefon = $this->html_generaInput($options);
        $options = [
            "type" => "submit",
            "name" => "Guardar",
            "class" => "submit action-button",
            "value" => "Guardar"
        ];
        $input_bSend = $this->html_generaInput($options);

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        include "templates/tpl_body_logout.php";

        include "templates/tpl_footer.php";
    }

    public function register($errorsDetectats = null)
    {
        $sEmail = $this->_user->getEmail();
        $sPassword = $this->_user->getPassword();
        $cPassword = $this->_user->getPassword();

        $sNom = $this->_user->getNom();
        $sCognoms = $this->_user->getCognoms();
        $sSexe = $this->_user->getSexe();
        $dNaixement = $this->_user->getDatanaixement();

        $sAdreca = $this->_user->getAdreca();
        $sCP = $this->_user->getCodiPostal();
        $sPais = $this->_user->getPais();
        $sPoblacio = $this->_user->getPoblacio();
        $sProvincia = $this->_user->getProvincia();
        $sTelefon = $this->_user->getTelefon();

        $options = [
            "type" => "text",
            "name" => "email",
            "placeholder" => "email (Obligatori)",
            "class" => "llarg",
            "value" => $sEmail,
            "span" => $errorsDetectats["email"]
        ];
        $input_email = $this->html_generaInput($options);

        $options = [
            "type" => "password",
            "name" => "pass",
            "placeholder" => "Contrasenya (Obligatori)",
            "class" => "llarg",
            "value" => $sPassword,
            "span" => $errorsDetectats["pass"]
        ];
        $input_pass = $this->html_generaInput($options);

        $options = [
            "type" => "password",
            "name" => "cpass",
            "placeholder" => "Confirma la contrasenya (Obligatori)",
            "class" => "llarg",
            "value" => $cPassword,
            "span" => $errorsDetectats["cpass"]
        ];
        $input_cpass = $this->html_generaInput($options);

        $options = [
            "type" => "button",
            "name" => "next",
            "class" => "next action-button",
            "value" => "Next"
        ];
        $input_bNext = $this->html_generaInput($options);

        $atributs = [
            "class" => "curt",
            "name" => "tipus",
            "span" => $errorsDetectats["tipus"]
        ];
        $opcions = [
            "NIF" => "NIF: Número d'Identificació Fiscal",
            "NIE" => "NIE: Número d'Identificació d'Extranjers",
            "PAS" => "PAS: Passaport"
        ];
        $seleccionat = (isset($sTipus)) ? $sTipus : "NIF";
        $select_Tipus = $this->html_generateSelect($opcions, $seleccionat, $atributs);

        $options = [
            "type" => "text",
            "name" => "dni",
            "placeholder" => "DNI (Obligatori)",
            "class" => "curt",
            "value" => $sDni,
            "span" => $errorsDetectats["dni"]
        ];
        $input_dni = $this->html_generaInput($options);

        $options = [
            "type" => "text",
            "name" => "nom",
            "placeholder" => "Nom (Obligatori)",
            "class" => "llarg",
            "value" => $sNom,
            "span" => $errorsDetectats["nom"]
        ];
        $input_nom = $this->html_generaInput($options);

        $options = [
            "type" => "text",
            "name" => "cognoms",
            "placeholder" => "Cognoms (Obligatori)",
            "class" => "llarg",
            "value" => $sCognoms,
            "span" => $errorsDetectats["cognoms"]
        ];
        $input_cognoms = $this->html_generaInput($options);

        $opcions = [
            "sexe1" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "H",
                "checked" => ($sSexe == "H") ? true : false,
                "label" => "Home"
            ],
            "sexe2" => [
                "name" => "sexe",
                "class" => "llarg",
                "value" => "D",
                "checked" => ($sSexe == "D") ? true : false,
                "label" => "Dona"
            ]
        ];
        $select_Sexe = $this->html_generateRadioButon($opcions);

        $options = [
            "type" => "text",
            "name" => "naixement",
            "placeholder" => "Data de naixement (Obligatori)",
            "class" => "llarg",
            "value" => $dNaixement,
            "span" => $errorsDetectats["dNaixement"]
        ];
        $input_naixement = $this->html_generaInput($options);

        $options = [
            "type" => "button",
            "name" => "previous",
            "class" => "previous action-button",
            "value" => "Previous"
        ];
        $input_bPrev = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "name" => "adreca",
            "placeholder" => "Adreça",
            "value" => $sAdreca,
            "span" => $errorsDetectats["adreca"]
        ];
        $input_adreca = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "name" => "pais",
            "placeholder" => "País",
            "value" => $sPais,
            "span" => $errorsDetectats["pais"]
        ];
        $input_pais = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "cp",
            "placeholder" => "C.P.",
            "value" => $sCP,
            "span" => $errorsDetectats["cp"]
        ];
        $input_cp = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "poblacio",
            "placeholder" => "Població",
            "value" => $sPoblacio,
            "span" => $errorsDetectats["poblacio"]
        ];
        $input_poblacio = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "provincia",
            "placeholder" => "Provincia",
            "value" => $sProvincia,
            "span" => $errorsDetectats["provincia"]
        ];
        $input_provincia = $this->html_generaInput($options);

        $options = [
            "class" => "llarg",
            "class" => "curt",
            "name" => "telefon",
            "placeholder" => "Teléfon (Obligatori)",
            "value" => $sTelefon,
            "span" => $errorsDetectats["telefon"]
        ];
        $input_telefon = $this->html_generaInput($options);

        $options = [
            "type" => "submit",
            "name" => "submit",
            "class" => "submit action-button",
            "value" => "Envia Dades"
        ];
        $input_bSend = $this->html_generaInput($options);

        if (isset($this->_user)) {
            $frmNom = $this->_user->getEmail();
            $frmContrasenya = $this->_user->getPassword();
        }

        include "templates/tpl_head.php";
        include "templates/tpl_header.php";

        include "templates/tpl_body_register.php";

        include "templates/tpl_footer.php";
    }
}