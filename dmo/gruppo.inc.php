<?php 

class Gruppo {
    public $ID;
    public $NomeGruppo;
    public $Descrizione;
    public $DataCreazione;
    public $Amministratore;

    public function __construct($ID, $NomeGruppo, $Descrizione, $DataCreazione, $Amministratore) {
        $this->ID = $ID;
        $this->NomeGruppo = $NomeGruppo;
        $this->Descrizione = $Descrizione;
        $this->DataCreazione = $DataCreazione;
        $this->Amministratore = $Amministratore;
    }
}


?>