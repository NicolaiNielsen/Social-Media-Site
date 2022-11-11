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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/SSajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
    <a href="show_user.php?uid=<?php $_SESSION['suser'] ?>"><?php echo $_SESSION['suser'] ?></a>
</div>


<!-- show posts -->

<?php
    require_once "/home/mir/lib/db.php";

    $pid = $_GET['pid'];
    $post = get_post($pid);

    function getComments($pid) {

      $comments = get_cids_by_pid($pid);

      foreach($comments as $comment) {
        $currentcomment = get_comment($comment);
        echo "<div class='post_comments'>
        <p id='comment'>$currentcomment[content]. $currentcomment[cid]</p>
        <form method='post'>
        <label for='edit'></label>
        <textarea id='edit' style='display: none' name='edit'>$currentcomment[content]
        </textarea>
        <input type='submit' name='delete' value='Delete'/>
        </form>
        <textarea id='edit' style='display: none' name='edit'>$currentcomment[content]
        </textarea>
        <p><a href=\"show_user.php?uid=$currentcomment[uid]\">$currentcomment[uid]</a></p> 
        <input type='submit' name='delete' value='Delete'/>
          <button onclick='myFunction()' style='display: inline-block' >Edit</button>
          <button onclick='myFunction()' style='display: inline-block' >Cancel</button>
          <button onclick='myFunction()' style='display: inline-block' >Submit</button>
          <button onclick='myFunction()' style='display: inline-block' >Delete</button>
        </div>";

        echo $currentcomment['cid'];

        if(isset($_POST['delete'])) {
          delete_comment($currentcomment['cid']);
          echo "<meta http-equiv='refresh' content='0'>"; // REFRESH SIDE
          break;
      }
    }
  }




    function getPictures($pid) {

    $imageid = get_iids_by_pid($pid);

      foreach($imageid as $value) {
        $image = get_image($value);
        $imagepath = $image['path'];
        echo "<div class='box box1'><img src=$imagepath alt=''></div>";
    }
    }

    echo 
    "<div class='blogpost'>
      <div class='bloginfo'>
          <h3>$pid. $post[title]</a></h3>
          <p contentEditable='true'>$post[content]</p>
          <p>skrevet af <a href=\"show_user.php?uid=$post[uid]\">$post[uid]</a></p>
          <p>$post[date]</p>
        </div>";
            getPictures($pid);
            getComments($pid); 
    "</div>";

    if (isset($_POST['postcomment'])) {
      add_comment($_SESSION['suser'], $pid, $_POST["comment"]);
      echo "<meta http-equiv='refresh' content='0'>";
    }

  if ($_SESSION['suser'] == $pid) {
    
  }
  
  ?>

<!-- Tilføj Kommentar -->

<div class ='commentbox'>
      <form method='post'>
        <label for='comment'></label>
        <input placeholder='Tilføj kommentar' type='text' name='comment' required>
        <div class='buttonHolder'>
            <input type='submit' class='button' name='postcomment'>
          </div>
      </form>
</div>



<button onclick="myFunction()">Click Me</button>

<div id="myDIV">
  This is my DIV element.
</div>

<script>

function myFunction() {
  var x = document.getElementById("comment");
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