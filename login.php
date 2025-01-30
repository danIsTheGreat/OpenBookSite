<section class="signup-form">
<style>
.signupformbody {
  height: 600px;
  width: 330px;
  margin: 0 auto;
  margin-top: 100px;
}

.box {
  width: 300px;
  margin-top: 15px;
  padding: 10px;
  margin-left: 10px;
  margin-bottom: 10px;
  border-radius: 0px;
}

h1 {
  text-align: center;
 
}

label{
  margin-left: 10px;
}

.submitbutton{
  width: 100px;
  margin-top: 20px;
  padding: 10px;
  margin-left: 100px;
  color: white;
  font-style: bold;
  background-color: black;
  
}
</style>
  
<div class="signupform">
  <div class="signupformbody"> 
    <h1>Log In</h1><br>
    <?php
/* php script to fetch error message from the url and display proper error messages */ 
 if (isset($_GET['error'])){
    if ($_GET['error'] == 'wrongLogin'){
      echo "<p>Incorrect Email Or Password Provided.</p>";
    }
    else if ($_GET['error'] == 'emptyinput'){
      echo "<p>Please Fill all the Fileds to Login.</p>";
    }
}
?>
    <form action="includes/login.inc.php" method="POST">
      <label for="email">Email</label><br>
      <input id="email" class="box" type="text" name="email" placeholder="Enter your email"><br>
      <label for="password">Password</label><br>
      <input id="password" class="box" type="text" name="password" placeholder="Enter your password"><br>
      <button class="submitbutton" type="submit" name="submitbutton">Log In</button>
    </form>
  </div>

</div>