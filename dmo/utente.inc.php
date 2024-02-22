<?php

class Utente {
    public $ID;
    public $Nome;
    public $Cognome;
    public $Email;
    public $Password;
    public $Cell;
    public $Bannato;
    public $DataFineBan;
    public $UltimaVoltaOnline;

    public function __construct($ID, $Nome, $Cognome, $Email, $Password, $Cell, $Bannato, $DataFineBan, $UltimaVoltaOnline) {
        $this->ID = $ID;
        $this->Nome = $Nome;
        $this->Cognome = $Cognome;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Cell = $Cell;
        $this->Bannato = $Bannato;
        $this->DataFineBan = $DataFineBan;
        $this->UltimaVoltaOnline = $UltimaVoltaOnline;
    }
}

?>
