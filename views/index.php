<!DOCTYPE html>
<html lang="en">

<head>
  <?php $root = $_SESSION['root'];
  ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo getTitle() != "$root" ? ucfirst(getTitle()) : "Login" ?></title>

  <!-- TAILWIND -->
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->

  <!-- FONTAWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


  <!-- ALERT JS -->
  <script src="assets/js/alert.js" defer></script>

  <!-- SWEET ALERT -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- <script src="sweetalert2.all.min.js"></script> -->


</head>

<body>
  <?php
  include "router.php";
  ?>
</body>

</html>

<?php
function getTitle() {
  // Get the URI path
  $uri = rtrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

  $segments = explode('/', $uri);

  return end($segments);
}
?>