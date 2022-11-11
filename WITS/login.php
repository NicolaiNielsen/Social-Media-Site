<!doctype html>
  <html>
    <head>
    <meta charset='UTF-8'/>
      <title>Login</title>
        <link rel='stylesheet' href='style.css'/>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      </head>
    </head>
    <body>

  <div class="blogbox">
    <!-- Login form using post -->
  <form action="login.php" method="post" class="login-form">
    <div class='login-row'> 
      <h1>Log på WITS</h1>
    <!-- username -->
      <label for="username"></label>
      <input placeholder="Indtast brugernavn" type="text" name="username" required>
    <!-- password -->
      <label for="pw"></label>
      <input placeholder="Indtast password" type="password" name="pw" required>
    <!-- submitbutton -->
      <div class="buttonHolder">
        <input type="submit" class='button' name="submit" value="Login">
      </div>
    </div>
  </form>
    <div class="registerText">
      <h2>Har du ikke en konto? <a href="createuser.php">Tilmeld dig</a></h2>
    </div>
  </div>
</body>
  </html>


<?php 

//note der er ingen session_destroy eller log ud

require_once "/home/mir/lib/db.php";

//funktion der gemmer input felterne; username og pw
//disse variabler køres gennem login() som returner true eller false afhængigt om brugeren passer med den i databasen

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $pw = $_POST['pw'];
      if (login($username, $pw)) {
        //hvis true, så starter vi en session og gemmer username og pw som session variabler
        //session variabler kan kun være "fulde" hvis login er korrekt
        //derfor kan vi så vores main.page checke om de tomme eller fyldte
        // og herefter enten vise hemmelig info eller returnere brugeren tilbage til login siden
        session_start();
        $_SESSION['suser'] = $username;
        $_SESSION['spw'] = $pw;
        echo "true redirect til secret page";
        header('Location:main.php');
        exit;
        
      } else if (!login($username, $pw)) {
        echo "<div class='errorMsg'>
                <h1>WRONG LOGIN FOOL - be kind and try again</h1>
              </div>";
    }
  }
  
?>