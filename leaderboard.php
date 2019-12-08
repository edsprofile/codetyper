
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 60%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<link href ="loginpage.css" rel ="stylesheet">

<div class="topnav">
  <a href="http://nrs-projects.humboldt.edu/~cs359/game.html">Game</a>
  <a class="active" href="http://nrs-projects.humboldt.edu/~cs359/leaderboard.php">LeaderBoard</a>
  <a href="">Forum</a>
  <!--<a class="active" href="http://nrs-projects.humboldt.edu/~cs359/loginpage.html">Login</a>
   -->
</div>

<h2>Leaderboard</h2>
<table>
	<tr>
		<th>Username </th>
		<th>Score </th>
	</tr>
<?php

$username = "java"; 
$password = "java";

$db_conn_str =
            "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                       (HOST = cedar.humboldt.edu)
                                       (PORT = 1521))
                            (CONNECT_DATA = (SID = STUDENT)))";

        $conn = oci_connect($username, $password, $db_conn_str);

$query_str = 'select user_name, score
			  from cs359score
			  order by score desc';

$query = oci_parse($conn, $query_str);
oci_execute($query, OCI_DEFAULT);
while(oci_fetch($query))
{
	$curr_username = oci_result($query, "USER_NAME");
	$curr_score = oci_result($query, "SCORE");
?>

	<tr>
		<th><?= $curr_username ?></th>
		<th><?= $curr_score?></th>
	</tr>

	<?php
}



oci_close($conn);

?>
 </table> 

</body>
</html>