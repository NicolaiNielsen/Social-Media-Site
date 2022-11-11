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
    <a href="show_user.php?uid=<?php echo $_SESSION['suser'] ?>"><?php echo $_SESSION['suser'] ?></>
    <a href="users.php">Alle Brugere</a>
    
</div>


<!-- Feed starts -->
<div class="feed">
  <!-- blogbox start -->
  <div class="blogbox">
    <!-- HTML FORM - class blog-form -->
  <form action="index.php" method="get" class="blog-form">
  <div class='form-row'> 
  <!-- username -->
    <label for="name"></label>
    <input id="name" placeholder="Brugernavn" type="text" name="name">
  <!-- blogtitle -->
    <label for="title"></label>
    <input id="title" placeholder="Titel på dit fantastiske opslag" type="text" name="blogtitle">
  <!-- textarea -->
    <label for="blogcontent"></label>
    <textarea id="blogcontent" placeholder="Din status opdatering" name="blogcontent"></textarea>
  <!-- submitbutton -->
    <button class="blogbox_blogButton" type="submit" name="button2">Submit</button>
    </div>

    <?php
  
  if(array_key_exists('button2', $_GET)) {
    echo "Thanks for submitting your post. It is now stored in our database";
    add_post($_GET["name"], $_GET["blogtitle"], $_GET["blogcontent"]);
    get_pids();
  }

  ?>

  </form>


  </div>
  <!-- blogbox end -->

  <!-- posts start -->
  <?php createHTMLFeed();?>
  </div>
</body>
</html>


<?php




function createHTMLFeed() {

  $blogposts = get_pids();
  // print_r(array_slice($blogposts,-5));


  // tager de 5 sidste blogindlæg i array og vender det om, for at vise de latest posts
  $latestpostslatest = array_reverse($blogposts, false);

  foreach($latestpostslatest as $value) {
    $blogid = get_post($value);

    echo 
    "<div class='postfeed'>
        <div class='post_headerText'>
          <h3><a href=\"blogpost.php?pid=$value\">$value. $blogid[title]</a></h3>
        </div>
        <div class='post_headerDescription'>
          <p>$blogid[content]</p>
          <p>skrevet af <a href=\"show_user.php?uid=$blogid[uid]\">$blogid[uid]</a></p>
          <p>$blogid[date]</p>
        </div>
      <div class='post_footer'>
        <button class='btn'><i class='fa-solid fa-pen-to-square'></i> Rediger</button>
        <button class='btn'><i class='fa-solid fa-comment'></i> Kommentarer</button>
    </div>
    </div>";
 }
}
?>



    
