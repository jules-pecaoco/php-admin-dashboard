  <!-- FONTAWESOME -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/solid.min.css"
    integrity="sha512-Hp+WwK4QdKZk9/W0ViDvLunYjFrGJmNDt6sCflZNkjgvNq9mY+0tMbd6tWMiAlcf1OQyqL4gn2rYp7UsfssZPA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- CSS -->
  <?php $root = $_SESSION['root']; ?>

  <link rel="stylesheet" href="/<?php echo $root ?>/assets/css/base.css" />
  <link rel="stylesheet" href="/<?php echo $root ?>/assets/css/components/tables.css" />
  <link rel="stylesheet" href="/<?php echo $root ?>/assets/css//components/dashboard.css" />



  <?php include 'sidebar.php' ?>

  <div id="content">
    <?php
    require_once "router.php";
    ?>
  </div>
  </div>

  <script>
    const active = document.querySelectorAll(".load-content");
    active.forEach((link) => {
      link.addEventListener("click", (e) => {
        active.forEach((b) => {
          b.classList.remove("active");
        });
        link.classList.add("active");
      });

    });
  </script>

  </html>