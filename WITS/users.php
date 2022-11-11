<?php
    require_once "/home/mir/lib/db.php";
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

  <!-- check if logged in -->
  <?php
    session_start();

    if (empty($_SESSION['suser'] && $_SESSION['spw']))
    {
      echo "not logged in";
      header('Location:login.php');
      exit;
    } 
    ?>

</head>

<body>
    
<div class="topnav">
    <a class="active" href="#home">Home</a>
    <a href="submittedpost.php">Posts</a>
    <a href="login.php">Login</a>
    <a href="createuser.php">Register</a>
    <a href="users.php">Alle Brugere</a>
    <a href="blogposts.php"><?php echo $_SESSION['suser'] ?></a>
    
</div>

<div class='user-feed'>
  <h1>Alle brugere i WITS</h1>
<div class='use-box'>
</div>
</div>

<?php
    require_once "/home/mir/lib/db.php";

    $uids = get_uids();
    foreach ($uids as $uid)
    {
      echo "
      <div class='user-row'> 
      <a href=\"show_user.php?uid=$uid\">$uid</a>
      </div>";
    }
  ?>

</body>
</html>