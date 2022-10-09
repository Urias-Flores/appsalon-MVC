<?php

namespace Model;

use Model\ActiveRecord;

class Cita extends ActiveRecord {

    protected static $table = 'Citas';
    protected static $columns = ['ID', 'Fecha', 'Hora', 'UsuarioID'];

    public $ID;
    public $Fecha;
    public $Hora;
    public $UsuarioID;

    public function __construct($arg = []){
        $this->ID = $arg['ID'] ?? null;
        $this->Fecha = $arg['Fecha'] ?? null;
        $this->Hora = $arg['Hora'] ?? null;
        $this->UsuarioID = $arg['UsuarioID'] ?? null;
    }

}
