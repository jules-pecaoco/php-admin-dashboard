<?php
class userProfile extends Database {


  // CREATE USER
  public function createUserProfile($data) {
    $con = $this->connect();
    $statement = $con->prepare("INSERT INTO user_profile(first_name, last_name, email) VALUES (:firstName, :lastName, :email)");


    $statement->bindParam(":firstName", $data["firstName"], PDO::PARAM_STR);
    $statement->bindParam(":lastName", $data["lastName"], PDO::PARAM_STR);
    $statement->bindParam(":email", $data["email"], PDO::PARAM_STR);

    $statement->execute();

    $profile_id = $con->lastInsertId();

    $statement = null;

    return $profile_id;
  }


  public function fetchAllUserProfile() {
    $statement = $this->connect()->prepare("SELECT * FROM user_profile");
    $statement->execute();
    $data = $statement->fetchAll(PDO::FETCH_ASSOC);
    $statement = null;
    return $data;
  }

  public function fetchUserProfile($id) {
    $statement = $this->connect()->prepare("SELECT * FROM user_profile WHERE profile_id = :id");
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    $statement = null;
    return $data;
  }



  // UPDATE USER
  public function updateUserProfile($data) {
    $statement = $this->connect()->prepare("UPDATE user_profile SET first_name = :firstName, last_name = :lastName, email = :email WHERE profile_id = :id");
    $statement->bindParam(":firstName", $data["firstName"], PDO::PARAM_STR);
    $statement->bindParam(":lastName", $data["lastName"], PDO::PARAM_STR);
    $statement->bindParam(":email", $data["email"], PDO::PARAM_STR);
    $statement->bindParam(":id", $data["id"], PDO::PARAM_INT);
    $statement->execute();
    $statement = null;
  }


  // DELETE USER
  public function deleteUserProfile($id) {
    $statement = $this->connect()->prepare("DELETE FROM user_profile WHERE profile_id = :id");
    $statement->bindParam(":id", $id, PDO::PARAM_INT);
    $statement->execute();
    $statement = null;
  }
}
