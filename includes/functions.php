<?php
    // Secures pages that the user needs to be logged in to view
    function secure() {
        if(!isset($_SESSION['id'])) {
            set_message('Please login to view this page.');
            header('Location: /');
            die();
        }
    }

    function set_message($message){
        {
            $_SESSION['message'] = $message;
        }
    }

    function get_Message(){
        if(isset($_SESSION['message'])) {
            echo '<p>' . $_SESSION['message'] . '</p> <hr>';
            unset($_SESSION['message']);
        }
    }
?>