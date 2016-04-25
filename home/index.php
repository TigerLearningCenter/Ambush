<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../favicon.ico">

    <title>Ambush Home</title>

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
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<?php
	session_start();

	$user = $_SESSION['user'];
	if (!$user)
	{
		header("Location: ../error");
	}

	//TODO
	//Pull list of videos within last week based on classes in users profile

	$conn = new MongoClient("mongodb://127.0.0.1:27017");
	if($conn)
	{
	    $videos = $conn->selectCollection("project", "videos");

	    $user_classes = $_SESSION['classes'];

	    $announcements = array();

	    foreach ($user_classes as $c)
	    {
	    	$query = array('class' => $c);

	    	$result = $videos->find($query);
	    	foreach ($result as $res)
	    	{
	    		array_push($announcements, $res);
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
      <li class="active"><a href="">Home</a></li>
      <li><a href="classes">Classes</a></li>
      <li><a href="classes/videos">Videos</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right ulist-ambush">
      <li><a href="account">Account</a></li>
      <li><a href="..">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container">
	<div class="col-md-12 navbar-ambush-background" style="border-radius: 15px;">
		<div id="announcements">
			<h1>Announcements</h1>
			<?php
				function escape_str($string)
				{
					$encoded = urlencode($string);
					$encoded = str_replace('+', '%20', $encoded);
					return $encoded;
				}

				foreach ($announcements as $a)
				{
					echo '<a href="classes/videos/watch/?class='.escape_str($a['class']).'&video='.escape_str($a['vname']).'&ext='.escape_str($a['ext']).'">';
					echo '<div class="col-md-3 background-color: inherit">';
					echo '<div class="quote-container">';
					echo '<i class="pin"></i>';
					echo '<blockquote class="note yellow">';
					echo $a['vdescription'];
					echo '<cite class="author">';
					echo $a['class'];
					echo '</cite>';
					echo '</blockquote>';
					echo '</div>';
					echo '</div>';
					echo '</a>';
				}
			?>
		</div>
		<div>
			
		</div>
	</div>
</div>	

</body>
</html>