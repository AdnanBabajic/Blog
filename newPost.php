<?php
    require('config/config.php');
    require('config/db.php');

    //Check for submit
    if(filter_has_var(INPUT_POST, 'submit')){
        $author = mysqli_real_escape_string($conn, $_POST['author']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $post = mysqli_real_escape_string($conn, $_POST['post']);

    //Check required fields

    if(!empty($author) && !empty($title) && (!empty($post))){
    $query = "INSERT INTO posts (title, body, author) VALUES ('$title', '$post', '$author')";
    if(mysqli_query($conn, $query)){
        echo '<script type="text/javascript">alert("Success.");window.location.assign("'.ROOT_URL.'");</script>';
    }
    else {
        echo 'ERROR: '. mysqli_error($conn);
    }

    //Close connection
    mysqli_close($conn);
        }
        else echo "<script>alert('Please fill in all forms');</script>";
    }
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
                <input type="text" name="author" class="form-control" value="<?php echo isset($_POST['author']) ? $author : ''; ?>">
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="form-control" value="<?php echo isset($_POST['title']) ? $title : ''; ?>">
            </div>
            <div class="form-group">
                <label>Your post</label>
                <textarea type="text" name="post" class="form-control"><?php echo isset($_POST['post']) ? $post : ''; ?></textarea>
            </div>
            <br>
            <button type="sumbit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
<?php include('inc/footer.php');