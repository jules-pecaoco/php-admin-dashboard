<?php
class userController extends Controller {

  private $root;

  public function __construct() {
    $this->root = $_SESSION['root'];
  }

  // CREATE USER CONTROLLER
  public function createUser() {
    if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["firstName"]) && isset($_POST["lastName"]) && isset($_POST["email"])) {
      $data = [
        "username" => $_POST["username"],
        "password" => $_POST["password"],
        "firstName" => $_POST["firstName"],
        "lastName" => $_POST["lastName"],
        "email" => $_POST["email"]
      ];

      $userProfile = $this->model('userProfile');
      $userAccount = $this->model('userAccount');
      $username = $userAccount->checkDuplicate($data);
      if (isset($username) && !empty($username)) {
        $_SESSION['error_message'] = 'Username is already taken!';
        echo "<script>location.href='/" . $this->root . "/register'</script>";
      } else {
        $profile_id = $userProfile->createUserProfile($data);
        $userAccount->createUserAccount($data, $profile_id);
        echo
        "<script>
        window.onload = function() {
            successfullRegisterAlert();
        };
        </script>";
      }
    }
  }


  // LOGIN USER CONTROLLER
  public function loginUser() {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
      $data = [
        "username" => $_POST["username"],
        "password" => $_POST["password"]
      ];

      $userAccount = $this->model('userAccount');
      $valid = $userAccount->loginUserAccount($data);

      if ($valid) {
        $_SESSION['is_logged_in'] = true;
        $_SESSION['username'] = $data['username'];
        echo "<script>location.href='home/dashboard'</script>";
      } else {
        echo "<script>alert('Incorrect Username or Password')</script>";
      }
    }
  }

  // UPDATE USER CONTROLLER
  public function updateAccount() {
    $id = $_GET['account_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    $data = [
      "id" => $id,
      "username" => $username,
      "password" => $password,
      "role" => $role
    ];

    $userAccount = $this->model('userAccount');
    $account = $userAccount->checkDuplicate($data);
    if ($id != $account['account_id'] && $account['username'] == $username) {
      echo "<script>alert('Username is already taken!')</script>";
      return;
    }
    $userAccount->updateUserAccount($data);
    $this->view('/' . $this->root . '/home/tables?name=accounts');
  }

  public function updateProfile() {
    $id = $_GET['profile_id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];

    $data = [
      "id" => $id,
      "firstName" => $firstName,
      "lastName" => $lastName,
      "email" => $email
    ];

    $userUpdate = $this->model('userProfile');
    $userUpdate->updateUserProfile($data);
    $this->view('/' . $this->root . '/home/tables?name=profiles');
  }

  public function updateData() {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_GET['name'])) {
      if (isset($_GET['name'])) {
        if ($_GET['name'] == 'profiles') {
          $this->updateProfile();
        } else {
          $this->updateAccount();
        }
      }
    }
  }

  // DELETE USER CONTROLLER
  public function deleteProfile() {
    $userProfile = $this->model('userProfile');
    $userProfile->deleteUserProfile($_GET['profile_id']);
    $this->view('/' . $this->root . '/home/tables?name=profiles');
  }

  public function deleteAccount() {
    $userAccount = $this->model('userAccount');
    $userAccount->deleteUserAccount($_GET['account_id']);
    $this->view('/' . $this->root . '/home/tables?name=accounts');
  }

  public function deleteData() {
    if ($_GET['name'] == 'profiles') {
      $this->deleteProfile();
    } else {
      $this->deleteAccount();
    }
  }
}
