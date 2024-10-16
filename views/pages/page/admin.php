<!-- ADD DATA -->
<dialog class="form">
  <form class="form__add" action="/home/admin/add" method="post">
    <div class="form__title">Add Data</div>
    <input type="text" class="form__input" name="username" placeholder="Username">
    <input type="password" class="form__input" name="password" placeholder="Password">
    <select name="role" class="f__select">
      <option value="" disabled selected hidden>Select Role</option>
      <option value="">Admin</option>
      <option value="">View</option>
    </select>

    <button class="btn f__btn submit-form" type="submit">+ Add</button>
    <button class="btn f__btn close-form">x Close</button>
  </form>
</dialog>

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

  openBtn = document.querySelector(".open-form");
  closeBtn = document.querySelector(".close-form");
  modal = document.querySelector(".form");
  form = document.querySelector("#formData");


  openBtn.addEventListener("click", function() {
    modal.showModal();
  });

  closeBtn.addEventListener("click", function() {
    modal.close();
  });

  function editRow(button) {
    const table = 'Admin'

    var row = button.parentNode.parentNode;
    var cells = row.getElementsByTagName("td");
    for (var i = 1; i < cells.length - 1; i++) {
      cells[i].contentEditable = cells[i].contentEditable === "true" ? "false" : "true";
    }

    // UPDATE THE DATABASE
    if (button.textContent === "Save") {
      var data = [];
      for (var i = 0; i < cells.length - 1; i++) {
        data.push(cells[i].textContent.trim());
      }

      const url = `/home/admin/update`;

      fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        })
        .then((response) => response.text())
        .then((html) => {
          const contentElement = document.getElementById("content");
          contentElement.innerHTML = html;

          const scripts = contentElement.querySelectorAll("script");
          scripts.forEach((script) => {
            const newScript = document.createElement("script");
            newScript.textContent = script.textContent;
            document.body.appendChild(newScript);
            document.body.removeChild(newScript);
          });
          history.pushState(null, "", url); // Update the URL
        })
        .catch((error) => {
          alert("Server error!");
        });
    }

    button.textContent = button.textContent === "Edit" ? "Save" : "Edit";
    button.style.backgroundColor = button.style.backgroundColor === "green" ? "var(--color-gray-light)" : "green";
  }

  function deleteRow(button) {
    const table = 'Admin'

    if (button.textContent === "Confirm") {
      // NEEDS IMPROVEMENT
      var row = button.parentNode.parentNode;
      var cells = row.getElementsByTagName("td");
      var data = cells[0].textContent.trim();

      const url = `/home/table/delete`;

      fetch(url, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(data),
        })
        .then((response) => response.text())
        .then((html) => {
          const contentElement = document.getElementById("content");
          contentElement.innerHTML = html;

          const scripts = contentElement.querySelectorAll("script");
          scripts.forEach((script) => {
            const newScript = document.createElement("script");
            newScript.textContent = script.textContent;
            document.body.appendChild(newScript);
            document.body.removeChild(newScript);
          });
          history.pushState(null, "", url); // Update the URL
        })
        .catch((error) => {
          alert("Server error!");
        });
    }

    // UPDATE THE STYLING BUTTON
    button.textContent = button.textContent === "Delete" ? "Confirm" : "Delete";
    button.style.backgroundColor = button.style.backgroundColor === "red" ? "var(--color-gray-light)" : "red";
  }
</script>