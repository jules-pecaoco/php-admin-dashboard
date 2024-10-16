<?php

$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
$root = $_SESSION['root'];
// Routes that map to specific files
$routes = [
  // AUTHENTICATION
  "/$root" => "views/auth/login.php",
  "/$root/register" => "views/auth/register.php",
  "/$root/logout" => "views/auth/logout.php",

  // HOME
  "/$root/home/dashboard" => "views/pages/home.php",
  "/$root/home/admin" => "views/pages/home.php",
  "/$root/home/tables" => "views/pages/home.php",
  "/$root/home/tables/edit" => "views/pages/home.php",
  "/$root/home/tables/delete" => "views/pages/home.php",
];



routeToController($uri, $routes);
