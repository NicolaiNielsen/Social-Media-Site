<?php // formtest.php

//implementer API

  require_once "/home/mir/lib/db.php";

// Først laver vi formen
// Action referer til hvor dataen skal sendes hen når den er submitted
// Method definerer om vi skal hente eller sende data


// HTML form to enter pid and uid

echo <<<_END
<html>
  <body>
    <form action="tester.php" method="get">
      pid: <input type="text" name="pid">
      uid: <input type="text" name="uid">
      <input type="submit" name="button2">
      <br>
    </form>
  </body>
</html>
_END;

echo "<br>";


//når du klikker send, så checker vi om det postede uid passer på pid'ets uid. 

if(array_key_exists('button2', $_GET)) {

  //variabler til at få content fra det indtastede pid
  $pid = $_GET['pid'];
  $post = get_post($pid);
  $user = get_user($post['uid']);
  //sætter op contentet some placeholder, så du kan edit
  $currenttitle = $post['title'];
  $currentcontent = $post['content'];

 // checker vi om det postede uid passer på pid'ets uid. 
 // cancer at udføre html forms i php, nu virker mine variabler ikke XDD


  if ($post['uid'] == $_GET['uid']) {
    $a = 1;
    //setting contenteditable to true
    echo "match";
    echo "<br>";

  } else {
    $b = 2;
    //setting contenteditable to false
    echo "no match";
    echo "<br>";
  }
}


// hide button if no match, show button if match
//har fyret post kontent ind som placeholder


?>

    <form action="tester.php" method="get">
      CURRENT POST:
      <br>
      Reenter pid: <input type="text" name="new_pid">
      Titel: <input type="text" name="new_title" placeholder='<?php echo $currenttitle?>'>
      Content: <input type="text" name="new_content" placeholder='<?php echo $currentcontent?>'>
      <input type="submit" name="editbutton" <?php if($b == 2) {?> disabled="disabled" <?php } ?>>
      <br>
    </form>
<?php


function editpost() {
  modify_post($_GET['new_pid'], $_GET["new_title"], $_GET["new_content"]);
  echo $_GET['new_pid'];
  echo "<br>";
  echo $_GET["new_title"];
  echo "<br>";
  echo $_GET["new_content"];
  echo "<br>";
  echo "SUCCESS";
}


  if(array_key_exists('editbutton', $_GET)) {
  modify_post($_GET['new_pid'], $_GET["new_title"], $_GET["new_content"]);
    editpost();
    echo "<br>";
    echo "<br>";
    echo "u successfully modified the post";
  }
  
?>







