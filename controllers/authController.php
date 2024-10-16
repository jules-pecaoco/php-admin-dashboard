

<?php
class authController extends Controller {
  function register() {
    $userController = $this->control('userController');
    $userController->createUser();
  }

  function login() {
    $userController = $this->control('userController');
    $userController->loginUser();
  }
}
