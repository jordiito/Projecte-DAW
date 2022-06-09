<?php

//Controller del formulari de contacte, hereda les fucions de Controller
class ContactFormController extends Controller {
    private $missatge;
    
    //Constructor
    public function __construct($msg=null) {
        parent::__construct();
        if (isset($msg)) {
            $this->missatge = $msg;
        } else {
            $this->missatge=new Missatge();
        }
    }
    
    //Funció que mostra la vista del formulari de contacte
    public function show() {
        if ($_SERVER["REQUEST_METHOD"]=="GET") {
            $vContact = new ContactFormView();
            $vContact->show();
        } elseif ($_SERVER["REQUEST_METHOD"]=="POST" && isset($_POST["boto"])) {
            $frmNom = $this->sanitize($_POST["nom"], 4);
            $frmMail = $this->sanitize($_POST["email"], 1);
            $frmMsg = $this->sanitize($_POST["missatge"], 3);
            
            $this->missatge = new Missatge();
            $this->missatge->setNom($frmNom);
            $this->missatge->setEmail($frmMail);
            $this->missatge->setComentari($frmMsg);
            
            if (! isset($this->missatge->errors)) {
                
                if ($sFile = file_get_contents("missatgesDeContacte.xml")) {
                    $sLlibre = substr($sFile, 0, - 13);
                    $frmData = $this->missatge->getData();
                    $frmNom = $this->missatge->getNom();
                    $frmMail = $this->missatge->getEmail();
                    $frmMsg = $this->missatge->getComentari();
                    $sLlibre .= "\n    <REGISTRE>\n        <DATA>" . $frmData . "</DATA>\n";
                    $sLlibre .= "        <NOM>$frmNom</NOM>\n        <MAIL>$frmMail</MAIL>\n";
                    $sLlibre .= "        <COMENTARI>$frmMsg</COMENTARI>\n    </REGISTRE> \n";
                    $sLlibre .= "</REGISTRES>";
                    if ($file = fopen("missatgesDeContacte.xml", "w")) {
                        if (! fputs($file, $sLlibre)) {
                            throw new Exception("El fitxer no deixa escriure");
                        }
                        fclose($file);
                        $assumpte = "Nou formulari de contacte - PCBuilds";
                        $contingut = "Nom: $frmData" . "\r\n";
                        $contingut .= "Correu: $frmMail" . "\r\n";
                        $contingut .= "Data: $frmData" . "\r\n";
                        $contingut .= "Missatge: $frmMsg" . "\r\n";
                        $header = "From: bertran.daw22@gmail.com" . "\r\n";
                        $header .= "Reply-To: bertran.daw22@gmail.com" . "\r\n";
                        $header .= "X-Mailer: PHP/" . phpversion();
                    mail($frmMail, $assumpte, $contingut, $header);
                    } else {
                        throw new Exception("No s'ha pogut obrir el fitxer per emmagatzemar informació");
                    }
                    unset($frmNom);
                    unset($frmMail);
                    unset($frmMsg);
                    $vOk = new ErrorView();
                    $vOk->showOk("Perfecte!", "El comentari s'ha enviat correctament");
                }
            } else {
                $vContact = new ContactFormView($this->missatge);
                $vContact->show();
            }
            
        }
    }
}
