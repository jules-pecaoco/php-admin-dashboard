<?php
$data = [];
if (isset($_GET['name'])) {
  $id = $_GET['name'] === 'profiles' ? $_GET['profile_id'] : $_GET['account_id'];;
  $data = (new dataController())->fetchSingleData($id);
}
?>



<?php
if (isset($_GET['name'])) {
  if ($_GET['name'] === 'accounts') { ?>
    <div class="wrap update__form">
      <h2 class="form__title">Update Accounts Information</h2>

      <form class="form" method="post">

        <div class="form__inputs">
          <div class="input__">
            <label for="username">Username</label>
            <input type="text" value="<?php echo $data['username'] ?>" name="username" required>
          </div>

          <div class="input__">
            <label for="role">Role</label>
            <select name="role" id="">
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
          <div class="input__" id="danger">
            <label for="username">Change Password</label>
            <input type="password" name="password">
          </div>

        </div>

        <div class="button__">
          <button type="submit" class="m__btn">
            Update Account
          </button>
          <button class="m__btn" type="button" onclick="location.href='/<?php echo $root ?>/home/tables?name=accounts'">
            Back
          </button>
        </div>
      </form>
    </div>
  <?php
  } else { ?>
    <div class="wrap update__form">
      <h2 class="form__title">Update User Information</h2>

      <form class="form" method="post">

        <div class="form__inputs">
          <div class="input__">
            <label for="username">First Name</label>
            <input type="text" value="<?php echo $data['first_name'] ?>" name="firstName" required>
          </div>

          <div class="input__">
            <label for="lastname">Last Name</label>
            <input type="text" value="<?php echo $data['last_name'] ?>" name="lastName" required>
          </div>

          <div class="input__">
            <label for="username">Email</label>
            <input type="email" value="<?php echo $data['email'] ?>" name="email" required>
          </div>
        </div>

        <div class="button__">
          <button type="submit" class="m__btn">
            Update User
          </button>
          <button class="m__btn" type="button" onclick="location.href='/<?php echo $root ?>/home/tables?name=profiles'">
            Back
          </button>
        </div>
      </form>
    </div>
<?php
  }
}
?>

<?php
$userController = new userController();
$userController->updateData();
?>
<style>
  .update__form {
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
  }

  .update__form .form__title {
    width: 100%;
    font-size: 2rem;
    font-weight: bolder;
    margin-bottom: 1rem;
    text-align: right;
  }

  .update__form .form {
    width: 100%;
    display: flex;
    flex-direction: column;
    background-color: var(--color-white);
    gap: 1rem;
    border-radius: 0.3rem;
    box-shadow: var(--sidebar-box-shadow);
    padding: 1rem;

  }

  .update__form #danger {
    color: red;
  }

  .update__form .form__inputs {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 2rem;
  }

  .update__form .input__ {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    width: 50%;
  }



  .update__form form>* {
    box-shadow: none;
  }

  .update__form label {
    font-weight: bolder;
    font-size: 1.5rem;
  }


  .update__form input,
  .update__form select {
    border-radius: 0.2rem;
    padding: 0.5rem;
    border: 0.5px gray solid;
  }

  .update__form .disable {
    border: 0.5px lightgray solid !important;
  }

  .update__form input:focus {
    border: 1px green solid;
  }

  .update__form .button__ {
    padding: 0;
    display: flex;
    justify-content: flex-end;
  }

  .update__form button {
    padding: 0.5rem 0.8rem;
    border-radius: 0.3rem;
    justify-self: flex-end;
    align-self: flex-end;
    width: fit-content;
    box-shadow: var(--sidebar-box-shadow);
    margin-inline: 1rem;
  }

  .update__form button:hover {
    background-color: var(--color-pink);
    color: var(--color-white);
  }
</style>