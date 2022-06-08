<?php
class Missatge {
    private $nom;
    private $email;
    private $comentari;
    private $data;
    
    public $errors;
    
    public function __construct() {
        $data = getdate();
        $this->data = $data["mday"]."/".$data["mon"]."/".$data["year"];
    }
    /**
     * @return mixed
     */
    public function getNom() {
        return $this->nom;
    }
    
    /**
     * @return mixed
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * @return mixed
     */
    public function getComentari() {
        return $this->comentari;
    }
    
    /**
     * @return mixed
     */
    public function getData() {
        return $this->data;
    }
    
    /**
     * @param mixed $nom
     */
    public function setNom($nom) {
        if (strlen($nom) == 0) {
            $this->errors["nom"] = "Has d'informar un nom";
        } else {
            $this->nom = $nom;
        }
    }
    
    /**
     * @param mixed $email
     */
    public function setEmail($email) {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors["mail"] = "L'adreça de correu no és vàlida";
        } else {
            $this->email = $email;
        }
    }
    
    /**
     * @param mixed $comentari
     */
    public function setComentari($comentari) {
        if (strlen($comentari) == 0) {
            $this->errors["missatge"] = "Has d'escriure el comentari que vols enviar";
        } else {
            $this->comentari = $comentari;
        }
    }
}
