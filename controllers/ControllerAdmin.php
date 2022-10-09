<?php

namespace Controller;

use Model\AdminCitas;
use MVC\Router;

class ControllerAdmin
{
    public static function index(Router $router){

        session_start();
        isAdmin();
        $fechaActual = date('Y-m-d');
        if(!empty($_GET)){
            debug($_GET);
        }

        $fecha = $_GET['fecha'] ?? date('Y-m-d', strtotime($fechaActual . '- 1 days'));
        $fechaSeparada = explode('-', $fecha);

        if(!checkdate($fechaSeparada[1], $fechaSeparada[2], $fechaSeparada[0])){
            $fecha = date('Y-m-d', strtotime($fechaActual . '- 1 days'));
        }

        $consult = "select c.ID, c.Hora, concat(u.Nombre, ' ', u.Apellido) as 'Cliente', ";
        $consult .= " u.Correo, u.Telefono, s.Nombre as 'Servicio', s.Precio ";
        $consult .= " FROM citaservicios as cs  ";
        $consult .= " INNER JOIN citas as c ";
        $consult .= " ON c.ID = cs.CitaID ";
        $consult .= " INNER JOIN usuario as u ";
        $consult .= " ON u.ID = c.UsuarioID ";
        $consult .= " INNER JOIN servicio as s  ";
        $consult .= " ON cs.ServicioID = s.ID ";
        $consult .= " WHERE c.fecha =  '${fecha}' ";

        $Citas = AdminCitas::SQL($consult);

        $router->render('/admin/index', [
                'Nombre' => $_SESSION['Nombre'],
                'Citas' =>$Citas,
                'Fecha' =>$fecha
        ]);
    }
}