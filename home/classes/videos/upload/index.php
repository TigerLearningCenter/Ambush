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

    <title>Ambush Upload</title>

    <!-- Bootstrap core CSS -->
    <!-- <link href="../css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../../../css/signin.css" rel="stylesheet">

    <!-- Video Recording Script -->
    <!-- <script src="../../../../js/record.js"></script> -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../js/ie-emulation-modes-warning.js"></script>

    <!-- Video player script and skin -->
    <link href="../../../../css/video-js.css" rel="stylesheet">
    <script src="../../../../js/video.js"></script>

    <!-- jQuery -->
    <script src="../../../../js/jquery-2.2.3.js"></script>

    <!-- JavaScript for upload page -->
    <script src="upload.js"></script>

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
    header("Location: ../../../../error");
  }

  error_log("On the upload page\n", 3, "/usr/share/nginx/html/ambush/home/phplog.info");

  $page = 1;
  $uploadok = 1;

  //Form has been submitted
  if ($_POST || $_FILES)
  {
    if ($_POST)
    {
      $page = 2;
      $_SESSION['vname'] = $_POST['vname'];
      $_SESSION['vclass'] = strtoupper($_POST['vclass']);
      $_SESSION['vdescription'] = $_POST['vdescription'];
    }
    else if ($_FILES)
    {
      error_log("We got into the FILES IF\n", 3, "/usr/share/nginx/html/ambush/home/phplog.info");
      $vname = $_SESSION['vname'];
      $vclass = $_SESSION['vclass'];
      $vdescription = $_SESSION['vdescription'];

      if ($_FILES['fileupload']) //Video upload
      {
        $dir = '/hls/live/'.$_SESSION['vclass'].'/';
        $ext = pathinfo($_FILES['fileupload']['name'], PATHINFO_EXTENSION);
        $file = $dir.basename($_SESSION['vname'].'.'.$ext);

        // Check if file already exists
        if (file_exists($file))
        {
          $page = 4;
        }
        else
        {
          if ($ext == 'mp4' || $ext == 'webm' || $ext == 'flv' || $ext == '3gp' || $ext == 'ogg' || $ext == "MOV")
          {
            //Create directory for class if not exists
            if (!file_exists($dir))
            {
                mkdir($dir, 0777, true);
            }

            //Move file to class
            if (move_uploaded_file($_FILES['fileupload']['tmp_name'], $file))
            {

              $conn = new MongoClient("mongodb://127.0.0.1:27017");
              if($conn)
              {
                $videos = $conn->selectCollection("project", "videos");

                $vinfo = array(
                  'vname' => $vname,
                  'ext' => $ext,
                  'vdescription' => $vdescription,
                  'class' => $vclass,
                  'date' => date()
                );

                $result = $videos->insert($vinfo);

                $page = 3;
              }
            }
            else
            {

            }
          }
        }
      }
    }
    else
    {
      error_log("No FILE or POST for this request\n", 3, "/usr/share/nginx/html/ambush/home/phplog.info");
    }
  }
  else
  {
    // error_log("Unsetting session variables\n", 3, "/usr/share/nginx/html/ambush/home/phplog.info");
    // unset($_SESSION['vname']);
    // unset($_SESSION['vclass']);
    // unset($_SESSION['vdescription']);
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
    <div class="col-md-3"></div>
    <div class="col-md-6 navbar-ambush-background" style="border-radius: 15px;">
      <div>
          <h1 style="display: inline-block">Add A Video</h1>
          <button onclick="location.href='..'" class="btn btn-lg btn-danger" style="float: right; margin-top: 10px;">Cancel</button>;
      </div>
        <?php
          if ($page == 3)
              echo 
                '<div class="alert alert-success">
                  <strong>Success!</strong> Video successfully uploaded
                </div>';
          else if ($page == 4)
            echo 
                '<div class="alert alert-danger">
                  <strong>Failure!</strong> '.$_SESSION['vname'].' already exists for '.$_SESSION['vclass'].'
                </div>';
        ?>
        <?php
          if ($page == 1 || $page == 3 || $page == 4)
            echo '<div class="form-signin">';
          else
            echo '<div class="form-signin" style="display:none;">';
        ?>
        <form method="post" onsubmit="">
          <h2 class="form-signin-heading heading">Video Info</h2>
          <label for="vname" class="sr-only">Title</label>
          <input type="text" id="vname" name="vname" class="form-control" placeholder="Title" required>
          <label for="vclass" class="sr-only">Class</label>
          <input type="text" id="vclass" name="vclass" class="form-control" placeholder="Class" required>
          <label for="vdescription" class="sr-only">Description</label>
          <textarea id="vdescription" name="vdescription" class="form-control" placeholder="Description" required></textarea>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </form>
      </div>

        <?php
          if ($page == 2)
            echo '<div class="form-signin">';
          else
            echo '<div class="form-signin" style="display:none;">';
        ?>
        <form method="post" enctype="multipart/form-data">
          <h2 class="form-signin-heading heading">Upload a Video</h2>
          <span class="btn btn-lg btn-secondary btn-file btn-block">
              Browse <input type="file" name="fileupload" accept=".mp4,.webm,.ogg" required>
          </span>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
        </form>
      </div>

      
        <?php
          if ($page == 2)
            echo '<div class="form-signin">';
          else
            echo '<div class="form-signin" style="display:none;">';
        ?>
        <h2 class="form-signin-heading heading">Record a Video</h2>
        <?php
          if ($page == 2)
            echo '<video autoplay style="width: 100%"></video>';
        ?>
        <button id="start-me" class="btn btn-lg btn-success btn-block" onclick="javascript:stop()">Start</button>
        <button id="stop-me" class="btn btn-lg btn-danger btn-block" onclick="javascript:stop()">Stop</button>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
      </div>
    </div>

    <div class="col-md-3"></div>
</div>

<!-- Webcam recorder -->
<script type="text/javascript">
  var video = document.querySelector('video');
  video.autoplay = true; // Make sure we're not frozen!

  navigator.getUserMedia = ( navigator.getUserMedia ||
                       navigator.webkitGetUserMedia ||
                       navigator.mozGetUserMedia ||
                       navigator.msGetUserMedia);

  navigator.getUserMedia({video: true}, function(stream) {
    video.src = window.URL.createObjectURL(stream);
  }, function(e) {
    console.error(e);
  });
</script>

</div>
</body>
</html>