<?php
    require_once "/home/mir/lib/db.php";
    require "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blogpost</title>
    <link rel='stylesheet' href='style.css'/>
    <script src="https://kit.fontawesome.com/dc9e7905fa.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/SSajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
  session_start(); //session start
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
<!-- show posts -->

<?php
        $pid = $_GET['pid'];
        $post = get_post($pid);

    echo 
    "<div class='blogpost'>
      <div class='bloginfo'>
          <h3>$pid. $post[title]</a></h3>
          <p id='content'>$post[content]</p>
          <form id='edit' style='display: none' method='post'>
          <textarea name='editcontent'>$post[content]
          </textarea>
          <input type='submit' name='editbutton' value='edit'/>
          </form>
          <p>skrevet af <a href=\"profile.php?uid=$post[uid]\">$post[uid]</a></p>
          <p>$post[date]</p>
          <button onclick=\"myFunction()\" $show>Rediger</button>
        </div>";
            getPictures($pid);
            getComments($pid); 
    "</div>";

    if (isset($_POST['postcomment'])) { //edit post kommentar
      add_comment($_SESSION['suser'], $pid, $_POST["comment"]);
      echo "<meta http-equiv='refresh' content='0'>";
    }

    if(array_key_exists('editbutton', $_POST)) { //edit button 
      modify_post($pid, $post["title"], $_POST["editcontent"]);
      echo "<meta http-equiv='refresh' content='0'>"; // REFRESH SIDE
    }
  ?>

<!-- Tilføj Kommentar gemmes hvis ikke logget ind-->
<div class ='commentbox' <?php checkIfLoggedInAndHideElement($_SESSION['suser'], $_SESSION['spw'])?>>
      <form method='post'>
        <label for='comment'></label>
        <input placeholder='Tilføj kommentar' type='text' name='comment' required>
        <div class='buttonHolder'>
            <input type='submit' class='button' name='postcomment'>
          </div>
      </form>
</div>  

<script>
function myFunction() { //hvis vi trykker på rediger knappen, så viser vi textfelt ellers hide
  var x = document.getElementById("content");
  var textarea = document.getElementById("edit");
  if (x.style.display === "none") {
    x.style.display = "block";
    textarea.style.display = "none";

  } else {
    x.style.display = "none";
    textarea.style.display = "block";
  }
}
</script>

</body>
</html>