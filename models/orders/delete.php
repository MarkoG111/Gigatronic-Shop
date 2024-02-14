<?php

$code = 404;

if (isset($_POST["id"])) {
  require_once "../../config/connection.php";
  require_once "functions.php";

  $id = $_POST["id"];

  try {
    $conn->beginTransaction();

    deleteOrderDetails($id);
    deleteOrder($id);

    $conn->commit();
    $code = 204;
  } catch (PDOException $ex) {
    $conn->rollBack();

    recordErrors($ex->getMessage());
    $code = 500;
  }
} else {
  $code = 400;
}

http_response_code($code);
