<div class="wrap">
  <div class="header">
    <form onsubmit="searchRow()">
      <input type="text" id="search" placeholder="Search" class="f__input" />
      <select name="category" class="f__select">
        <option value="" disabled selected hidden>Search by</option>
        <?php

        if (isset($_GET['name'])) {
          if ($_GET['name'] == 'profiles') { ?>
            <option value="First Name">First Name</option>
            <option value="Last Name">Last Name</option>
            <option value="Email">Email</option>
          <?php
          } else { ?>
            <option value="Username">Username</option>
            <option value="Role">Role</option>
        <?php
          }
        }
        ?>
        <option value="">All</option>
      </select>
      <button onclick="searchRow()" class="f__btn">Search</button>
    </form>
    <div class="table__title">
      <h1>USER ACCOUNTS</h1>
      <button class="f__btn fa-add fa-fw fa-solid m__icon open-form"></button>
    </div>
  </div>
  <div class="table">
    <table id="htmlTable">
      <thead>
        <?php
        $root = $_SESSION['root'];

        if (isset($_GET['name'])) {
          if ($_GET['name'] == 'profiles') { ?>
            <tr>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Action</th>
            </tr>
          <?php
          } else { ?>
            <tr>
              <th>Username</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
        <?php
          }
        }
        ?>
      </thead>
      <tbody>
        <?php
        $data = new dataController();

        if (isset($_GET['name'])) {
          foreach ($data->fetchTableData() as $row) {
            if ($_GET['name'] == 'profiles') { ?>
              <tr>
                <td class='t__td'><?= $row['first_name'] ?></td>
                <td class='t__td'><?= $row['last_name'] ?></td>
                <td class='t__td'><?= $row['email'] ?></td>
                <td class='t__td action'>
                  <a class="action__icon" href="/<?php echo $root ?>/home/tables/edit?name=profiles&profile_id=<?php echo urlencode($row['profile_id']); ?>">
                    <i class="fa-pencil fa-solid fa-fw m__icon"></i>
                  </a>
                  <a class="action__icon" href="/<?php echo $root ?>/home/tables/delete?name=profiles&profile_id=<?php echo urlencode($row['profile_id']); ?>">
                    <i class="fa-trash fa-solid fa-fw m__icon danger"></i>
                  </a>
                </td>
              </tr>

            <?php
            } else { ?>
              <tr>
                <td class='t__td'><?= $row['username'] ?></td>
                <td class='t__td'>
                  <?php
                  if ($row['is_admin'] == 1) {
                    echo "Admin";
                  } else {
                    echo "View";
                  }
                  ?>
                </td>
                <td class='t__td action'>
                  <a href="/<?php echo $root ?>/home/tables/edit?name=accounts&account_id=<?php echo urlencode($row['account_id']); ?>" class="action__icon">
                    <i class="fa-pencil fa-solid fa-fw m__icon"></i>
                  </a>
                  <a href="/<?php echo $root ?>/home/tables/delete?name=accounts&account_id=<?php echo urlencode($row['account_id']); ?>" class="action__icon">
                    <i class="fa-trash fa-solid fa-fw m__icon danger"></i>
                  </a>
                </td>
              </tr>
        <?php
            }
          }
        }
        ?>
      </tbody>
    </table>
  </div>
</div>

<?php
$lastSegment = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
if ($lastSegment === 'delete') {
  if (isset($_GET['name'])) {
    $data = new userController();
    $data->deleteData();
  }
}
?>

<script>
  function searchRow() {
    event.preventDefault();

    const searchQuery = document.getElementById("search").value.toLowerCase();
    const category = document.querySelector(".f__select").value;

    const rows = document.querySelectorAll("#htmlTable tbody tr");

    rows.forEach((row) => {
      let match = false;

      if (!category || category === "All") {
        row.querySelectorAll("td").forEach((cell) => {
          if (cell.textContent.toLowerCase().includes(searchQuery)) {
            match = true;
          }
        });
      } else {
        const cells = row.querySelectorAll("td");
        const headers = document.querySelectorAll("#htmlTable thead th");
        headers.forEach((header, index) => {
          if (header.textContent === category) {
            if (cells[index].textContent.toLowerCase().includes(searchQuery)) {
              match = true;
            }
          }
        });
      }

      // Show/Hide the row based on the match
      if (match) {
        row.style.display = "";
      } else {
        row.style.display = "none";
      }
    });
  }
</script>