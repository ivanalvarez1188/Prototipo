<?php
if($_REQUEST['option']=="exit"){
    session_start();
    $_SESSION = array();
    session_destroy();
    header( 'Location: ./index.php' );
}
if($_REQUEST['user']=="editor" && $_REQUEST['pwd'] == "editor"){
        session_start();
        $_SESSION["usr"] = "admin";
        header( 'Location: ./index.php' );
}
?>