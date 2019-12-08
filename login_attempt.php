<?php

//session_start();
	/*
	if(isset($_SESSION['uname']))
	{
		header("location: game.html");
		exit();
	}
	*/
		$uname = $_POST["uname"];
		$psw = $_POST["psw"];
        require_once("destroy_and_exit.php");
        require_once("hsu_conn_sess.php");
		require_once("random.php");
		
    if ( (! array_key_exists("uname", $_POST)) or
         (! array_key_exists("psw", $_POST)) or
         ($_POST["uname"] == "") or
         ($_POST["psw"] == "") or
         (! isset($_POST["uname"])) or
         (! isset($_POST["psw"])) )
    {
        destroy_and_exit("must enter a username and password!");
    }

    $uname = strip_tags($_POST["uname"]);  
    $psw = $_POST["psw"];


    //   NOW: can you connect to Oracle with them?
    //     (NOTE that hsu_conn_sess destroys session and
    //     exits the PHP document if it fails...!)
	
	$username = "java";
	$password = "java";
	
    $conn = hsu_conn_sess($username, $password);

    // if reach here -- CONNECTED!

    // try to query department names; I am desiring to grab their
    //     numbers, too

	$query_str_one = 'select *
				  from cs359user
				  where user_name = :unameone
				  and password = :pswone';
	$query_one = oci_parse($conn, $query_str_one);
	oci_bind_by_name($query_one, ":unameone", $uname);
	oci_bind_by_name($query_one, ":pswone", $psw);
	oci_execute($query_one, OCI_DEFAULT);
	oci_fetch($query_one);
	{
		$curr_username = oci_result($query_one, "USER_NAME");
		$curr_password = oci_result($query_one, "PASSWORD");
		if($curr_username == $uname and $curr_password == $psw)
		{
			//$uname = $_POST["uname"];
			//$_SESSION['uname'] = $uname;
			//$url = "random.php";
			$url = "game.html";
			header( 'location: ' . $url);
			
			
			
			
			header("location: http://nrs-projects.humboldt.edu/~cs359/game.html");
		exit();
		}
		else
		{
			destroy_and_exit("incorrect username and password!");
			//session_destroy();
			//unset($_SESSION['uname']);
		}
	}

    oci_close($conn);

?>