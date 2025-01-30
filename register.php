<section class="signup-form">
<style>
.signupformbody {
  height: 600px;
  width: 370px;
  margin: 0 auto;
}

.box {
  width: 300px;
  margin-top: 15px;
  padding: 10px;
  margin-left: 10px;
  margin-bottom: 10px;
  border-radius: 5px;
}

h1 {
  text-align: center;
 
}

label{
  margin-left: 10px;
}

.submit{
  width: 320px;
  margin-top: 20px;
  padding: 10px;
  margin-left: 10px;
  color: white;
  font-style: bold;
  background-color: black;
}
</style>

<div class="signupform">
  <div class="signupformbody"> 
    <h1>Sign Up</h1><br>

 <?php 

/* php script to fetch error message from the url and display proper error messages */ 
 if (isset($_GET['error'])){
    if ($_GET['error'] == 'emptyinput'){
      echo "<p>Please fill all the available Fields.</p>";
    }

    else if ($_GET['error'] == 'invalidemail'){
      echo "<p>Please use correct email format.</p>";
    }

    else if ($_GET['error'] == 'invalidpassword'){
      echo "<p>Please macth your passwords.</p>";
    }
 
    else if ($_GET['error'] == 'stmtfailed'){
      echo "<p>Database Operation Failed.</p>";
    }

    else if ($_GET['error'] == 'emaildoesnotmatch'){
      echo "<p>Please match your emails.</p>";
    }

    else if ($_GET['error'] == 'emailtaken'){
       echo "<p>Please choose another email. your email has alredy taken.</p>";
    }

    else if ($_GET['error'] == 'none'){
      echo "<p>You are Registered successfully<p>";     
    }
}
?>

    <form action="includes/signup.inc.php" method="POST">
      <label for="firstname">First Name</label><br>
      <input id="firstname" class="box" type="text" name="firstname" placeholder="First name"><br>

      <label for="lastname">Last Name</label><br>
      <input id="lastname" class="box" type="text" name="lastname" placeholder="Last name"><br>

      <label for="email">Email</label><br>
      <input id="email" class="box" type="text" name="email" placeholder="Email"><br>

      <label for="confirmemail">Confirm Email</label><br>
      <input id="confirmemail" class="box" type="text" name="confirmemail" placeholder="Confirm Email"><br>

      <label for="password">Password</label><br>
      <input id="password" class="box" type="password" name="password" placeholder="Password"><br>

      <label for="confirmpassword">Confirm Password</label><br>
      <input id="confirmpassword" class="box" type="password" name="confirmpassword" placeholder="Confirm Password"><br>

      <button class="submit" type="submit" name="submit">Register</button>
    </form>
  </div>

</div>
  

