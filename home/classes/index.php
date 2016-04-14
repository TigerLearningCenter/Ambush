

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
	// Start the session
	session_start();

  $user = $_SESSION['user'];

  //check user logged in
  if (!$user)
  {
    header("Location: ../../error");
  }

  //THIS WAS GETTING A 500 ERROR
	// $conn = new MongoClient("mongodb://127.0.0.1:27017");
	// if($conn)
	// {
	//     $class = $conn->selectCollection("project", "courses");


	//     $result = $class->find($_GET['class']);

	//     if($result->count() > 0)
	//     {
	        
	//         foreach ($result as $document) 
	//         {
	//             $_SESSION['videos'] = $document["vlist"];
	//         }
	//     }
	// }
	// else echo "Connection failed";
?>

<!-- Header -->
<nav class="navbar navbar-ambush-background">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand navbar-ambush-bold" href="">Ambush Video System</a>
    </div>
    <ul class="nav navbar-nav ulist-ambush">
      <li><a href="..">Home</a></li>
      <li class="active"><a href="">Classes</a></li>
      <li><a href="videos">Videos</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right ulist-ambush">
      <li><a href="../account">Account</a></li>
      <li><a href="../..">Logout</a></li>
    </ul>
  </div>
</nav>

<!-- <div class="container">
	<div class="topBar">
		
		<?php echo "<h1>".$_GET['class']."</h1>"; ?>

	</div>
	<div class="topBar">
		<table class="announcementsTable">
			<tr class="announcements">
				
				<td class="ancmnt">Class 2</td>
				<td class="ancmnt">Class 3</td>
				<?php 
					foreach($_SESSION['videos'] as $key=>$value){
				    	echo '<td class="ancmnt"><a href="http://159.203.77.167/player'.$value[vname].'</td>'; 
				    }
		    	?>

			</tr>
		</table>

	</div>
</div> -->

<div class="container">
    <div class="col-md-3"></div>
    <div class="col-md-6 navbar-ambush-background" style="border-radius: 15px;">
        <h1>Classes</h1>
        <ul>
            <li>
                <h3><a href="videos?class=CS1050">CS1050</a></h3>
            </li>
            <li>
                <h3><a href="videos?class=CS2050">CS2050</a></h3>
            </li>
        </ul>
    </div>
    <div class="col-md-3"></div>
</div>

</body>
</html>