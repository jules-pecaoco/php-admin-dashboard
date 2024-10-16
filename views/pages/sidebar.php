<?php
function isActive($page) {
  $lastSegment = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  $table = isset($_GET['name']) ? $_GET['name'] : "";
  return $lastSegment === $page || $table === $page ? "active" : "";
}
?>

<div class="body__wrap">
  <nav class="sidebar">
    <h2 class="s__title">
      <img src="/<?php echo $root ?>/assets/images/dashboard.gif" alt="" />
      <p class="s__close" style="text-align: center;">Dashboard</p>
    </h2>
    <hr class="s__division" />
    <div class="s__menus">
      <button class="m__btn load-content <?php echo isActive('dashboard') ?>" onclick="location.href='/<?php echo $root ?>/home/dashboard'">
        <i class="m__icon fa-solid fa-shop fa-fw"></i>
        <p class="m__text s__close">Dashboard</p>
      </button>
      <div>
        <div class="dropdown__toggle">
          <button class="m__btn load-content  <?php echo isActive('tables') ?>" onclick="location.href='/<?php echo $root ?>/home/tables?name=profiles'">
            <i class="m__icon fa-solid fa-book-open-reader fa-fw"></i>
            <p class="m__text s__close a">Tables</p>
          </button>
          <i class="fa-solid fa-chevron-down s__close"></i>
        </div>
        <div class="dropdown__content">
          <div class="content__wrap">
            <button class="m__btn load-content <?php echo isActive('profiles') ?>" onclick="location.href='/<?php echo $root ?>/home/tables?name=profiles'">User Profiles</button>
            <button class="m__btn load-content <?php echo isActive('accounts') ?>" onclick="location.href='/<?php echo $root ?>/home/tables?name=accounts'">User Accounts</button>
          </div>
        </div>
      </div>
    </div>
    <div class="s__division">ACCOUNT PAGES</div>
    <div class="s__menus">
      <a class="m__btn load-content <?php echo isActive('admin') ?>" href="/<?php echo $root ?>/home/admin">
        <i class="m__icon fa-solid fa-user-tie fa-fw"></i>
        <p class="m__text s__close">Admin</p>
      </a>
      <a href="/<?php echo $root ?>/logout" class="m__btn">
        <i class="m__icon fa-solid fa-right-from-bracket fa-fw" style="rotate: 180deg;"></i>
        <p class="m__text s__close">Log Out</p>
      </a>
    </div>
    <hr class="s__division" />
    <i class="fa-solid fa-circle-arrow-left close m__icon"></i>
  </nav>

  <?php
  if (isActive('tables') === "active") {
    echo
    "<script>
              document.addEventListener('DOMContentLoaded', function() {
                dropDown();
              });
            </script>";
  }
  ?>

  <script>
    // TABLES STYLES AND ANIMATIONS
    const dropdown = document.querySelectorAll(".dropdown__toggle");
    const dropdownContent = document.querySelectorAll(".dropdown__content");
    const sidebar = document.querySelector(".sidebar");
    const close = document.querySelector(".close");
    const s__close = document.querySelectorAll(".s__close");
    const s__menu = document.querySelector(".s__menus");
    const chevrondown = document.querySelectorAll(".fa-chevron-down");

    document.addEventListener('DOMContentLoaded', function() {
      <?php if (isActive('tables') === "active"): ?>
        dropDown();
      <?php endif; ?>
    });

    dropdown.forEach((d, i) => {
      d.addEventListener("click", () => {
        dropDown();
      });
    });

    function dropDown() {
      dropdown.forEach((d, i) => {
        if (dropdownContent[i].style.display === "none") {
          dropdownContent[i].style.display = "block";
          chevrondown[i].style.transform = "rotate(180deg)";
        } else {
          dropdownContent[i].style.display = "none";
          chevrondown[i].style.transform = "rotate(0)";
        }
      });
    }


    close.addEventListener("click", (e) => {
      if (sidebar.style.width === "100px") {
        s__close.forEach((s) => {
          s.style.display = "block";
        });

        sidebar.style.width = "300px";
        close.style.transform = "rotate(0deg)";

        s__menu.style.alignItems = "start";
      } else {
        dropdownContent.forEach((d) => {
          d.style.display = "none";
        });

        close.style.transform = "rotate(180deg)";

        sidebar.style.width = "100px";
        s__menu.style.alignItems = "center  ";

        s__close.forEach((s) => {
          s.style.display = "none";
        });
      }
    });
  </script>