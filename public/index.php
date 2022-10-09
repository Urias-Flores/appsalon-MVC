<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controller\ControllerLogin;
use Controller\ControllerPages;
use Controller\ControllerCitas;
use Controller\ControllerAPI;
use Controller\ControllerAdmin;
use Controller\ControllerServicio;

$router = new Router();

//to login and logout
$router->get('/', [ControllerLogin::class, 'login']);
$router->post('/', [ControllerLogin::class, 'login']);
$router->get('/logout', [ControllerLogin::class, 'logout']);

//to reset password
$router->get('/forgot', [ControllerLogin::class, 'forgot']);
$router->post('/forgot', [ControllerLogin::class, 'forgot']);
$router->get('/reset', [ControllerLogin::class, 'reset']);
$router->post('/reset', [ControllerLogin::class, 'reset']);

//to create account
$router->get('/create', [ControllerLogin::class, 'create']);
$router->post('/create', [ControllerLogin::class, 'create']);
$router->get('/confirm-account', [ControllerLogin::class, 'confirm']);
$router->get('/message', [ControllerLogin::class, 'message']);

//to private zone
$router->get('/cita', [ControllerCitas::class, 'index']);
$router->get('/admin', [ControllerAdmin::class, 'index']);

//to API
$router->get('/api/servicios', [ControllerAPI::class, 'index']);
$router->post('/api/citas', [ControllerAPI::class, 'save']);
$router->post('/api/delete', [ControllerAPI::class, 'delete']);

//CRUD of services
$router->get('/servicios', [ControllerServicio::class, 'index']);
$router->get('/servicios/crear', [ControllerServicio::class, 'create']);
$router->post('/servicios/crear', [ControllerServicio::class, 'create']);
$router->get('/servicios/actualizar', [ControllerServicio::class, 'update']);
$router->post('/servicios/actualizar', [ControllerServicio::class, 'update']);
$router->post('/servicios/eliminar', [ControllerServicio::class, 'delete']);

$router->comprobarRutas();