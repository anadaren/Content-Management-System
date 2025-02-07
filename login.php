<?php
ob_start();

    include('includes/config.php');
    include('includes/database.php');
    include('includes/functions.php');
    
    // If user is logged in take them to dashboard
    if(isset($_SESSION['id'])) {
        header('Location: dashboard.php');
        die();
    }

    include('includes/header.php');

    // Queries only upon submit
    if(isset($_POST['email'])) {
        if($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ? AND active = 1')) {

            $hashed = SHA1($_POST['password']);
            $stm->bind_param('ss', $_POST['email'], $hashed);
            $stm->execute();    // Runs query with updated values

            $result = $stm->get_result();
            $user = $result->fetch_assoc();

            // Sets session variables as login info
            if($user) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['username'] = $user['username'];

                set_message("You have successfully logged in as " . $_SESSION['username']);
                header('Location: dashboard.php');
                ob_end_flush(); // Ends output buffering
                die();
            }
            $stm->close();
        } else {
            echo 'Could not prepare statement!';
        }
    }
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <svg viewBox="0 0 450 50">
        <text y="50">Log In</text>
        </svg>
            <div class="content-box">
            <form method="post">
                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                    <input type="password" id="password"  name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>

   

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Sign in</button>
            </form>
            </div>
            <p class="btm-text">New User? <a href="signup.php">Sign up.</a></p>
        </div>

    </div>
</div>


<?php
    include('includes/footer.php');
?>