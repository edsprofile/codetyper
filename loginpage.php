<?php
session_start();
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Codetyper</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php
        ini_set('display_errors', 1);
        error_reporting(E_ALL);

        require_once("loginpage_function.php");
        ?>
        <!-- link to normalize.css -->
        <link href="https://nrs-projects.humboldt.edu/~st10/styles/normalize.css"
              type="text/css" rel="stylesheet" />
        <!-- links to css -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css"
              type="text/css" rel="stylesheet" />
        
        <link href="assets/css/typing.css" type="text/css" rel="stylesheet" />
        
        <link href="loginpage.css" rel="stylesheet">
        
        <!-- link to javascript -->
        <script type="text/javascript" src="assets/js/lib/jquery-3.4.1.min.js" defer="defer"></script>
        <script type="text/javascript" src="assets/js/typing.js" defer="defer"></script>
    </head>
    <body>

        <?php
        if(!array_key_exists("next_state", $_SESSION))
        {
            create_login();
            $_SESSION["next_state"] = "game";
        }
        elseif($_SESSION["next_state"] == "leaderboard" and array_key_exists("create_account", $_POST))
        {
            create_account();
            $_SESSION["next_state"] = "game";
        }
        elseif($_SESSION["next_state"] == "game" and array_key_exists("register", $_POST))
        {
            create_login();
            process_account();
            $_SESSION["next_state"] = "game";
        }
        elseif($_SESSION["next_state"] == "leaderboard" and array_key_exists("leaderboard", $_POST))
        {
            create_leaderboard();
            $_SESSION["next_state"] = "game";
        }
        elseif($_SESSION["next_state"] == "game")
        {
            create_game();
            $_SESSION["next_state"] = "leaderboard";
        }
        else
        {
            session_destroy();
            session_start();
            session_regenerate_id(TRUE);

            create_login();
            $_SESSION["next_state"] = "game";
        }
        ?>

    </body>
</html>
