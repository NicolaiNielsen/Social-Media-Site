<?php
    require_once "/home/mir/lib/db.php";
    require "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WITS</title>
    <link rel='stylesheet' href='style.css'/>
    <script src="https://kit.fontawesome.com/dc9e7905fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <?php
    session_start();
  ?>

</head>

<body>
    
<!--Navigation bar-->
<div class="topnav">
    <a href="index.php">Posts</a>
    <a href="login.php">Login</a>
    <a href="register.php">Register</a>
    <a href="users.php">Alle Brugere</a>
    <a href="profile.php?uid=<?php echo $_SESSION['suser'] ?> " <?php checkIfLoggedInAndHideElement($_SESSION['suser'], $_SESSION['spw']); ?>><?php echo $_SESSION['suser'] ?></a>
    <form action="" method="post" <?php checkIfLoggedInAndHideElement($_SESSION['suser'], $_SESSION['spw']); ?>>
      <input type="submit" value="Log ud" name="logout">
    </form>
</div>

<div class='user-feed'>
  <h1>Alle brugere i WITS</h1>
<div class='use-box'>
</div>
</div>

<?php
    require_once "/home/mir/lib/db.php";

    logOut();

    $uids = get_uids();
    foreach ($uids as $uid)
    {
      echo "
      <div class='user-row'> 
      <a href=\"profile.php?uid=$uid\">$uid</a>
      </div>";
    }
  ?>

</body>
</html>