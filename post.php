<?php
    require('config/config.php');
    require('config/db.php');

    if(isset($_POST['delete'])){

        $delete_id = mysqli_real_escape_string($conn, $_POST['delete_id']);

        $query = 'DELETE FROM posts WHERE id='. $delete_id;

        if(mysqli_query($conn, $query)) {
            echo '<script type="text/javascript">alert("Success.");window.location.assign("'.ROOT_URL.'");</script>';
        }
        else echo 'error';
    }

    //Get id
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //Create query
    $query = 'SELECT * FROM posts WHERE id= '. $id;

    //Get result
    $result = mysqli_query($conn, $query);

    //Fetch data
    $post = mysqli_fetch_assoc($result);

    //Free result
    mysqli_free_result($result);

    //Close connection
    mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
<?php include('inc/navbar.php'); ?>
    <div class="container">
    <a class="btn btn-default" href='<?php echo ROOT_URL ?>'>Back</a>
        <h1><?php echo $post['title']; ?></h1>
        <small>Created on <?php echo $post['at']; ?> by <?php echo $post['author']; ?></small>
        <p><?php echo $post['body']; ?></p>
        <hr>
        <form class="float-right" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="hidden" name="delete_id" value="<?php echo $post['id'] ?>">
            <input type="submit" name="delete" value="Delete" class="btn btn-default" onclick="return confirm('Are you sure you want to Remove?');" style="border: 0.5px solid red">
        </form>
            <a class="btn btn-default" style="border: 0.5px solid white" href="<?php echo ROOT_URL; ?>editPost.php?id=<?php echo$post['id']; ?>">Edit post</a>
    </div>

<?php include('inc/footer.php');