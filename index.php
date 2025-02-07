<?php
ob_start();

    // Creating A Content Management System //
    // Using PHP + MySQL //

    // Bootstrap Source: https://mdbootstrap.com/ //
    
    include('includes/config.php');
    include('includes/database.php');
    include('includes/functions.php');
    
    // If user is logged in take them to dashboard
    if(isset($_SESSION['id'])) {
        header('Location: dashboard.php');
        die();
    }

    include('includes/header.php');

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <svg viewBox="0 0 450 50">
        <text y="50">Bloggg</text>
        </svg>

        <div id="login-btns">
            <a class="floating-button"  href="login.php">Log In</a>
            <a class="floating-button"  href="signup.php">Sign Up</a>
        </div>
    </div>
</div>


<?php
    include('includes/footer.php');
?>