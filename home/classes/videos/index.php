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
    <script src="../js/ie-emulation-modes-warning.js"></script>

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

    //check user is logged in
    if (!$user)
    {
        header("Location: ../../../error");
    }
?>
<script id="cid0020000122617216272" data-cfasync="false" async src="//st.chatango.com/js/gz/emb.js" style="width: 231px;height: 359px;">{"handle":"ambushchatroom","arch":"js","styles":{"a":"f1b82d","b":100,"c":"000000","d":"000000","k":"f1b82d","l":"f1b82d","m":"f1b82d","p":"10","q":"f1b82d","r":100,"pos":"br","cv":1,"cvbg":"f1b82d","cvw":300,"cvh":36,"ticker":1,"fwtickm":1}}</script>

<!-- Header -->
<nav class="navbar navbar-ambush-background">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand navbar-ambush-bold" href="">Ambush Video System</a>
    </div>
    <ul class="nav navbar-nav ulist-ambush">
      <li><a href="../..">Home</a></li>
      <li><a href="..">Classes</a></li>
      <li class="active"><a href="">Videos</a></li>
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
            <h1 style="display: inline-block">Videos</h1>
            <?php
                if (strtoupper($_SESSION['role']) != "STUDENT")
                {
                    // echo 
                    // '<button onclick="location.href=\'remove\'" class="btn btn-lg btn-danger" style="float: right; margin-top: 10px; margin-left: 5px;">Remove Video</button>';
                    echo 
                    '<button onclick="location.href=\'upload\'" class="btn btn-lg btn-primary" style="float: right; margin-top: 10px;">Add Video</button>';
                }
            ?>
        </div>
        <ul>
            <?php
                function escape_str($string)
                {
                    $encoded = urlencode($string);
                    $encoded = str_replace('+', '%20', $encoded);
                    return $encoded;
                }

                //Get classes by GET or SESSION
                $classes;
                if ($_GET)
                {
                    $classes = array('classes' => $_GET['class']);
                }
                else
                {
                    $classes = $_SESSION['classes'];
                }
                
                $conn = new MongoClient("mongodb://127.0.0.1:27017");
                if ($conn)
                {
                    //Iterate over classes and echo List of classes
                    foreach ($classes as $c)
                    {
                        echo "<li><h3>".$c."</h3>";

                        $videos = $conn->selectCollection("project", "videos");

                        $query = array('class' => $c);

                        $result = $videos->find($query);

                        //Iterate through class to get videos and echo list item
                        foreach ($result as $v)
                        {
                            echo '<li style="padding-left:10px;"><a href="watch/?class='.escape_str($v['class']).'&video='.escape_str($v['vname']).'&ext='.escape_str($v['ext']).'"><h4>'.$v["vname"].'</h4></a></li>';
                            echo '<p style="padding-left:20px;">'.$v['vdescription'].'</p>';
                        }

                        echo "</li>";
                    }
                }
            ?>
        </ul>
    </div>
    <div class="col-md-3"></div>
</div>

</body>
</html>
