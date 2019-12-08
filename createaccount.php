<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">

  <head>
    <meta charset="UTF-8" />
    <title>CodeTyper</title>
    <?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    ?>
    <!-- link to normalize.css -->
    <link href="https://nrs-projects.humboldt.edu/~st10/styles/normalize.css"
          type="text/css" rel="stylesheet" />
    <!-- links to css -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css"
          type="text/css" rel="stylesheet" />
    
    <link href="assets/css/typing.css" type="text/css" rel="stylesheet" />
    
    <link href="loginpage.css" rel="stylesheet">
  </head>

  <body>
      <div class="topnav">
          <a class="active" href="http://nrs-projects.humboldt.edu/~ee181/project/codetyper/loginpage.php">Login</a>
          <h1>Code typer</h1>
      </div>
      
      <h2>Create Account</h2>
      <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
          <div class="container">
              <label for="firstname"><b>First Name:</b></label>
              <input type="text" placeholder="Enter First Name..." name="firstname" required="required">
              
              <label for="lastname"><b>Last Name:</b></label>
              <input type="text" placeholder="Enter Last Name..." name="lastname" required="required">

              <label for="email"><b>Email:</b></label>
              <input type="text" placeholder="Enter Email..." name="email" required="required">
              
              <label for="username"><b>Username</b></label>
              <input type="text" placeholder="Enter Username" name="username" required="required">

              <label for="password"><b>Password</b></label>
              <input type="password" placeholder="Enter Password" name="password" required="required">

              <button type="submit" value="submit">Register</button>
              <div class="container" id="cancel">
                  <button type="button" class="cancelbtn">Cancel</button>
              </div>
          </div>
      </form>
  </body>
</html>

<?php

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$personalemail = $_POST["personalemail"];
$theusername = $_POST["theusername"];
$thepassword = $_POST["thepassword"];
$date = date("d-M-y");
$isadmin = 0;
$thescore = 0; 

// removed username and password this code does not work currently this is for documentation

$db_conn_str = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                          (HOST = cedar.humboldt.edu)
                                          (PORT = 1521))
                               (CONNECT_DATA = (SID = STUDENT)))";

        $conn = oci_connect($username, $password, $db_conn_str);
if (! $conn)
{
	echo "Could not connect";
	exit;
}

$query_str_one = 'select *
		  from cs359user
		  where user_name = :unameone';
	$query_one = oci_parse($conn, $query_str_one);
	oci_bind_by_name($query_one, ":unameone", $theusername);
	oci_execute($query_one, OCI_DEFAULT);
	oci_fetch($query_one);
	{
		$curr_username = oci_result($query_one, "USER_NAME");
		if($curr_username == $theusername)
		{
		echo "User name already taken make new username";
		//hearder( 'refresh:5; url=http://nrs-projects.humboldt.edu/~cs359/createaccount.htmlid='.$uname);
		}
		else
		{
				$sql_insert = "insert into cs359user values(:personalemail, :firstname, 
				:lastname, :theusername, :thepassword, '$date', '$isadmin')"; 
  
		$compiled = oci_parse($conn, $sql_insert);
  
			oci_bind_by_name($compiled, ":firstname", $firstname);
			oci_bind_by_name($compiled, ":lastname", $lastname);
			oci_bind_by_name($compiled, ":personalemail", $personalemail);
			oci_bind_by_name($compiled, ":theusername", $theusername);
			oci_bind_by_name($compiled, ":thepassword", $thepassword);

			oci_execute($compiled);
			echo "Account Created";
			
			$sql_insertone = "insert into cs359score
			values('$thescore', :theusername)"; 
			$compiled = oci_parse($conn, $sql_insertone);
			
			oci_bind_by_name($compiled, ":theusername", $theusername);
			
			oci_execute($compiled);
		}
	}

    //header("location: http://nrs-projects.humboldt.edu/~cs359/loginpage.html");
	
oci_close($conn);

exit;
?>
