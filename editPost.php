<?php
    require('config/config.php');
    require('config/db.php');

    //Check for submit
    if(isset($_POST['submit'])){
        $updated_id = mysqli_real_escape_string($conn, $_POST['update_id']);
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $post = mysqli_real_escape_string($conn, $_POST['post']);

        //Check required fields

    if(!empty($author) && !empty($title) && (!empty($post))){
    $query = "UPDATE posts SET
    title = '$title', 
    author = '$author', 
    body = '$post'
    WHERE id = {$updated_id}";

echo $updated_id;
echo $title;
echo $author.'<br>';
echo $post.'<br>';

    if(mysqli_query($conn, $query)){
        echo '<script type="text/javascript">alert("Success.");window.location.assign("'.ROOT_URL.'");</script>';
    }
    else {
        echo 'ERROR: '. mysqli_error($conn);
    }
        }
        else echo "<script>alert('Please fill in all forms');</script>";
    }

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
    <a class="btn btn-default" href='<?php echo ROOT_URL ?>'>Back</a>
    <div class="alert">
    </div>
    <div class="container">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="author" class="form-control" value="<?php echo $post['author']; ?>">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo $post['title']; ?>">
            </div>
            <div class="form-group">
                <label>Your post</label>
                <textarea type="text" name="post" class="form-control"><?php echo $post['body']; ?></textarea>
            </div>
            <br>
            <input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
            <input type="submit" name="submit" value = "Submit" class="btn btn-primary">
        </form>
    </div>
<?php include('inc/footer.php');