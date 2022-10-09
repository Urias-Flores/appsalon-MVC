<?php

namespace Model;

class AdminCitas extends \Model\ActiveRecord
{
    protected static $table = 'citaservicios';
    protected static $columns = ['ID', 'Hora', 'Cliente', 'Correo', 'Telefono', 'Servicio', 'Precio'];

    public $ID;
    public $Hora;
    public $Cliente;
    public $Correo;
    public $Telefono;
    public $Servicio;
    public $Precio;

    public function __construct($arg = [])
    {
        $this->ID = $arg['ID'] ?? null;
        $this->Hora = $arg['Hora'] ?? null;
        $this->Cliente = $arg['Cliente'] ?? null;
        $this->Correo = $arg['Correo'] ?? null;
        $this->Telefono = $arg['Telefono'] ?? null;
        $this->Servicio = $arg['Servicio'] ?? null;
        $this->Precio = $arg['Precio'] ?? null;
    }
}