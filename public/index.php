<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\ApiController;
use Controllers\AppointmentController;
use MVC\Router;
use Controllers\LoginController;

$router = new Router();

$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/forgot-password', [LoginController::class, 'forgotPassword']);
$router->post('/forgot-password', [LoginController::class, 'forgotPassword']);

$router->get('/recover-password', [LoginController::class, 'recoverPassword']);
$router->post('/recover-password', [LoginController::class, 'recoverPassword']);

$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);
$router->get('/verify-account', [LoginController::class, 'verify']);
$router->get('/message', [LoginController::class, 'message']);


$router->get('/appointment', [AppointmentController::class, 'index']);

$router->get('/api/services', [ApiController::class, 'index']);
$router->post('/api/appointments', [ApiController::class, 'saveAppointment']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();