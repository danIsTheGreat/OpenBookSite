<?php


function emptyInputSignup($firstname, $lastname, $email, $confirmemail, $password, $confirmpassword){
  /* 
  Function to check if the form fileds are not empty.
  If any of the filed values passed as an argument are empty it return true else false 
  */
  if (empty($firstname) || empty($lastname) || empty($email) || empty($confirmemail) || empty($password) || empty($confirmpassword)){
    return true;
  }
  else{
    return false;
  }

}

function emptyInputLogin($email, $password){
  /* 
  Function to check if the Login form fileds are not empty.
  If any of the filed values passed as an argument are empty it return true else false 
  */
  if (empty($email) || empty($password)) {
    return true;
  }
  else{
    return false;
  }

}

function invalidEmail($email){
  /* 
   Check if the user email is in valid format
  */
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
    return true;
  }
  else{
    return false;
  }
}

function emailMatch($email, $confirmemail){
  /* 
   Check if the user email matches with confirmemail field
  */

  if ($email !== $confirmemail){
    return true;
  }
  else{
    return false;
  }
  }


function emailExists($email, $conn){
  /*
   Check if the user email is duplicate or already exist in database
  */

  // Perform Databse Query to check if any row has associated with the user email
  $dbQuery = "SELECT * FROM users WHERE email = ?;";

  // Prepare the database query
  $stmt = mysqli_stmt_init($conn);
  if (!mysqli_stmt_prepare($stmt, $dbQuery)){
    header("Location: ../register.php?error=stmtfailed");
    exit();
  }

 // Biniding the user email to tha database query
 mysqli_stmt_bind_param($stmt, "s", $email);

 // Perfrom database Query
 mysqli_stmt_execute($stmt);

 $dbResult= mysqli_stmt_get_result($stmt);

 if ($dbData= mysqli_fetch_assoc($dbResult)){
  return $dbData;
 }
 else{
  return false;
 }

  // Close Database Connection
  mysqli_stmt_close($stmt);
 }


function passwordMatch($password, $confirmpassword){
  /* 
   Check if the user password matches with confirmpassword filed 
   */
  if ($password !== $confirmpassword){
    return true;
 }
 else{
  return false;
 }
}


function createUser($conn, $firstname, $lastname, $email, $password){
  /*
    Create a new user and persist it into the database.
  */
  // Hashing the user password before storing in the database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Insert user Information into the Database
  $dbQuery = "INSERT INTO users (FIRSTNAME, LASTNAME, EMAIL, PASSWORD) 
  VALUES(?, ?, ?, ?);";

  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $dbQuery)){
    header("Location: ../register.php?error=stmtfailed");
    exit();
  }

 // Biniding the user data to tha database query
 mysqli_stmt_bind_param($stmt, "ssss", $firstname, $lastname, $email, $hashedPassword);
 
 // Perfrom database Query
 mysqli_stmt_execute($stmt);
 
 // Close Database Connection
 mysqli_stmt_close($stmt);

 header("Location: ../login.php?error=none");
 exit();
}

function loginUser($conn, $email, $password){
  /* Handle user logging Process */

  # Check if the email exits in our database
  $emailExists = emailExists($email, $conn);

  # If the email not in our database we redirect the user again to the login page
  if ($emailExists === false){
    header("Location: ../login.php?error=wrongLogin");
    exit();
  }

  # Next we validate the password provided in login form with the value inside our database
  # emailExists treated as an associative array so we grab the password as follows
  $hashedPassword = $emailExists["PASSWORD"];

  # Verify the hashed password validity
  $validPassword = password_verify($password, $hashedPassword);

  if ($validPassword === false){
    # Password not valid
    header("Location: ../login.php?error=wrongLogin");
    exit();
  }
  else if ($validPassword === true){
    # Valid Credintials Provided so Store the user database id inside the session
    session_start();
    $_SESSION['userID'] = $emailExists['ID'];
    # Redirect the user to our home page
    header("Location: ../index.php");
    exit();
  }
}


function fetchAllBooks($conn) {
  /* Function to fetch all Books from the mysql Database */

  // Sql command to fetch all rows from books table
  $dbQuery = "SELECT * FROM BOOKS";

  // Initalizing connection with the database
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $dbQuery)){
    header("Location: ../index.php?error=stmtfailed");
    exit();
}
     
  // Execute the sql database command
  mysqli_stmt_execute($stmt);

  // Fetch the result of the sql operation
  $dbResult = mysqli_stmt_get_result($stmt);

  // Array to hold all rows
  $dbData = [];

  // Store each row from the sql response into an array
  while ($row = mysqli_fetch_assoc($dbResult)){
    $dbData[] = $row;
  }
  
  return $dbData;
}

function fetchAllBooksByCategory($conn){

// for each category from categories table find matchs from books table based on category id 
$dbQuery = "SELECT books.BOOK_ID, books.BOOK_AUTHOR, books.BOOK_TITLE, books.PDF_PATH, books.IMAGE_PATH, categories.CATAEGORY_NAME
FROM BOOKS INNER JOIN 
categories ON books.CATEGORY_ID = categories.ID";

// Initalizing connection with the database
$stmt = mysqli_stmt_init($conn);

if (!mysqli_stmt_prepare($stmt, $dbQuery)){
  header("Location: ../index.php?error=stmtfailed");
  exit();
}

  // Execute the sql database command
  mysqli_stmt_execute($stmt);

  // Fetch the result of the sql operation
  $dbResult = mysqli_stmt_get_result($stmt);

  // Array to hold all rows
  $dbData = [];
  
  // Store each row from the sql response into an array
   while ($row = mysqli_fetch_assoc($dbResult)){
    $dbData[] = $row;
  }

  return $dbData;

}


function fetchAllCategory($conn){

  $dbQuery = "SELECT categories.CATAEGORY_NAME, categories.ID
  FROM categories";
  
  // Initalizing connection with the database
  $stmt = mysqli_stmt_init($conn);
  
  if (!mysqli_stmt_prepare($stmt, $dbQuery)){
    header("Location: ../index.php?error=stmtfailed");
    exit();
  }
  
    // Execute the sql database command
    mysqli_stmt_execute($stmt);
  
    // Fetch the result of the sql operation
    $dbResult = mysqli_stmt_get_result($stmt);
  
    // Array to hold all rows
    $dbData = [];
    
    // Store each row from the sql response into an array
     while ($row = mysqli_fetch_assoc($dbResult)){
      $dbData[] = $row;
    }
  
    return $dbData;
  
  }