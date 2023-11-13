<?php
require_once 'config.php';
require_once 'libs/router.php';
require_once 'app/controllers/cervezas.api.controller.php';
require_once 'app/controllers/user.api.controller.php';
require_once 'app/controllers/estilos.api.controller.php';
require_once 'app/controllers/comentarios.api.controller.php';

$router = new Router();


$router->addRoute('cervezas',                 'GET',    'CervezasApiController', 'getCervezas');
$router->addRoute('cervezas',                 'POST',   'CervezasApiController', 'create');
$router->addRoute('cervezas/:ID',             'GET',    'CervezasApiController', 'getCerveza');
$router->addRoute('cervezas/:ID',             'PUT',    'CervezasApiController', 'update');
$router->addRoute('cervezas/:ID',             'DELETE', 'CervezasApiController', 'delete');
$router->addRoute('cervezas/:ID/:subrecurso', 'GET',    'CervezasApiController', 'getCerveza');

$router->addRoute('estilos',     'GET',    'EstilosApiController', 'get');
$router->addRoute('estilos',     'POST',   'EstilosApiController', 'create');
$router->addRoute('estilos/:ID', 'GET',    'EstilosApiController', 'get');
$router->addRoute('estilos/:ID', 'PUT',    'EstilosApiController', 'update');
$router->addRoute('estilos/:ID', 'DELETE', 'EstilosApiController', 'delete');

$router->addRoute('comentarios',                'GET',    'ComentariosApiController', 'get');
$router->addRoute('comentarios',                'POST',   'ComentariosApiController', 'create');
$router->addRoute('comentarios/:ID',            'GET',    'ComentariosApiController', 'get');
$router->addRoute('comentarios/:ID',            'PUT',    'ComentariosApiController', 'update');
$router->addRoute('comentarios/:ID',            'DELETE', 'ComentariosApiController', 'delete');
$router->addRoute('comentarios/:ID/:subrecurso','GET',    'ComentariosApiController', 'get');

$router->addRoute('user/token', 'GET', 'UserApiController', 'getToken');

$router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
