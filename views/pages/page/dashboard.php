<h1 class="username">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>

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