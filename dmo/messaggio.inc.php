<?php

class Messaggio {
    private $ID;
    private $Contenuto;
    private $DataCreazione;
    private $CFUtente;
    private $IDConversazione;

    public function __construct($ID = null, $Contenuto = null, $DataCreazione = null, $CFUtente = null, $IDConversazione = null) {
        $this->ID = $ID;
        $this->Contenuto = $Contenuto;
        $this->DataCreazione = $DataCreazione;
        $this->CFUtente = $CFUtente;
        $this->IDConversazione = $IDConversazione;
    }

    // Getter and Setter for ID
    public function getID() {
        return $this->ID;
    }

    public function setID($ID) {
        $this->ID = $ID;
    }

    // Getter and Setter for Contenuto
    public function getContenuto() {
        return $this->Contenuto;
    }

    public function setContenuto($Contenuto) {
        $this->Contenuto = $Contenuto;
    }

    // Getter and Setter for DataCreazione
    public function getDataCreazione() {
        return $this->DataCreazione;
    }

    public function setDataCreazione($DataCreazione) {
        $this->DataCreazione = $DataCreazione;
    }

    // Getter and Setter for CFUtente
    public function getCFUtente() {
        return $this->CFUtente;
    }

    public function setCFUtente($CFUtente) {
        $this->CFUtente = $CFUtente;
    }

    // Getter and Setter for IDConversazione
    public function getIDConversazione() {
        return $this->IDConversazione;
    }

    public function setIDConversazione($IDConversazione) {
        $this->IDConversazione = $IDConversazione;
    }
}
