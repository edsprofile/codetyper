<?php


function destroy_and_exit($complaint)
{
    ?>
    <p> CANNOT CONTINUE: <?= $complaint ?> 
    </p>
    <p> <a href="<?= htmlentities($_SERVER['PHP_SELF'], ENT_QUOTES) ?>">
        Try again </a> </p>
    <?php
	//header("location: http://nrs-projects.humboldt.edu/~cs359/loginpage.html");
    //require_once("http://nrs-projects.humboldt.edu/~cs359/loginpage.html");
    session_destroy();
    exit;
}
?>