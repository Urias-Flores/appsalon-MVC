<?php

namespace Model;

class CitaServicio extends ActiveRecord
{
    protected static $table = 'citaservicios';
    protected static $columns = ['ID', 'CitaID', 'ServicioID'];

    public $ID;
    public $CitaID;
    public $ServicioID;

    public function __construct($arg = [])
    {
        $this->ID = $arg['ID'] ?? null;
        $this->CitaID = $arg['CitaID'] ?? null;
        $this->ServicioID = $arg['ServicioID'] ?? null;
    }
}