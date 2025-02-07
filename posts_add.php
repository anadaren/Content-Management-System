<?php
// Start output buffering
ob_start();
    include('includes/config.php');
    include('includes/database.php');
    include('includes/functions.php');
    secure();

    include('includes/header.php');

    if(isset($_POST['title'])) {

        if ($stm = $connect->prepare('INSERT INTO posts (title,content,author,date) VALUES (?, ?, ?, ?)')){
            $stm->bind_param('ssis', $_POST['title'], $_POST['content'], $_SESSION['id'], $_POST['date']);
            $stm->execute();
            
    
            set_message("A new post by " . $_SESSION['username'] . " has beed added");
            $stm->close();
            header('Location: posts.php');
            ob_end_flush(); // Ends output buffering
            die();
    
        } else {
            echo 'Could not prepare statement!';
        }

    }
 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
        <svg viewBox="0 0 450 50">
        <text y="50">Add Post</text>
        </svg>

            <div class="content-box">
            <form method="post">
                <!-- Title input -->
                <div class="form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" />
                    <label class="form-label" for="title">Title</label>
                </div>

                <!-- Content input -->
                <div class="form-outline mb-4">
                    <textarea name="content" id="content" ></textarea>
                </div>

                <!-- Date select -->
                <div class="form-outline mb-4">
                    <input type="date" id="date" name="date" class="form-control" />
                    <label class="form-label" for="date">Date</label>
                </div>
   

                <!-- Submit button -->
                <button type="submit" class="btn btn-primary btn-block">Add Post</button>
            </form>
            </div>

        </div>

    </div>
</div>

<script src="js/tinymce/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: '#content'
    });
</script>
<?php
    include('includes/footer.php');
?>