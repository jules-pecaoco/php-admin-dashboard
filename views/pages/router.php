<?php
$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
$root = $_SESSION['root'];

$routes = [
  "/$root/home/dashboard" => "page/dashboard.php",
  "/$root/home/admin" => "page/admin.php",
  "/$root/home/tables" => "page/tables.php",
  "/$root/home/tables/edit" => "page/edituser.php",
  "/$root/home/tables/delete" => "page/tables.php",

];


function routeToInclude($uri, $routes) {
  if (array_key_exists($uri, $routes)) {
    include $routes[$uri];
  } else {
    http_response_code(404);
    abort(404);
  }
}


routeToInclude($uri, $routes);
