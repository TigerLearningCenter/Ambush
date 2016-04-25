<!DOCTYPE html>
<html>
<head lang="en">
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../favicon.ico">

    <title>Ambush Videos</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../../css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link href="src/css/scojs.css" rel="stylesheet">
    <link href="src/css/colpick.css" rel="stylesheet">
    <link href="src/css/bootstrap.css" rel="stylesheet">
    <link rel="stylesheet" href="src/css/main.css">

</head>
<body>
<?php
	session_start();

	$user = $_SESSION['user'];
	if (!$user)
	{
		header("Location: ../../error");
	}
?>
<nav class="navbar navbar-ambush-background">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand navbar-ambush-bold" href="">Ambush Video System</a>
    </div>
    <ul class="nav navbar-nav ulist-ambush">
      <li><a href="../..">Home</a></li>
      <li><a href="..">Classes</a></li>
      <li class="active"><a href="">CV</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right ulist-ambush">
      <li><a href="../../account">Account</a></li>
      <li><a href="../../..">Logout</a></li>
    </ul>
  </div>
</nav>

<div id="danmup" style="left: 50%;margin-left:-400px;top:100px">

</div>
<div style="display: none">
  <span class="glyphicon" aria-hidden="true">&#xe072</span>
  <span class="glyphicon" aria-hidden="true">&#xe073</span>
  <span class="glyphicon" aria-hidden="true">&#xe242</span>
  <span class="glyphicon" aria-hidden="true">&#xe115</span>
  <span class="glyphicon" aria-hidden="true">&#xe111</span>
  <span class="glyphicon" aria-hidden="true">&#xe096</span>
  <span class="glyphicon" aria-hidden="true">&#xe097</span>
</div>


</body>
<script src="src/js/jquery-2.1.4.min.js"></script>
<script src="src/js/jquery.shCircleLoader.js"></script>
<script src="src/js/sco.tooltip.js"></script>
<script src="src/js/colpick.js"></script>
<script src="src/js/jquery.danmu.js"></script>
<script src="src/js/main.js"></script>
<!--<script src="../dist/js/danmuplayer.min.js"></script>-->
<script>
  $("#danmup").DanmuPlayer({
    src:"SampleVideo.mp4",
    height: "480px", //Area Height
    width: "800px" //Area Width
    ,urlToGetDanmu:"query.php"
    ,urlToPostDanmu:"stone.php"
  });
  $("#danmup .danmu-div").danmu("addDanmu",[
    { "text":"HAHAHAHAHAH" ,color:"white",size:1,position:0,time:2}
    ,{ "text":"lol lol lol" ,color:"green",size:1,position:0,time:3}
    ,{ "text":"This is cool" ,color:"black",size:1,position:0,time:10}
    ,{ "text":"how is everybody doing?" ,color:"yellow" ,size:1,position:1,time:3}
    ,{ "text":"Hello World" , color:"red" ,size:1,position:2,time:9}
    ,{ "text":"Hello everyone" ,color:"orange",size:1,position:1,time:3}
    ,{ "text":"Anyone watching it with me now?" ,color:"orange",size:1,position:1,time:3}
    ,{ "text":"Greeting" ,color:"yellow" ,size:1,position:1,time:5}
    ,{ "text":"Hellooooooo" ,color:"yellow" ,size:1,position:1,time:5}
    ,{ "text":"You can also add comment" ,color:"Red" ,size:1,position:3,time:10}
  ])
</script>
</html>