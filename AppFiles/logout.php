<?php
    // Destroys users session, redirects to home
    session_start();
    session_destroy();
    header('Location: home.php');
?>