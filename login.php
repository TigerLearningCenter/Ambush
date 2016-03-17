<?php
	if($_POST)
	{
		$user = $_POST["user"];
		$pass = $_POST["pass"];

		header("Location: home/index.php");
	}
?>