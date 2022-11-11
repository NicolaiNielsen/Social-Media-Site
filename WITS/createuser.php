<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width='device-width', initial-scale=1.0">
  <title>Register</title>
  <link rel='stylesheet' href='style.css'/>
</head>
<body>

<form action="createuser.php" method="post" class="registration-form">
    <div class='registration-row'> 
      <h1>Tilmeld dig WITS i dag.</h1>
    <!-- username -->
      <label for="username">Brugernavn</label>
      <input placeholder="Indtast brugernavn" type="text" name="username" required>
    <!-- password -->
      <label for="pw">Password</label>
      <input placeholder="Indtast password" type="password" name="pw" required>
          <!-- password -->
      <label for="fornavn">Fornavn</label>
      <input placeholder="Indtast fornavn" type="text" name="fornavn" required>
          <!-- password -->
      <label for="efternavn">Efternavn</label>
      <input placeholder="Indtast efternavn" type="text" name="efternavn" required>
    <!-- submitbutton -->
      <div class="buttonHolder">
        <input type="submit" class='button' name="submit" value="Lav bruger">
      </div>
    </div>
  </form>
</body>
</html>


<?php // formtest.php

//implementer API

  require_once "/home/mir/lib/db.php";

// Først laver vi formen

//hvis vi trykker på knappen, så anvender vi add_post funktionen
//ved godt den ikke er sticky



if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $pw = $_POST['pw'];
  $fornavn = $_POST['fornavn'];
  $efternavn = $_POST['efternavn'];
  
    if (add_user($_POST["username"], $_POST["fornavn"], $_POST["efternavn"], $_POST["pw"])) {
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
      
    } else if (!add_user($_POST["username"], $_POST["fornavn"], $_POST["efternavn"], $_POST["pw"])) {
      echo "<div class='errorMsg'>
              <h1>Noget gik galt - prøv igen</h1>
            </div>";
  }
}


?>