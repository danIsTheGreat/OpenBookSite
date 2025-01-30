<?php

# Check If the user entered the submit button after filing the form
# isset is a built in method in PHP to check if the user clicked submit button

// Importing the necessary Functions
include_once 'functions.inc.php';

// Importing Database Connection
include_once 'dbh.inc.php';

if (isset($_POST['submit'])) {
  
  # Collect user data from the submitted Form
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $confirmemail = $_POST['confirmemail'];
  $password = $_POST['password'];
  $confirmpassword = $_POST['confirmpassword'];

  # Check if the form filled has no errors or no empty fileds and valid 

  # Check if any of the fields are empty
  if (emptyInputSignup($firstname, $lastname, $email, $confirmemail, $password, $confirmpassword) !== false){
    header("Location: ../register.php?error=emptyinput");
    exit();
  }


  # check if the email is valid format
  if (invalidEmail($email) !== false) {
    header("Location: ../register.php?error=invalidemail");
    exit();
  }

  # check if the email confirmation is match with email
  if (emailMatch($email, $confirmemail) !== false) {
    header("Location: ../register.php?error=emaildoesnotmatch");
    exit(); 
  }

  # Check if the email is not already taken or exits in the database
  if (emailExists($email, $conn) !== false) {
    header("Location: ../register.php?error=emailtaken");
    exit();
}

  # check if the password confirmation is match with password
  if (passwordMatch($password, $confirmpassword) !== false) {
    header("Location: ../register.php?error=invalipassword");
    exit();  
  }

  # If the form confirmed to be valid and error free then we will create a user in db
  createUser($conn, $firstname, $lastname, $email, $password);
}
else {
  # Redirect the user to the registerations page again
  header("Location: ../register.php?error=emptyinput"); 
  exit();
}

?>