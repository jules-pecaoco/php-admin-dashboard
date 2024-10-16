<?php
class dataController extends Controller {

  function fetchProfiles() {
    $userProfile = $this->model('userProfile');
    $data = $userProfile->fetchAllUserProfile();
    return $data;
  }

  function fetchAccounts() {
    $userProfile = $this->model('userAccount');
    $data = $userProfile->fetchAllUserAccount();
    return $data;
  }

  function fetchTableData() {
    if (isset($_GET['name'])) {
      $tableName = $_GET['name'];
      if ($tableName == 'profiles') {
        $profiles = $this->fetchProfiles();
        return $profiles;
      }
      $accounts = $this->fetchAccounts();
      return $accounts;
    }
  }

  function fetchProfileData() {
    if (isset($_GET['profile_id'])) {
      $profile_id = $_GET['profile_id'];
      $userProfile = $this->model('userProfile');
      $data = $userProfile->fetchUserProfile($profile_id);
      return $data;
    }
  }

  function fetchAccountData() {
    if (isset($_GET['account_id'])) {
      $account_id = $_GET['account_id'];
      $userAccount = $this->model('userAccount');
      $data = $userAccount->fetchUserAccount($account_id);
      return $data;
    }
  }

  function fetchSingleData($id) {
    if ($_GET['name'] == 'profiles') {
      $data = $this->fetchProfileData($id);
      return $data;
    }
    $data = $this->fetchAccountData($id);
    return $data;
  }
}
