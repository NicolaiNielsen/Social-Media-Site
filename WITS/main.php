<!doctype html>
  <html>
    <head>
    <meta charset='UTF-8'/>
      <title>Login</title>
        <link rel='stylesheet' href='style.css'/>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <?php
    session_start();

    if (empty($_SESSION['suser'] && $_SESSION['spw']))
    {
      header('Location:login.php');
      exit;
    } 
    ?>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
    </head>
    <body>
      <div class="topnav">
      <a class="active" href="#home">Home</a>
      <a href="submittedpost.php">Posts</a>
      <a href="login.php">Login</a>
      <a href="createuser.php">Register</a>
    </div>

    <div class='title-header'>
        <div class='title-header'>SUPER TOP SECRET LEVEL 10 CLEARENCE CONFIDENTIAL RESTRICTED CLASSIFIED OFF-THE-RECORD INFORMATION</div>
    </div>
      </div>
    </body>
    <body>
    <div class="row" style="padding:40px">
      <div class="col-md-6 center-block text-center">
      <h2>Username: <?php echo $_SESSION['suser'] ?></h2>
      </div>
      <div class="col-md-6 center-block text-center">
      <h2>Password: <?php echo $_SESSION['spw'] ?></h2>
      </div>
    </div>
</body>

<body>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
    </html>

