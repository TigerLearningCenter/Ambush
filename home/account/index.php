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

    <title>Ambush Account</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php
	session_start();

    $user = $_SESSION['user'];
    if (!$user)
    {
        header("Location: ../../error");
    }

	$_SESSION['settings_saved'] = false;

    if ($_POST)
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

            $exist_user = array(
                'user' => $_SESSION['user']
            );

            $cursor = $users->find($exist_user);

            if($cursor->count() == 1)
            {
            	$cursor->next();
            	$curr = $cursor->current();

            	$newdata = array(
                    'user' => $user,
                    'pass' => $pass,
                    'fname' => $fname,
                    'lname' => $lname,
                    'permission' => $role,
                    'clist' => $_SESSION['classes']
                );

            	$cursor = $users->update(array('_id' => $curr['_id']), $newdata);

            	if ($cursor['ok'])
            	{
            		$updateuser = array(
		                'user' => $user
		            );

            		$updated = $users->find($updateuser);

            		foreach ($updated as $document)
	                {
	                    $_SESSION['fname'] = $document['fname'];
                        $_SESSION['lname'] = $document['lname'];
                        $_SESSION['user'] = $document['user'];
                        $_SESSION['role'] = $document['permission'];
                        $_SESSION['classes'] = $document["clist"];
	                }
	                $_SESSION['settings_saved'] = true;	
            	}
            }
        }
        else echo "Connection failed";
    }
    else
    {
    	$fname = $_SESSION['fname'];
	    $lname = $_SESSION['lname'];
	    $user = $_SESSION['user'];
	    $role = $_SESSION['role'];
    }
?>

<!-- Header -->
<nav class="navbar navbar-ambush-background">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand navbar-ambush-bold" href="">Ambush Video System</a>
    </div>
    <ul class="nav navbar-nav ulist-ambush">
      <li><a href="..">Home</a></li>
      <li><a href="../classes">Classes</a></li>
      <li><a href="../classes/videos">Videos</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right ulist-ambush">
      <li class="active"><a href="">Account</a></li>
      <li><a href="../..">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6 navbar-ambush-background" style="border-radius: 15px;">
      <form class="form-signin" method="post" onsubmit="">
        <h2 class="form-signin-heading heading">Account Settings</h2>

        <label for="inputFName" class="sr-only">First Name</label>
        <input type="text" id="inputFName" name="fname" class="form-control" placeholder="First Name" required autofocus="" value=<?php echo $fname; ?>>

        <label for="inputLName" class="sr-only">Last Name</label>
        <input type="text" id="inputLname" name="lname" class="form-control" placeholder="Last Name" required autofocus="" value=<?php echo $lname; ?>>

        <label for="roleList" class="sr-only">Role</label>
        <select class="form-control" id="roleList" name="userrole">
            <option><?php echo $role; ?></option>
        </select>

        <label for="inputEmail" class="sr-only">Email Address</label>
        <input type="email" id="inputEmail" name="user" class="form-control" placeholder="Email address" required autofocus="" value=<?php echo $user; ?>>
        
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="pass" class="form-control" placeholder="New Password" required>

        <?php
            if($_SESSION['settings_saved'] == true) 
                echo "<h4 style='color:#aaa;font-weight: bold;'>Saved</h4>";
        ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </form>
      <div class="form-signin">
      <?php
      	if ($_SESSION['settings_saved'] == true)
    		echo '<button class="btn btn-lg btn-secondary btn-block" onclick="javascript:window.location=\'..\'" type="">Home</button>';
      	else
      		echo '<button class="btn btn-lg btn-danger btn-block" onclick="javascript:window.location=\'..\'" type="">Cancel</button>';
      ?>
      </div>
    </div>
    <div class="col-md-3"></div>
</div>
</body>
</html>