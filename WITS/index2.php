<?php
    require_once "/home/mir/lib/db.php";
?>

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
    <h1>Blogpost</h1>
    <!-- HTML FORM -->
    <div class='form-row'>
        <label for="name">Username</label>
        <input type="text" name="name">
        <label for="title">Title:</label><br>
        <input type="text" id="title" name="title"><br>
        <label for="msg">Blogpost Text:</label>
        <textarea id="msg" name="msg"></textarea>
        <div class='instructions'>Blog in 500 words or less</div>
        <input type="submit">
    </form>
    <!--SUBMIT BUTTON-->

    <div class='form-row'>
        <button>Submit</button>
    </div>



    
</body>
</html>


