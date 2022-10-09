<?php

namespace Controller;

use MVC\Router;

class ControllerCitas{

    public static function index(Router $router){
        session_start();

        isAuth();

        $router->render('/cita/index', [
            'Nombre' => $_SESSION['Nombre'],
            'ID' => $_SESSION['ID']
        ]);
    }

}