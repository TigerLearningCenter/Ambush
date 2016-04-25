<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../favicon.ico">

    <title>Ambush Classes</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../../css/signin.css" rel="stylesheet">

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
	// Start the session
	session_start();

  $user = $_SESSION['user'];

  //check user logged in
  if (!$user)
  {
    header("Location: ../../error");
  }

  $add_class_exists = false;
  $rm_class_exists = false;
  $add_class = false;
  $removed_class = false;

  if ($_POST)
  {
    $fname = $_SESSION["fname"];
    $lname = $_SESSION["lname"];
    $role = $_SESSION["role"];
    $user = $_SESSION["user"];
    $pass = $_SESSION['pass'];
    $classes = $_SESSION['classes'];

    $conn = new MongoClient("mongodb://127.0.0.1:27017");
    if ($conn)
    {
      if ($_POST['newclass']) //Add class
      {
        if (($key = array_search(strtoupper($_POST['newclass']), $classes)) !== false)
        {
          $add_class_exists = true;
        }
        else
        {
          array_push($classes, strtoupper($_POST['newclass']));
          $addclass = true;
        }
      }
      else if ($_POST['remclass']) //Remove class
      {
        if (($key = array_search(strtoupper($_POST['remclass']), $classes)) !== false)
        {
          unset($classes[$key]);
          $removed_class = true;
        }
        else
        {
          $rm_class_exists = true;
        }
      }

      $users = $conn->selectCollection("project", "users");

      $exist_user = array(
        'user' => $user
      );

      $result = $users->find($exist_user);

      if ($result->count() == 1)
      {
        $result->next();
        $curr = $result->current();

        $newdata = array(
          'user' => $user,
          'pass' => $pass,
          'fname' => $fname,
          'lname' => $lname,
          'permission' => $role,
          'pass' => $pass,
          'clist' => $classes
        );

        $result = $users->update(array('_id' => $curr['_id']), $newdata);

        if ($result['ok'])
        {
          $_SESSION['classes'] = $classes;  
        }
      }
    }
  }
?>

<!-- Header -->
<nav class="navbar navbar-ambush-background">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand navbar-ambush-bold" href="">Ambush Video System</a>
    </div>
    <ul class="nav navbar-nav ulist-ambush">
      <li><a href="../..">Home</a></li>
      <li><a href="..">Classes</a></li>
      <li><a href="../videos">Videos</a></li>      
    </ul>
    <ul class="nav navbar-nav navbar-right ulist-ambush">
      <li><a href="../../account">Account</a></li>
      <li><a href="../../..">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container">
        <div class="col-md-3"></div>
        <div class="col-md-6 navbar-ambush-background" style="border-radius: 15px;">
          <div>
              <h1 style="display: inline-block">Add / Remove Classes</h1>
              <button onclick="location.href='..'" class="btn btn-lg btn-primary" style="float: right; margin-top: 10px;">Back</button>;
          </div>
          <form class="form-signin" method="post" onsubmit="">
            <h2 class="form-signin-heading heading">Add A Class</h2>
            <label for="addclass" class="sr-only">Add A Class</label>
            <input type="text" id="addclass" name="newclass" class="form-control" placeholder="New Class" required autofocus="">
            <?php
                if($add_class_exists == true) 
                  echo "<h4 style='color:#aaa;font-weight: bold;'>Already enrolled in class</h4>";
                else if($add_class == true)
                  echo "<h4 style='color:#aaa;font-weight: bold;'>Successfully added ".strtoupper($_POST['newclass'])."</h4>";
            ?>
            <button class="btn btn-lg btn-success btn-block" type="submit">Submit</button>
          </form>
          <form class="form-signin" method="post" onsubmit="">
            <h2 class="form-signin-heading heading">Remove A Class</h2>
            <label for="removeclass" class="sr-only">Remove A Class</label>
            <input type="text" id="removeclass" name="remclass" class="form-control" placeholder="Old Class" required autofocus="">
            <?php
                if($rm_class_exists == true) 
                  echo "<h4 style='color:#aaa;font-weight: bold;'>Not enrolled in class</h4>";
                else if ($removed_class == true)
                  echo "<h4 style='color:#aaa;font-weight: bold;'>Successfully removed ".strtoupper($_POST['remclass'])."</h4>";
            ?>
            <button class="btn btn-lg btn-danger btn-block" type="submit">Submit</button>
          </form>
        </div>
        <div class="col-md-3"></div>
    </div>

</body>
</html>