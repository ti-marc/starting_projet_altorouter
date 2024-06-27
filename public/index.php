<?php

use App\Services\Router;

require_once dirname(__DIR__). DIRECTORY_SEPARATOR."vendor". DIRECTORY_SEPARATOR. "autoload.php";
define("PATH_VIEWS",dirname(__DIR__).DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR);
$route = new Router(PATH_VIEWS);
$route->map("GET|POST","/","login");
$route->map("GET|POST","/dashboard","dashboard");
$route->map("GET|POST","/static","static");
$route->run();