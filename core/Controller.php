<?php
class Controller {
  function getRoot() {
    return $_SESSION['root'];;
  }


  public function view($view) {
    echo "<script>location.href='$view'</script>";
  }

  public function model($model) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $this->getRoot() . "/models/$model.php";
    return new $model;
  }

  public function control($control) {
    require_once $_SERVER['DOCUMENT_ROOT'] . "/" . $this->getRoot() . "/controllers/$control.php";
    return new $control;
  }
}
