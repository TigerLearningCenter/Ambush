<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Ambush Login</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="js/ie-emulation-modes-warning.js"></script>
    </head>

    <body>

    <?php
        session_unset();
        session_start();

        $_SESSION['failed_to_login'] = false;
        if($_POST)
        {
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $conn = new MongoClient("mongodb://127.0.0.1:27017");
            if($conn)
            {
                $users = $conn->selectCollection("project", "users");

                $newuser = array(
                    'user' => $user,
                    'pass' => $pass
                );

                $result = $users->find($newuser);

                if($result->count() == 1)
                {
                    
                    foreach ($result as $document)
                    {
                        $_SESSION['fname'] = $document['fname'];
                        $_SESSION['lname'] = $document['lname'];
                        $_SESSION['user'] = $document['user'];
                        $_SESSION['role'] = $document['permission'];
                        $_SESSION['classes'] = $document['clist'];
                        $_SESSION['pass'] = $document['pass'];
                    }

                    header("Location: home/");
                    exit();
                }
                else
                {
                    $_SESSION['failed_to_login'] = true;
                }
            }
        }
    ?>

    <!-- HEADER -->
    <?php //include 'header.html' ?>

    <nav class="navbar navbar-ambush-background">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand navbar-ambush-bold" href="">Ambush Video System</a>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="col-md-3"></div>
        <div class="col-md-6 navbar-ambush-background" style="border-radius: 15px;">
          <form class="form-signin" method="post" onsubmit="">
            <h2 class="form-signin-heading heading">Sign In</h2>
            <label for="inputEmail" class="sr-only">Email address</label>
            <input type="email" id="inputEmail" name="user" class="form-control" placeholder="Email address" required="" autofocus="">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required="">
            <?php
                if($_SESSION['failed_to_login'] == true) 
                    echo "<h4 style='color:#aaa;font-weight: bold;'>Failed to login</h4>";
            ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign In</button>
          </form>
          <div class="form-signin">
            <button class="btn btn-lg btn-secondary btn-block" onclick="location.href='register'" type="">Register</button>
          </div>
        <div class="col-md-3"></div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
