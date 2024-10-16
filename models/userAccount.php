<?php
class userAccount extends Database {

  public function createUserAccount($data, $profile_id) {
    $statement = $this->connect()->prepare("INSERT INTO user_account(username, password,  profile_id, is_admin) VALUES (:username, :password, :profile_id ,:is_admin)");

    $data = $this->hashPassword($data);
    $statement->bindParam(":username", $data["username"], PDO::PARAM_STR);
    $statement->bindParam(":password", $data["password"], PDO::PARAM_STR);
    $statement->bindParam(":profile_id", $profile_id, PDO::PARAM_INT);
    $is_admin = false;
    $statement->bindParam(":is_admin", $is_admin, PDO::PARAM_BOOL);

    $statement->execute();
    $statement = null;
  }

  public function checkDuplicate($data) {
    $statement = $this->connect()->prepare("SELECT * FROM  user_account WHERE username = :username");
    $statement->bindParam(":username", $data['username'], PDO::PARAM_STR);

    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    return $user;
  }

  function hashPassword($data) {
    $data['password'] = password_hash($data['password'],  PASSWORD_DEFAULT);
    return $data;
  }



  public function loginUserAccount($data) {
    $statement = $this->connect()->prepare("SELECT * FROM user_account WHERE username = :username");
    $statement->bindParam(":username", $data["username"], PDO::PARAM_STR);
    $statement->execute();
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $statement = null;

    if (!$user) {
      return false;
    }

    $hashPassword = $user['password'];
    if (password_verify($data['password'], $hashPassword)) {
      return true;
    }
    return false;
  }

  public function fetchAllUserAccount() {
    $statement = $this->connect()->prepare("SELECT * FROM user_account");
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement = null;
    return $data;
  }

  public function fetchUserAccount($id) {
    $statement = $this->connect()->prepare("SELECT * FROM user_account WHERE account_id = :id");
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $statement = null;
    return $data;
  }


  public function updateUserAccount($data) {
    $is_admin = $data['role'] === 'admin' ? true : false;

    $statement = "";
    if ($data["password"] == "") {
      $statement = $this->connect()->prepare("UPDATE user_account SET username = :username,  is_admin = :is_admin WHERE account_id = :id");
    } else {
      $statement = $this->connect()->prepare("UPDATE user_account SET username = :username, is_admin = :is_admin, password = :password WHERE account_id = :id");
      $data = $this->hashPassword($data);
      $statement->bindParam(":password", $data["password"], PDO::PARAM_STR);
    }
    $statement->bindParam(":username", $data["username"], PDO::PARAM_STR);
    $statement->bindParam(":is_admin", $is_admin, PDO::PARAM_BOOL);
    $statement->bindParam(":id", $data["id"], PDO::PARAM_INT);
    $statement->execute();
    $statement = null;
  }


  public function deleteUserAccount($id) {
    $statement = $this->connect()->prepare("DELETE FROM user_account WHERE account_id = :id");
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $statement = null;
  }
}
