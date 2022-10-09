<?php

namespace Controller;

use Model\Usuario;
use MVC\Router;
use Classes\Email;

class ControllerLogin{

    public static function login(Router $router){
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $Usuario = new Usuario($_POST);
            $alerts = $Usuario->validateLogin();

            if(empty($alerts)){
                $ActualUser = Usuario::where('Correo', $Usuario->Correo);
                session_start();
                $_SESSION['login'] = true;
                $_SESSION['ID'] = $ActualUser->ID;
                $_SESSION['Nombre'] = $ActualUser->Nombre . ' ' . $ActualUser->Apellido;
                $_SESSION['Correo'] = $ActualUser->Correo;
                if($ActualUser->Admin === "1"){
                    $_SESSION['Admin'] = true;
                    header('location: /admin');
                }else{
                    $_SESSION['Admin'] = false;
                    header('location: /cita');
                }
            }
        }
        $alerts = Usuario::getAlert();
        $router->render('auth/login', [
            'alerts' => $alerts
        ]);
    }

    public static function logout(Router $router){
        session_start();
        $_SESSION = [];
        header('location: /');
    }

    public static function forgot(Router $router){
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $Usuario = new Usuario($_POST);
            $alerts = $Usuario->validateResetPassword();

            if(empty($alerts)){
                $Correo = $Usuario->Correo;
                unset($Usuario);
                $Usuario = Usuario::where('Correo', $Correo);
                $Usuario->generateToken();
                $result = $Usuario->save();

                if($result){
                    $Correo = new Email($Usuario->Correo, $Usuario->Nombre . ' ' . $Usuario->Apellido, $Usuario->Token);
                    $sendConfirm = $Correo->sendEmail(Email::$RESET_PASSWORD_EMAIL);
                    unset($Usuario);
                    if($sendConfirm){
                        $alerts['succes'][] = 'El correo con las instrucciones para reestablecer tu contrasena ah sido enviado';
                    }else{
                        $alerts['error'][] = 'Ah ocurrido un error al enviar correo de reestablecimiento de cuenta';
                    }
                }
            }
        }

        $router->render('/auth/forgot-password', [
            'alerts' => $alerts
        ]);
    }

    public static function reset(Router $router){
        $alerts = [];
        $error = false;
        $Token = sanitizeHTML($_GET['token']);
        $Usuario = Usuario::where('Token', $Token);
        if(!$Usuario){
            $alerts['error'][] = 'Token no valido';
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] ===  'POST'){
            $newUsuario = new Usuario($_POST);
            $alerts = $newUsuario->validateChangePassword();

            if(empty($alerts)){
                $Usuario->Contrasena = $newUsuario->Contrasena;
                $Usuario->hashPassword();
                $Usuario->Token = null;
                $result = $Usuario->save();

                if($result){
                    header('location: /');
                }else{
                    $alerts['error'][] = 'Ah ocurrido un error inesperado';
                }
            }
        }

        $router->render('/auth/reset-password', [
            'alerts' => $alerts,
            'error' => $error
        ]);
    }

    public static function create(Router $router){
        $Usuario = new Usuario();
        $alerts = [];

        if($_SERVER['REQUEST_METHOD'] === "POST"){
            $Usuario->sync($_POST);
            $alerts = $Usuario->validateNewAccount();

            if (empty($alerts)){
                $alerts['succes'][] = 'El usuario a sido registrado';
                $Usuario->hashPassword();
                $Usuario->generateToken();
                $Correo = new Email($Usuario->Correo, $Usuario->Nombre, $Usuario->Token);
                $result = $Correo->sendEmail(Email::$CONFIRMATION_EMAIL);
                if($result) {

                    $save = $Usuario->save();
                    if($save){
                        header('location: /message');
                    }else{
                        $alerts[error][] = 'Ah ocurrido un error inesperado, usuario no almacenado';
                    }

                }else{
                    $alerts[error][] = 'Ah ocurrido un error inesperado';
                }
            }
        }
        $router->render('/auth/create-account', [
            'Usuario' => $Usuario,
            'alerts' => $alerts
        ]);
    }

    public static function message(Router $router){
        $router->render('/auth/message');
    }

    public static function confirm(Router $router){
        $alerts = [];
        $token = sanitizeHTML($_GET['token']);
        $Usuario = Usuario::where('token', $token);

        if(empty($Usuario)){
            Usuario::setAlerta('error', 'Token no valido');
        }else{
            $Usuario->Confirmado = '1';
            $Usuario->Token = null;
            $Result = $Usuario->save();
            if($Result){
                Usuario::setAlerta('succes', 'El usuario ha sido confirmado exitosamente');
            }else{
                Usuario::setAlerta('error', 'Hubo un error al confirmar el usuario');
            }
        }
        $alerts = Usuario::getAlert();
        $router->render('/auth/confirm-account', [
            'alerts' => $alerts
        ]);
    }
}
