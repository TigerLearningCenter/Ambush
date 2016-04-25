<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../favicon.ico">

    <title>Ambush Login</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>

    <body>

    <?php
        session_unset();
        session_start();

        $_SESSION['user_exists'] = false;

        if($_POST)
        {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $role = $_POST["userrole"];
            $user = $_POST["user"];
            $pass = $_POST["pass"];

            $conn = new MongoClient("mongodb://127.0.0.1:27017");
            if($conn)
            {
                $users = $conn->selectCollection("project", "users");

                $options = array(
                    'safe' => true,
                    'fsync' => true,
                    'timeout' => 10000
                );

                $searchuser = array(
                    'user' => $user,
                );

                $checkexisting = $users->find($searchuser, $options);

                if($checkexisting->count() == 0) //new user
                {
                    $newuser = array(
                        'user' => $user,
                        'pass' => $pass,
                        'fname' => $fname,
                        'lname' => $lname,
                        'permission' => $role,
                        'clist' => array()
                    );

                    $result = $users->insert($newuser, $options);

                    if($result["ok"])
                    {
                        $_SESSION['fname'] = $fname;
                        $_SESSION['lname'] = $lname;
                        $_SESSION['user'] = $user;
                        $_SESSION['role'] = $role;
                        $_SESSION['pass'] = $pass;
                        $_SESSION['classes'] = array();
                        header("Location: ../home/");
                    }
                }
                else //user already exists
                {
                    $_SESSION['user_exists'] = true;
                }
    
            }
            else echo "Connection failed";
        }
    ?>

    <!-- HEADER -->
    <nav class="navbar navbar-ambush-background">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand navbar-ambush-bold" href="..">Ambush Video System</a>
        </div>
      </div>
    </nav>

    <div class="container">
        <div class="col-md-3"></div>
        <div class="col-md-6 navbar-ambush-background" style="border-radius: 15px;">
          <form class="form-signin" method="post" onsubmit="">
            <h2 class="form-signin-heading heading">Create Account</h2>

            <label for="inputFName" class="sr-only">First Name</label>
            <input type="text" id="inputFName" name="fname" class="form-control" placeholder="First Name" required autofocus="">

            <label for="inputLName" class="sr-only">Last Name</label>
            <input type="text" id="inputLname" name="lname" class="form-control" placeholder="Last Name" required autofocus="">

            <label for="roleList" class="sr-only">Role</label>
            <select class="form-control" id="roleList" name="userrole">
                <option>Student</option>
                <option>TA</option>
                <option>Professor</option>
            </select>

            <label for="inputEmail" class="sr-only">Email Address</label>
            <input type="email" id="inputEmail" name="user" class="form-control" placeholder="Email address" required autofocus="">
            
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="Password" required>

            <?php
                if($_SESSION['user_exists'] == true) 
                    echo "<h4 style='color:#aaa;font-weight: bold;'>User already exists</h4>";
            ?>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
          </form>
          <div class="form-signin">
            <button class="btn btn-lg btn-secondary btn-block" onclick="javascript:window.location='..'" type="">Back to Sign In</button>
          </div>
        </div>
        <div class="col-md-3"></div>
    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
