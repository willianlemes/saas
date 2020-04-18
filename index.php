<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

/**
 * BOOTSTRAP
 */

use CoffeeCode\Router\Router;
use Source\Core\Session;

$session = new Session();
$route = new Router(url(), ":");
$route->namespace("Source\App");

//auth
$route->group(null);
$route->get("/", "Web:login");
$route->post("/entrar", "Web:login");
$route->get("/cadastrar", "Web:register");
$route->post("/cadastrar", "Web:register");
$route->get("/recuperar", "Web:forget");
$route->post("/recuperar", "Web:forget");
$route->get("/recuperar/{code}", "Web:reset");
$route->post("/recuperar/resetar", "Web:reset");

//optin
$route->group(null);
$route->get("/confirma", "Web:confirm");
$route->get("/obrigado/{email}", "Web:success");

/**
 * SERVICE
 */
$route->group(null);
$route->get("/termos", "Web:terms");

/**
 * APP
 */
$route->group("/app");
$route->get("/perfil", "App:profile");
$route->get("/sair", "App:logout");
$route->post("/support", "App:support");
$route->post("/filter", "App:filter");
$route->post("/profile", "App:profile");

/**
 * REALTY
 */
 $route->group("/imoveis");
 $route->get("/", "RealtyController:index");
 $route->get("/{finality}/{kind}", "RealtyController:index");
 $route->get("/p/{page}", "RealtyController:index");
 $route->get("/cadastrar", "RealtyController:registrationForm");
 $route->get("/alterar/{id}", "RealtyController:registrationForm");
 $route->post("/salvar", "RealtyController:save");
 $route->get("/proprietarios/{term}", "RealtyController:proprietary");
 $route->post("/filter", "RealtyController:filter");

 /**
 * PERSON
 */
 $route->group("/pessoas");
 $route->get("/", "PersonController:index");
 $route->get("/p/{page}", "PersonController:index");
 $route->get("/cadastrar", "PersonController:registrationForm");
 $route->get("/alterar/{id}", "PersonController:registrationForm");
 $route->post("/salvar", "PersonController:save");

 /**
 * BUSINESS
 */
 $route->group("/negocios");
 $route->get("/", "BusinessController:index");
 $route->get("/cadastrar", "BusinessController:registrationForm");
 $route->get("/alterar/{id}", "BusinessController:registrationForm");
 $route->post("/salvar", "BusinessController:save");
 $route->get("/p/{page}", "BusinessController:index");

/**
 * ERROR ROUTES
 */
$route->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();

/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();
