<?php 
# Handle Login form submission 
if (isset($_POST['submitbutton'])) {
  # Fetch the user email and password from the submited filed
  $email = $_POST['email'];
  $password = $_POST['password'];

  require_once 'dbh.inc.php';
  require_once 'functions.inc.php';

  # Check if any of the fields are empty
  if (emptyInputLogin($email, $password) !== false) {
    header("Location: ../login.php?error=emptyinput");
    exit();
  }

  # Login the user
  loginUser($conn, $email, $password);

}