<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{

    public $Correo;
    public $Nombre;
    public $Token;
    public static $CONFIRMATION_EMAIL = 1;
    public static $RESET_PASSWORD_EMAIL = 2;

    public function __construct($Correo, $Nombre, $Token)
    {
        $this->Correo = $Correo;
        $this->Nombre = $Nombre;
        $this->Token = $Token;
    }

    public function sendEmail(int $type){
        $phpmailer = new PHPMailer();
        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp.mailtrap.io';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 2525;
        $phpmailer->Username = '80b83a71742a04';
        $phpmailer->Password = 'cf044861cb36b7';
        $phpmailer->isHTML(true);
        $phpmailer->CharSet = 'UTF-8';

        $phpmailer->setFrom('osoriourias@gmail.com');
        $phpmailer->addAddress('osoriourias@gmail.com');

        $message = '';
        switch ($type){
            case 1:
                $phpmailer->Subject = 'Confirma tu cuente de appsalon';
                $message = "<html>";
                $message .= "<p>Hola <strong>".$this->Nombre."</strong> confirma tu cuenta de appsalon.</p>";
                $message .= "<p>Confirma tu cuenta dando link en el siguiente enlace: </p>";
                $message .= "<p><strong><a href='http://localhost:3000/confirm-account?token=".$this->Token."'>Click aqui.</a></strong></p>";
                $message .= "<html>";
                break;
            case 2:
                $phpmailer->Subject = 'Reestablece tu cuente de appsalon';
                $message = "<html>";
                $message .= "<p>Hola <strong>".$this->Nombre."</strong> reestablece tu cuenta de appsalon.</p>";
                $message .= "<p>Reestablece tu cuenta dando click en el siguiente enlace: </p>";
                $message .= "<p><strong><a href='http://localhost:3000/reset?token=".$this->Token."'>Click aqui.</a></strong></p>";
                $message .= "<html>";
                break;
            default:
                $phpmailer->Subject = 'ERRRO EN EL ENVIO';
                $message = 'ERROR';
                break;
        }

        $phpmailer->Body = $message;
        $result = $phpmailer->send();
        unset($phpmailer);

        return $result;
    }
}