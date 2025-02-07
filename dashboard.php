<?php
    include('includes/config.php');
    include('includes/database.php');
    include('includes/functions.php');
    secure();

    include('includes/header.php');
    
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <svg viewBox="0 0 450 50">
        <text y="50">Dashboard</text>
        </svg>
        <?php if($_SESSION['username'] == 'admin') {?>
        <p class="btm-text">
            <a href="users.php">Users management </a> | 
            <a href="posts.php">Posts management </a>
        </p>
        <?php } ?>
        <a class="floating-button" id="new-post-btn" href="posts_add.php">New Post</a>
            <div class="content-box" id="dash">
                <p>Content goes here!</p>
            </div>
        </div>

    </div>
</div>


<?php
    include('includes/footer.php');
?>