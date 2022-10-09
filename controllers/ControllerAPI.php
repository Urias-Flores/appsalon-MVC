<?php

namespace Controller;

use Model\CitaServicio;
use Model\Servicio;
use Model\Cita;

class ControllerAPI{

    public static function index(){
        $Servicio = Servicio::all();
        echo json_encode($Servicio);
    }

    public static function save(){
        $Cita = new Cita($_POST);
        $Answer = $Cita->save();

        $idServicios = explode(',', $_POST['Servicios']);

        foreach ( $idServicios as $idServicio){
            $args = [
                'CitaID' => $Answer['ID'],
                'ServicioID' => $idServicio
            ];

            $CitaServicio = new CitaServicio($args);
            $result = $CitaServicio->save();
        }
        echo json_encode($Answer);
    }

    public static function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $ID = $_POST['ID'];
            $Cita = Cita::find($ID);
            $Result = $Cita->delete();

            if($Result){
                header('location: ' . $_SERVER['HTTP_REFERER']);
            }
        }
    }
}