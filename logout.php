<?php
    include('includes/config.php');

    // Destroys session, logging out user
    session_destroy();

    header('Location: /');
    die();
?>