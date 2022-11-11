<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='style.css'/>
</head>

<body>
    
<div class="topnav">
    <a class="active" href="#home">Home</a>
    <a href="#news">News</a>
    <a href="#contact">Contact</a>
    <a href="#about">About</a>
</div>

<div class="postbox">
    <!-- HTML FORM - class blog-form -->
  <form action="submittedpost.php" method="get" class="blog-form">
  <div class='form-row'> 
  <!-- username -->
    <label for="uid"></label>
    <input id="uid" placeholder="Enter post uid to edit" type="text" name="uid">
    <label for="pid"></label>
    <input id="pid" placeholder="Enter post pid to show" type="text" name="pid">
    <button class="blogbox_blogButton" type="submit" name="button2">Submit</button>
    </div>
  </form>

  </div>
</body>


<?php // formtest.php

//implementer API

  require_once "/home/mir/lib/db.php";

if(array_key_exists('button2', $_GET)) {

  //variabler til at få content fra det indtastede 
  
  $entereduserid = $_GET['uid'];
  $pid = $_GET['pid'];
  $post = get_post($pid);
  $realpostuser = $post["uid"];
  //sætter op contentet some placeholder, så du kan edit
  $currenttitle = $post['title'];
  $currentcontent  = $post['content'];

  echo "PID: ";
  echo "$pid";
  echo "<br>";
  echo "Entereduserid: ";
  echo "$entereduserid";
  echo "<br>";
  echo "Postuser: ";
  echo "$realpostuser";

 // pid == pid uid

  if ($realpostuser == $entereduserid) {
    $a = 1;
    echo "<br>";
    echo "Match true";
    //setting contenteditable to true og viser postet i htmlform
    echo "<form action='submittedpost.php' method='get'>
    <div class='form-row'>
      <label for='name'></label>
      <input id='name' placeholder='Enter postid $pid again' type='text' name='name'>
      <label for='blogtitle'></label>
      <input id='blogtitle' placeholder=$currenttitle type='text' name='blogtitle'>
      <label for='blogcontent'></label>
      <textarea id='blogcontent' placeholder=$currentcontent name='blogcontent'></textarea>
      <button class='blogbox_blogButton' type='submit' name='editbutton'>Edit</button>
      </div>
    </form>";

  } else {
    $b = 2;
    echo "<br>";
    echo "Just showing post, match false";
    //setting contenteditable to false and only shows as text
    echo "<div class='post'>
    <div class='post_body'>
      <div class='post_header'>
        <div class='post_headerText'>
          <h3>$post[title]</h3>
            <span class='post_header'>
            </span>
          </h3>
        </div>
        <div class='post_headerDescription'>
          <p>$post[content]</p>
        </div>
      </div>";
  }
}


  if(array_key_exists('editbutton', $_GET)) {
    modify_post($_GET["name"], $_GET["blogtitle"], $_GET["blogcontent"]);
    echo $_GET['name'];
    echo "<br>";
    echo $_GET["blogtitle"];
    echo "<br>";
    echo $_GET["blogcontent"];
    echo "<br>";
    echo "SUCCESS";
    echo "<br>";
    echo "<br>";
    echo "u successfully modified the post";
  }
  
?>












