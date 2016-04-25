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

    <title>Ambush Watch</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script><style type="text/css"></style>

    <!-- Video player script and skin -->
    <!-- <link href="../../../../css/video-js.css" rel="stylesheet"> -->
    <!-- <script src="../../../../js/video.js"></script> -->

    <!-- Custom styles for this template -->
    <link href="../../../../css/signin.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- <link rel="stylesheet" type="text/css" href="main.css" /> -->
</head>
<body>

<?php
	session_start();

  $user = $_SESSION['user'];

  //check user is logged in
  if (!$user)
  {
    header("Location: ../../../../error");
  }
?>

<!-- Header -->
<nav class="navbar navbar-ambush-background">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand navbar-ambush-bold" href="">Ambush Video System</a>
    </div>
    <ul class="nav navbar-nav ulist-ambush">
      <li><a href="../../..">Home</a></li>
      <li><a href="../..">Classes</a></li>
      <li><a href="..">Videos</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right ulist-ambush">
      <li><a href="../../../account">Account</a></li>
      <li><a href="../../../..">Logout</a></li>
    </ul>
  </div>
</nav>

<div class="container">
  <div class="col-md-2"></div>
  <div class="col-md-8 navbar-ambush-background" style="border-radius: 15px;">
    <div>
        <h1 style="display: inline-block"><?php echo $_GET['video']; ?></h1>
        <?php
          if ($_SESSION['role'] != 'Student')
          {
            echo '<button onclick="location.href=\'..\'" class="btn btn-lg btn-danger" style="float: right; margin-top: 10px;">Remove</button>';
          }
        ?>
    </div>
    <?php
      if($_GET)
      {
        function escape_str($string)
        {
          $encoded = urlencode($string);
          $encoded = str_replace('+', '%20', $encoded);
          return $encoded;
        }

        $class = $_GET['class'];
        $video = $_GET['video'];
        $ext = $_GET['ext'];

        echo 
          '<video id="video" class="" controls preload="auto" width="100%" height="" poster="" data-setup="{}">
            <source src="/live/'.$class.'/'.$video.'.'.$ext.'" type="video/mp4">
            <p class="">
              You cannot view this video with your current browser. We recommend you download Google Chrome <a href="https://www.google.com/chrome/browser/desktop/">here</a>
            </p>
          </video>';
      }
      else
      {
        echo '<a href=".."><h1>Please select a video to watch</h1></a>';
      }
    ?>

    <div class="form-signin" style="max-width: 500px;">
      <!-- <form method="post" onsubmit=""> -->
          <h2 class="form-signin-heading heading">Leave A Comment</h2>
          <label for="addcomment" class="sr-only">Description</label>
          <textarea id="addcomment" name="addcomment" class="form-control" placeholder="Comment" required></textarea>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Post</button>
        <!-- </form> -->
    </div>

    <div style="text-align: center; margin-right: 15px;">
      <div class="talk-bubble tri-right round left-in">
        <div class="talktext">
          <p style="min-height: 50px; color: #aaa; font-size: 16px;"><strong>Terry:</strong><br>I really liked this video. I thought it was very educational.</p>
        </div>
      </div>
      <div class="talk-bubble tri-right round left-in">
        <div class="talktext">
          <p style="min-height: 50px; color: #aaa; font-size: 16px;"><strong>Terry:</strong><br>I really liked this video. I thought it was very educational.</p>
        </div>
      </div>
      <div class="talk-bubble tri-right round left-in">
        <div class="talktext">
          <p style="min-height: 50px; color: #aaa; font-size: 16px;"><strong>Terry:</strong><br>I really liked this video. I thought it was very educational.</p>
        </div>
      </div>
      <div class="talk-bubble tri-right round right-in" style="float: right;">
        <div class="talktext">
          <p style="min-height: 50px; color: #aaa; font-size: 16px;"><strong>Terry:</strong><br>I really liked this video. I thought it was very educational.</p>
        </div>
      </div>
      <div class="talk-bubble tri-right round left-in">
        <div class="talktext">
          <p style="min-height: 50px; color: #aaa; font-size: 16px;"><strong>Terry:</strong><br>I really liked this video. I thought it was very educational.</p>
        </div>
      </div>
    </div>

  </div>
  <div class="col-md-2"></div>
</div>

</body>
</html>