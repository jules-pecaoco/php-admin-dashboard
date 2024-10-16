<?php
session_start();
if (!isset($_SESSION['is_logged_in'])) {
    $_SESSION['is_logged_in'] = false;
}
?>

<?php
$uri = rtrim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
$_SESSION['root'] = explode("\\", __DIR__)[3];
$root = $_SESSION['root'];

// Routes that map to specific files
$routes = [
    "/$root" => "views/index.php",
    "/$root/register" => "views/index.php",
    "/$root/logout" => "views/index.php", // Add a logout route
];



// Function to handle error responses
function abort($code) {
    http_response_code($code);
    include "views/errors/$code.php";
    die();
}


// Function to handle routing
function routeToController($uri, $routes) {
    $pages = ['dashboard', 'admin', 'tables', 'edit', 'delete'];
    $baseurl = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (array_key_exists($uri, $routes)) {
        include $routes[$uri];
    } elseif (in_array($baseurl, $pages)) {
        if ($_SESSION['is_logged_in'] === false) {
            header("Location: /$root/");
            exit;
        }
        include "views/index.php";
    } else {
        abort(404);
    }
}

function dd($data) {
    echo "<script>console.log('$data')</script>";
    die();
}

routeToController($uri, $routes);
