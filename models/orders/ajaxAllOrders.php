<?php

header("Content-Type: application/json");

require_once "../../config/connection.php";
require_once "functions.php";

$code = 404;
$data = null;

try {
  $data = getAllOrders();
  $code = 200;
} catch(PDOException $ex) {
  recordErrors($ex->getMessage());
  $code = 500;
}

echo json_encode($data);
http_response_code($code);