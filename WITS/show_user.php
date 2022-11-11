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
    <a href="blogposts.php"><?php echo $_SESSION['suser'] ?></a>
</div>

<!-- show user -->

<?php
    $uid = $_GET['uid'];
    $user = get_user($uid);
?>

<div class="feed">
<div class="blogbox">
  <div class="bloginfo">
<h3><?php echo $uid ?></h3>
  <p>Fornavn: <?php echo $user['firstname']?></p>
  <p>Efternavn: <?php echo $user['lastname']?></p>
  </div>

  <div class="row">
  <div class="column">
  <h3>Liste af Posts</h3>
  <p><?php getPosts($uid); ?></p>
  </div>
  <div class="column">
  <h3>Liste af kommentarer</h3>
  <p><?php getUserComments($uid); ?></p>
  </div>
</div>

</div>

</div>


<?php
    require_once "/home/mir/lib/db.php";

    $uid = $_GET['uid'];
    $user = get_user($uid);


    function getPosts($uid) {


    $blogposts = get_pids_by_uid($uid);
    // convert array to string

    foreach($blogposts as $value) {
      $blogid = get_post($value);
      echo "<a href=\"blogpost.php?pid=$value\">$value. $blogid[title]</a>
      <br>";

    }
    }

    function getUserComments($uid) {

      $usercomments = get_cids_by_uid($uid);
      // convert array to string
  
      foreach($usercomments as $value) {
        $currentcomment = get_comment($value);
        echo "<a href=\"blogpost.php?pid=$currentcomment[pid]\">$currentcomment[pid]. $currentcomment[content]</a>
      <br>";
      }
      }
  ?>

</body>
</html>




