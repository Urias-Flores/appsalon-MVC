<?php

namespace Controller;

use Model\Servicio;
use MVC\Router;

class ControllerServicio
{
    public static function index(Router $router){
        isAdmin();
        $servicios = Servicio::all();
        $router->render('/servicios/index', [
            'Servicios' => $servicios,
            'Nombre' => $_SESSION['Nombre']
        ]);
    }

    public static function create(Router $router){
        isAdmin();
        $Servicio = new Servicio;
        $alerts = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $Servicio->sync($_POST);
            $alerts = $Servicio->validate();
            if(empty($alerts)){
                $result = $Servicio->save();
                if($result){
                    header('location: /servicios');
                }else{
                    $alerts['error'][] = 'Ops... ha ocurrido un error inesperado';
                }
            }
        }

        $router->render('/servicios/crear', [
            'Nombre' => $_SESSION['Nombre'],
            'Servicio' => $Servicio,
            'alerts' => $alerts
        ]);
    }

    public static function update(Router $router){
        isAdmin();
        $ID = $_GET['id'];
        $alerts = [];

        if(!$ID || !is_numeric($ID)){
            header('location: /servicios');
        }
        $Servicio = Servicio::find($ID);

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $Servicio->sync($_POST);
            $alerts = $Servicio->validate();

            if(empty($alerts)){
                $result = $Servicio->save();
                if($result){
                    header('location: /servicios');
                }else {
                    echo 'Ops... Ha ocurrido un error inesperado';
                }
            }
        }

        $router->render('/servicios/actualizar', [
            'Nombre' => $_SESSION['Nombre'],
            'Servicio' => $Servicio,
            'alerts' => $alerts
        ]);
    }

    public static function delete(Router $router){
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $Servicio = new Servicio($_POST);
            $result = $Servicio->delete();

            if($result){
                header('location: /servicios');
            }else{
                echo 'Ops... Ha ocurrido un error inesperado';
            }
        }
    }
}