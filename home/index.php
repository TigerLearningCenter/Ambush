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
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

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
       <li><a href="classes/cv">CV</a></li>
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
			<div class="col-md-3 background-color: inherit">
				<div class="quote-container">
				      <i class="pin"></i>
				  <blockquote class="note yellow">
				    We can't solve problems by using the same kind of thinking we used when we created them.
				    <cite class="author">Albert Einstein</cite>
				  </blockquote>
				</div>
			</div>
			<div class="col-md-3 background-color: inherit">
				<div class="quote-container">
				      <i class="pin"></i>
				  <blockquote class="note yellow">
				    We can't solve problems by using the same kind of thinking we used when we created them.
				    <cite class="author">Terry Ballou</cite>
				  </blockquote>
				</div>
			</div>
			<div class="col-md-3 background-color: inherit">
				<div class="quote-container">
				      <i class="pin"></i>
				  <blockquote class="note yellow">
				    We can't solve problems by using the same kind of thinking we used when we created them.
				    <cite class="author">Clark Kent</cite>
				  </blockquote>
				</div>
			</div>
			<div class="col-md-3 background-color: inherit">
				<div class="quote-container">
				      <i class="pin"></i>
				  <blockquote class="note yellow">
				    We can't solve problems by using the same kind of thinking we used when we created them.
				    <cite class="author">Bruce Wayne</cite>
				  </blockquote>
				</div>
			</div>
		</div>
		<div>
			
		</div>
	</div>
</div>	

	<!--
 	<div class="container">
		<h1>Welcome <?php //echo $_SESSION['fname'] . " " . $_SESSION['lname']; ?></h1>
		<h1><?php //echo $_SESSION['user']; ?></h1>
		<table class="announcementsTable" id="theAnnouncementsTable">

			<tr class="announcements">
				<td class="ancmnt">Message 1</td>
				<td class="ancmnt">Message 2</td>
				<td class="ancmnt">Message 3</td>
				<td class="ancmnt">Message 4</td>
				<td class="ancmnt">Message 5</td>
				<td class="ancmnt">Message 6</td>
				<td class="ancmnt">Message 7</td>
				<td class="ancmnt"></td>
			</tr>

		</table>
		<button onclick="addAnnouncement()">Try it</button>
	</div> -->
	<!-- END OF ANNOUNCEMENTS DIV -->


<!-- START OF CLASS DIV -->
<!-- <div class="container">

	<div class="topBar">
		
		<div class="classHeader">
			<h1>Classes</h1>

		</div>

		<div class="searchBar">
			<form>Search: <input type="text" name="searchText"></form>
		</div>

	</div>

	<table class="classTable" id="theClassTable">
		<tr>
			<?php 
				//foreach($_SESSION['classes'] as $key=>$value)
			    {
			    	//echo '<td class="d2"><a href="http://159.203.77.167/ambush/home/classes/index.php?class='.$value[cname]. '">'.$value[cname].'</a></td>';
			    }
		    ?>
		</tr>

		<tr>
			<td class="d2">Class 1</td>
		</tr>
		<tr>
			<td class="d2">Class 2</td>
		</tr>
		<tr>
			<td class="d2">Class 3</td>
		</tr>
		<tr>
			<td class="d2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin eget sollicitudin lectus, nec euismod nisi. Cras hendrerit nec sapien eu gravida. Donec eu mi nisl. Aliquam vitae turpis metus. Maecenas vel pellentesque sem, ut malesuada eros. Nulla in orci tortor. Suspendisse in diam et massa ultricies rutrum eget sed libero. Aliquam erat volutpat. Vestibulum ac posuere justo, dictum luctus augue. Quisque imperdiet odio vel arcu volutpat, sed lacinia arcu consequat. Ut feugiat consequat turpis non interdum. Curabitur suscipit tortor tellus, ut condimentum velit commodo vitae. Morbi nulla nunc, lobortis sed ultrices quis, fermentum a mi. Praesent bibendum lorem sagittis erat blandit tempus. Quisque ullamcorper quam et odio mollis, non vehicula massa faucibus.</td>
		</tr>
		<tr>
			<td class="d2">Class 5</td>
		</tr>
		<tr>
			<td class="d2">Class 6</td>
		</tr>

	</table>

	<button onclick="addClass()">Try it</button>

</div>-->


<script> 
/*add a announcements*/


/*add a class function*/
function addClass() {
    var table = document.getElementById("theClassTable");
    	var row = table.insertRow(0);

    	var cell1 = row.insertCell(0);

    	cell1.innerHTML = "Class 1";
	}
</script>

</body>
</html>
