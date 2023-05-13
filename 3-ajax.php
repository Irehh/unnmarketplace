<?php
if (isset($_POST["req"])) {
  require "2-lib.php";
  switch ($_POST["req"]) {
    // (A) GET COMMENTS
    case "get";
      echo json_encode($_COM->get($_POST["id"]));
      break;

    // (B) ADD COMMENT
    case "add":
      $_COM->save($_POST["id"], $_POST["name"], $_POST["msg"]);
      echo "OK";
      break;
}}