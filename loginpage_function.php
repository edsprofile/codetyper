<?php
/*
   Author: Edwin Espinoza, Liz, Clint, Will
   Date: 11/26/2019

   function name: create_login()
   parameters: none
   purpose: return a form for a user to login.
 */
function create_login()
{
?>
    <div class="topnav">
        <a class="active" href="https://nrs-projects.humboldt.edu/~ee181/project/codetyper/loginpage.php">Login</a>
        <h1>Code typer</h1>
    </div>

    <h2>Login</h2>

    <form method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required="required" autofocus="autofocus">

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required="required">

            <button type="submit" value="submit">Login</button>
            <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
            <br>
        </div>

        <div class="container" id="cancel">
            <button type="button" class="cancelbtn">Cancel</button>
        </div>
    </form>

<?php
}

function create_game()
{
    if ((!array_key_exists("username", $_POST)) or
        (!array_key_exists("password", $_POST)) or
        ($_POST["username"] == "") or
        ($_POST["password"] == "") or
        (!isset($_POST["username"])) or
        (!isset($_POST["password"])))
    {
        destroy_and_exit("must enter a username and password!");
    }

    $username = htmlspecialchars($_POST["username"]);
    $password = $_POST["password"];

    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;

    $connection = hsu_connect_session($username, $password);

    
?>
<div class="topnav">
    <a href="">Home</a>
    <form id="leaderform" method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
        <button id="leaderboard" type="submit" value="leaderboard" name="leaderboard">LeaderBoard</button>
    </form>
    <h1>Code typer</h1>
</div>

<h1 class="gametitle">codetyper
    <pre id="display"></pre>
    The code typing game
    <br />
</h1>


<div id="stripe">
    <button id="reset" class="cleanbutton uibutton">New Code</button>
    <span id="info"></span>
    <button id="easybutton" class="mode cleanbutton uibutton">Easy</button>
    <button id="hardbutton" class="mode cleanbutton uibutton selected">Hard</button>
</div>

<textarea name="textarea" spellcheck="false"></textarea>
<button type="submit" name="submit_word" id="submit_word">submit</button>

<form id="signup" method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
    <p>Don't Have An Account?</p>
    <button type="submit" name="create_account" value="create_account" id="sign_up">Sign up</button>
</form>

<?php
}

function create_leaderboard()
{
    $username = strip_tags($_SESSION["username"]);
    $password = $_SESSION["password"];
    $connection = hsu_connect_session($username, $password);

    $leaderboard_query = "select *
                          from cs359score
                          order by score desc";
    $leaderboard_statement = oci_parse($connection, $leaderboard_query);

    oci_execute($leaderboard_statement);

    $count = 1;
?>
    <div class="topnav">
        <a href="">Home</a>
        <form id="leaderform" method="post" action="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
            <button id="leaderboard" type="submit" value="leaderboard" name="leaderboard">LeaderBoard</button>
        </form>
        <h1>Code typer</h1>
    </div>
    
    <h2>CodeTyper: leaderboard</h2>

    <table>
        <thead>
            <tr>
                <th>Ranking</th>
                <th>User</th>
                <th>Scores</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while(oci_fetch($leaderboard_statement))
            {
                $score = oci_result($leaderboard_statement, "SCORE");
                $username = oci_result($leaderboard_statement, "USER_NAME");
            ?>
                <tr>
                    <td><?=$count?></td>
                    <td><?=$username?></td>
                    <td><?=$score?></td>
                </tr>
                <?php
                $count = $count + 1;
                }
                ?>
        </tbody>
    </table>
    <?php
    oci_free_statement($leaderboard_statement);
    oci_close($connection);
    ?>
            <?php
            }

            function hsu_connect_session($username, $password)
            {
                $connection_string = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                      (HOST = cedar.humboldt.edu)
                                      (PORT = 1521))
                                      (CONNECT_DATA = (SID = STUDENT)))";

                $connection = oci_connect($username, $password, $connection_string);

                return $connection;
            }

            function destroy_and_exit($error)
            {
            ?>
                <p>Error: <?= $error ?></p>
                <p><a href="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">Try again.</a></p>
                <?php
                session_destroy();
                exit;
                }

                function create_account()
                {
                ?>
                    <div class="topnav">
                        <a class="active" href="https://nrs-projects.humboldt.edu/~ee181/project/codetyper/loginpage.php">Login</a>

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

                            <button type="submit" value="register" name="register">Register</button>
                            <div class="container" id="cancel">
                                <button type="button" class="cancelbtn">Cancel</button>
                            </div>
                        </div>
                    </form>

                <?php
                }

                function process_account()
                {
                    $firstname = $_POST["firstname"];
                    $lastname = $_POST["lastname"];
                    $personalemail = $_POST["email"];
                    $theusername = $_POST["username"];
                    $thepassword = $_POST["password"];
                    $date = date("d-M-y");
                    $isadmin = 0;
                    $thescore = 0;

                    $db_conn_str = "(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)
                                          (HOST = cedar.humboldt.edu)
                                          (PORT = 1521))
                               (CONNECT_DATA = (SID = STUDENT)))";

                    $username = $_SESSION["username"];
                    $password = $_SESSION["password"];

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

                    //header("location: http://nrs-projects.humboldt.edu/~cs359/loginpage.html");
                    
                    oci_close($conn);

                    exit;
                }

                
                ?>
