<?php
    require_once "/home/mir/lib/db.php";
    require "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- gammelbrowser compatibilitet -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WITS</title>
    <link rel='stylesheet' href='style.css'/>
    <script src="https://kit.fontawesome.com/dc9e7905fa.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script> 
<?php
  session_start(); //altid start session i header
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
<!-- Feed starts -->
<div class="feed">
  <!-- blogbox start -->
  <div class="blogbox" <?php checkIfLoggedInAndHideElement($_SESSION['suser'], $_SESSION['spw']); ?>>>
    <!-- HTML FORM - class blog-form + multipart/form-data -->
  <form action="index.php" method="post" class="blog-form" enctype="multipart/form-data"> 
  <div class='form-row'> 
  <!-- blogtitle -->
    <label for="title"></label>
    <input id="title" placeholder="Titel på dit fantastiske opslag" type="text" name="blogtitle">
  <!-- textarea -->
    <label for="blogcontent"></label>
    <textarea id="blogcontent" placeholder="Din status opdatering" name="blogcontent"></textarea>
    <!-- fileupload -->
    <input type="file" name="img" id="fileToUpload">
  <!-- submitbutton -->
    <button class="blogbox_blogButton" type="submit" name="postblog">Submit</button>
    </div>
  </form>
</div>

<?php // kalder php funktioner
  createHTMLFeed(); //laver postfeed
  logOut();
  uploadPost(); 
?>
</body>
</html>





    
