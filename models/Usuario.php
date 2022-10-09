<?php

namespace Model;
use Model\ActiveRecord;

class Usuario extends ActiveRecord {

    protected static $table = 'usuario';
    protected static $columns =
    ['ID', 'Nombre', 'Apellido', 'Correo', 'Telefono', 'Admin', 'Confirmado', 'Token', 'Contrasena'];


    public $ID;
    public $Nombre;
    public $Apellido;
    public $Correo;
    public $Telefono;
    public $Admin;
    public $Confirmado;
    public $Token;
    public $Contrasena;

    public function __construct($arg = []){
        $this->ID = $arg['ID'] ?? null;
        $this->Nombre = $arg['Nombre'] ?? '';
        $this->Apellido = $arg['Apellido'] ?? '';
        $this->Correo = $arg['Correo'] ?? '';
        $this->Telefono = $arg['Telefono'] ?? '';
        $this->Admin = $arg['Admin'] ?? '0';
        $this->Confirmado = $arg['Confirmado'] ?? '0';
        $this->Token = $arg['Token'] ?? '';
        $this->Contrasena = $arg['Contrasena'] ?? '';
    }

    public function validateNewAccount() : array
    {
        if(!$this->Nombre){
            self::$alert['error'][] = 'El nombre es obligatorio';
        }
        if(!$this->Apellido){
            self::$alert['error'][] = 'El apellido es obligatorio';
        }
        if(!$this->Correo){
            self::$alert['error'][] = 'El correo es obligatorio';
        }
        if(!$this->Telefono){
            self::$alert['error'][] = 'El telefono es obligatorio';
        }
        if(!$this->Contrasena){
            self::$alert['error'][] = 'La contrasena es obligatoria';
        }
        if (strlen($this->Contrasena) <  8){
            self::$alert['error'][] = 'La contrasena debe tener al menos 8 caracteres';
        }
        if($this->usuarioExist()){
            self::$alert['error'][] = 'El usuario ya esta registrado';
        }
        return self::$alert;
    }

    public function usuarioExist(){
        $Query = 'SELECT * FROM ' . self::$table . ' WHERE Correo = "' . $this->Correo . '" LIMIT 1';
        $Result = self::$Connection->query($Query);

        if($Result->num_rows > 0){
            return true;
        }
        return false;
    }

    public function validateLogin() : array{
        $ActualUser = Usuario::where('Correo', $this->Correo);
        if(!$this->Correo){
            self::$alert['error'][] = 'El correo es obligatorio';
        }
        if(!$this->Contrasena){
            self::$alert['error'][] = 'La contrasena es obligatoria';
        }
        if($this->Contrasena && $this->Correo){
            if(!$this->usuarioExist()){
                self::$alert['error'][] = 'El usuario ingresado no existe';
                return self::$alert;
            }
            $comparepasswords = password_verify($this->Contrasena, $ActualUser->Contrasena);
            if(!$comparepasswords){
                self::$alert['error'][] = 'La contrasena ingresada es incorrecta';
                return self::$alert;
            }
            if($ActualUser->Confirmado === '0'){
                self::$alert['error'][] = 'El usuario no ah sido confirmado';
            }
        }
        return self::$alert;
    }

    public function validateResetPassword() : array{
        $ActualUser = Usuario::where('Correo', $this->Correo);
        if(!$this->Correo){
            self::$alert['error'][] = 'El correo electronico es obligatorio';
        }else{
            if(!$this->usuarioExist()){
                self::$alert['error'][] = 'El usuario ingresado no existe';
                return self::$alert;
            }
            if($ActualUser->Confirmado === '0'){
                self::$alert['error'][] = 'El usuario ingresado no ha sido confirmado';
                return self::$alert;
            }
        }
        return self::$alert;
    }

    public function validateChangePassword() : array{
        if(!$this->Contrasena){
            self::$alert['error'][] = 'La nueva contrasena es obligatoria';
        }else{
            if(strlen($this->Contrasena) < 8){
                self::$alert['error'][] = 'La nueva contrasena debe tener al menos 8 caracteres';
            }
        }
        return self::$alert;
    }

    public function hashPassword(){
        $this->Contrasena = password_hash($this->Contrasena, PASSWORD_BCRYPT);
    }

    public function generateToken(){
        $this->Token = uniqid();
    }


}

