<?php
session_start();
if(isset($_SESSION['name'])){
if(isset($_GET['logout'])){ 
    $fp = fopen("log.html", 'a');
    fwrite($fp, "<div class='msgln'><i>User ".$_SESSION['name']." has left the chat session.</i><br></div>");
    fclose($fp);

    session_destroy();
    header("Location: login.html");
}
}
?>