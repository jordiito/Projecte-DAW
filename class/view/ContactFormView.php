<?php
//Vista de la pàgina de contacte, carrega els templates necessaris per la pàgina
class ContactFormView extends View {
    private $missatge;
    
    public function __construct($msg=null) {
        parent::__construct();
        if (isset($msg)) {
            $this->missatge=$msg;
        }else{
            $this->missatge= new Missatge();
        }
    }
    
    public function show() {
        include_once "php/functions.php";
        include_once "config.php";
        
        $frmNom = $this->missatge->getNom();
        $frmMail = $this->missatge->getEmail();
        $frmMsg = $this->missatge->getComentari();
        $errors = $this->missatge->errors;
        
        include "templates/tpl_head.php";
        include "templates/tpl_header.php";
        
        include "templates/tpl_body_contactForm.php";

        include "templates/tpl_footer.php";
    }
}
