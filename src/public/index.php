<?php

declare(strict_types=1);

define("VIEW_PATH", __DIR__ . "/../views");

date_default_timezone_set("America/Bogota");

//include_once "/var/www/html/vendor/vlucas/phpdotenv/src";
require '../vendor/autoload.php';

use App\App;
use App\View;
use App\Router;
use App\Config;
use App\Controllers\actividadesController;
use App\Controllers\homeController;
use App\Controllers\loginController;
use App\Controllers\registerController;
use App\Controllers\dashboardController;
use App\Controllers\apiController;
use App\Controllers\formController;
use App\Controllers\visualizacionController;
use App\Controllers\mensajesController;
use App\Controllers\gastosController;
use App\Controllers\categoriasController;

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

session_start();
//echo($_ENV["BASE_URL"]) ;
$home=$_ENV["BASE_URL"]."/";
//echo $home;
//$home=(new View("Home"))->render();
$router = new Router();

$router->register("GET", "/", [homeController::class, "index"]);
$router->register("GET", "/login", [loginController::class, "index"]);
$router->register("GET", "/register", [registerController::class, "index"]);
$router->register("GET", "/dashboard", [dashboardController::class, "index"]);
$router->register("GET", "/visualizacion", [visualizacionController::class, "index"]);
$router->register("GET", "/actividades", [actividadesController::class, "index"]);
$router->register("GET", "/mensajes", [mensajesController::class, "index"]);
$router->register("GET", "/mensaje", [mensajesController::class, "getMessage"]);
$router->register("GET", "/api", [apiController::class, "getUsers"]);
$router->register("GET", "/api/user", [apiController::class, "getUser"]);
$router->register("GET", "/api/logout", [apiController::class, "logout"]);
$router->register("GET", "/actividades", [actividadesController::class, "index"]);
$router->register("GET", "/gastos", [gastosController::class, "index"]);
$router->register("POST", "/delete-gasto", [gastosController::class, "deleteGasto"]);
$router->register("GET", "/categorias", [categoriasController::class, "getCategorias"]);

$router->register("POST", "/login_user", [loginController::class, "loginUser"]);
$router->register("POST", "/register_user", [registerController::class, "registerUser"]);
$router->register("POST", "/enviar_camas", [apiController::class, "postCama"]);
$router->register("POST", "/actualizar_camas", [apiController::class, "editCama"]); 
$router->register("POST", "/submit-contact-form", [formController::class, "submitContactForm"]);
$router->register("POST", "/submit-actividad", [actividadesController::class, "submitActividad"]);
$router->register("POST", "/submit-gasto", [gastosController::class, "submitGasto"]);
$router->register("POST", "/edit-gasto", [gastosController::class, "editGasto"]);
$router->register("POST", "/delete-categoria", [categoriasController::class, "deleteCategoria"]);
$router->register("POST", "/delete-actividad", [actividadesController::class, "deleteActividad"]);
$router->register("POST", "/edit-estado-actividad", [actividadesController::class, "editEstadoActividad"]);
$router->register("POST", "/post-categoria", [categoriasController::class, "submitCategoria"]);



$config= new Config($_ENV);
$app = (new App($router, $config))->run();


/*
echo "<pre>";
print_r($router->getRoutes()) ;
echo "</pre>";
*/
