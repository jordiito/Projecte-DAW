<?php

class UsuarioController extends Controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            if ($_SESSION['loggedin'] == true) {
                $muser = new UsuarioModelo();
                $user = $muser->getByEmailTot($_SESSION['email']);
                $vUser = new UsuarioView($user);
                $vUser->logout();
            } else {
                $vUser = new UsuarioView();
                $vUser->login();
            }
        } else {
            $errorsDetectats = $this->validaDadesLogIn();
            if (isset($errorsDetectats)) {
                $vUser = new UsuarioView($this->user);
                $vUser->login($errorsDetectats);
            } else {
                $mUsuario = new UsuarioModelo();
                if (($result = $mUsuario->getByEmail($this->user)) instanceof Usuario) {
                    // INICIA LA SESSIÓ
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $result->getNom() . " " . $result->getCognoms();
                    $_SESSION['email'] = $result->getEmail();

                    // header("Location: index.php");
                    // exit();
                    $user = $mUsuario->getByEmailTot($_SESSION['email']);
                    $vUser = new UsuarioView($user);
                    $vUser->logout();
                } else {
                    $vUser = new UsuarioView($this->user);
                    $vUser->logIn($result);
                }
            }
        }
    }

    public function validaDadesLogIn()
    {
        $sEmail = $this->sanitize($_POST["nom"], 1);
        $sPassword = $this->sanitize($_POST["contrasenya"], 0);

        $this->user = new Usuario();
        $this->user->setEmail($sEmail);
        $this->user->setPassword($sPassword, $sPassword);
        return $this->user->errorsDetectats;
    }

    public function logout()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Logout'])) {
            unset($_SESSION['loggedin']);

           $vUser = new UsuarioView();
           $vUser->login();
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Guardar'])) {
            $errorsDetectats = $this->validaDadesRegistre2();
            if (isset($errorsDetectats)) {
                $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
                $vUser = new UsuarioView($this->user);
                $vUser->logout($errorsDetectats);
            } else {
                $errorsDetectats["error"] = "Les dades ja s'han modificat!";
                $vUser = new UsuarioView($this->user);
                $vUser->logout($errorsDetectats);
            }
        } else if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['changeContra'])) {
            $muser = new UsuarioModelo();
            $user = $muser->getByEmailTot($_SESSION['email']);
            if (($_POST["pass"] == "")) {
                $errorsDetectats["pass"] = "El password anterior no pot ser null";
            } else if (($_POST["cpass"] == "")) {
                $errorsDetectats["pass"] = "El password no pot ser null";
            } else {
                if ($_POST["pass0"] != $_POST["pass"]) {
                    $errorsDetectats["cpass"] = "La password incorrecta";
                }
            }
            if (isset($errorsDetectats)) {
                $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
                $vUser = new UsuarioView($user);
                $vUser->logout($errorsDetectats);
            } else {
                $muser->changePass($_POST["email"], $_POST["cpass"]);
                $errorsDetectats["error"] = "La contrasenya s'ha modificat!";
                $vUser = new UsuarioView($user);
                $vUser->logout($errorsDetectats);
            }
        } else {
            if ($_SESSION['loggedin'] == true) {
                $muser = new UsuarioModelo();
                $user = $muser->getByEmailTot($_SESSION['email']);
                $vUser = new UsuarioView($user);
                $vUser->logout();
            } else {
                $vUser = new UsuarioView();
                $vUser->login();
            }
        }
    }

    public function confirmacio($param)
    {
        if (! isset($param)) {
            throw new Exception("Falten dades per la confirmació");
        }
        $this->user = new Usuario();
        $this->user->setId($this->sanitize($param[0], 0));

        $mUser = new UsuarioModelo();
        $errorsDetectats = $mUser->confirma($this->user);

        $vError = new ErrorView();
        if (isset($errorsDetectats)) {
            $vError->showMessage("Procès finalitzat amb errors", "El procès de verificació ha produït un error: <br> {$errorsDetectats["baseDades"]}");
        } else {
            $vError->showOk("Procès finalitzat correctament", "El procès de registre ha finacilitzat amb éxit, el mail està validat.<br>Ara ja podràs accedir a la noastra àrea privada.<br><br>Moltes gràcies<br>");
        }
    }

    public function register()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $vUser = new UsuarioView();
            $vUser->register();
        } else {
            $errorsDetectats = $this->validaDadesRegistre();
            if (isset($errorsDetectats)) {
                $errorsDetectats["error"] = "S'ha detectat algun tipus d'error. Revisa les dades introduides.";
                $vUser = new UsuarioView($this->user);
                $vUser->register($errorsDetectats);
            } else {
                $sNom = $this->user->getNom();
                $sCognoms = $this->user->getCognoms();

                $titol = "Procès finalitzat correctament";
                $missatge .= "Benvolgut/da $sNom $sCognoms<br>Nunc non iaculis est. Etiam dignissim blandit est nec accumsan. Nulla in imperdiet lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Maecenas bibendum turpis ac lectus sollicitudin efficitur. Etiam ut ultricies massa. Nulla vitae consequat ex, eget fringilla magna. Proin auctor est vel felis gravida, non fringilla velit lobortis. Sed non metus vitae nisi dapibus porttitor nec in lacus. Duis ut arcu luctus, iaculis diam eu, elementum libero. Sed vitae nisi fermentum, gravida quam vel, scelerisque turpis. Etiam lacinia finibus massa laoreet iaculis.  ";
                $vError = new ErrorView();
                $vError->showOk($titol, $missatge);
            }
        }
    }

    public function validaDadesRegistre()
    {
        $this->user = new Usuario();
        $this->user->setEmail($this->sanitize($_POST["email"], 1));
        $this->user->setPassword($this->sanitize($_POST["pass"], 0), $this->sanitize($_POST["cpass"], 0));
        $this->user->setNom($this->sanitize($_POST["nom"], 1));
        $this->user->setCognoms($this->sanitize($_POST["cognoms"], 1));
        $this->user->setSexe($this->sanitize($_POST["sexe"], 2));
        $this->user->setDatanaixement($this->sanitize($_POST["naixement"], 0));
        $this->user->setPais($this->sanitize($_POST["pais"], 1));
        $this->user->setAdreca($this->sanitize($_POST["adreca"], 1));
        $this->user->setCodiPostal($this->sanitize($_POST["cp"], 0));
        $this->user->setPoblacio($this->sanitize($_POST["poblacio"], 1));
        $this->user->setProvincia($this->sanitize($_POST["provincia"], 1));
        $this->user->setTelefon($this->sanitize($_POST["telefon"], 0));

        $mUsuari = new UsuarioModelo();
        if (! $mUsuari->isEmailUnic($this->user)) {
            $this->user->errorsDetectats["email"] = "Aquest email ja existeix a la meva base de dades<br>";
        }

        if (! isset($this->user->errorsDetectats)) {
            if (is_array($res = $mUsuari->save($this->user))) {
                $this->user->errorsDetectats[] = $res;
            } else {
                $this->user->setId($res);
            }
        }

        return $this->user->errorsDetectats;
    }

    public function validaDadesRegistre2()
    {
        $this->user = new Usuario();
        $this->user->setEmail($this->sanitize($_POST["email"], 1));
        $this->user->setNom($this->sanitize($_POST["nom"], 1));
        $this->user->setCognoms($this->sanitize($_POST["cognoms"], 1));
        $this->user->setSexe($this->sanitize($_POST["sexe"], 2));
        $this->user->setDatanaixement($this->sanitize($_POST["naixement"], 0));
        $this->user->setPais($this->sanitize($_POST["pais"], 1));
        $this->user->setAdreca($this->sanitize($_POST["adreca"], 1));
        $this->user->setCodiPostal($this->sanitize($_POST["cp"], 0));
        $this->user->setPoblacio($this->sanitize($_POST["poblacio"], 1));
        $this->user->setProvincia($this->sanitize($_POST["provincia"], 1));
        $this->user->setTelefon($this->sanitize($_POST["telefon"], 0));

        $mUsuari = new UsuarioModelo();

        if (! isset($this->user->errorsDetectats)) {
            if (is_array($res = $mUsuari->change($this->user))) {
                $this->user->errorsDetectats[] = $res;
            } else {
                $this->user->setId($res);
            }
        }
        return $this->user->errorsDetectats;
    }
}

