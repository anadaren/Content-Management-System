<?php
// Start output buffering
ob_start();
    include('includes/config.php');
    include('includes/database.php');
    include('includes/functions.php');
    secure();

    include('includes/header.php');

    // Deletes a post
    if(isset($_GET['delete'])) {
        if($stm = $connect->prepare('DELETE FROM posts WHERE id = ?')) {
            $stm->bind_param('i', $_GET['delete']);
            $stm->execute();
            
            
            set_message("Post " . $_GET['delete'] . " has beed deleted.");
            $stm->close();
            header('Location: posts.php');
            ob_end_flush(); // Ends output buffering
            die();
    
        } else {
            echo 'Could not prepare post statement!';
        }
    }

    // Display table of users
    if ($stm = $connect->prepare('SELECT * FROM posts')){
        $stm->execute();
    
        $result = $stm->get_result();
        
        if ($result->num_rows > 0){
 

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
        <svg viewBox="0 0 450 50">
        <text y="50">Post Management</text>
        </svg>

        <div class="content-box">
        <table class="table table-striped table-hover">
         <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Author's ID</th>
            <th>Data</th>
            <th>Conent</th>
            <th>Edit | Delete</th>

         </tr>

         <?php while($record = mysqli_fetch_assoc($result)){  ?>
        <tr>

        <td><?php echo $record['id']; ?> </td>
        <td><?php echo $record['title']; ?> </td>
        <td><?php echo $record['author']; ?> </td>
        <td><?php echo $record['date']; ?> </td>
        <td><?php echo $record['content']; ?> </td>
        <td><a href="posts_edit.php?id=<?php echo $record['id']; ?>">Edit</a> | 
            <a href="posts.php?delete=<?php echo $record['id']; ?>">Delete</a></td>
        </tr>
        
        
        <?php } ?> 


        </table>
        </div>

        <a href="posts_add.php"> Add new post</a>
       
        </div>

    </div>
</div>


<?php
    } else 
    {
        echo 'No posts found';
    }

    $stm->close();

    } else {
    echo 'Could not prepare statement!';
    }


    include('includes/footer.php');
?>