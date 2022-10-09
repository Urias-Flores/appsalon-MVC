<?php

namespace Model;

class Servicio extends ActiveRecord{
    protected static $table = 'servicio';
    protected static $columns = ['ID', 'Nombre', 'Precio'];

    public $ID;
    public $Nombre;
    public $Precio;

    public function __construct($arg = []){
        $this->ID = $arg['ID'] ?? null;
        $this->Nombre = $arg['Nombre'] ?? '';
        $this->Precio = $arg['Precio'] ?? '';
    }

    public function validate() : array {
        if(!$this->Nombre){
            self::$alert['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->Precio){
            return self::$alert['error'][] = 'El precio es obligatorio';
        }
        if(!is_numeric($this->Precio) || intval($this->Precio) < 0){
            self::$alert['error'][] = 'El precio ingresado no es valido';
        }
        return self::$alert;
    }
}