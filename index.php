<?php
    require('config/config.php');
    require('config/db.php');

    //Create query
    $query = 'SELECT * FROM posts ORDER BY at DESC';

    //Get result
    $result = mysqli_query($conn, $query);

    //Fetch data
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //Free result
    mysqli_free_result($result);

    //Close connection
    mysqli_close($conn);
?>

<?php include('inc/header.php'); ?>
<?php include('inc/navbar.php'); ?>
    <div class="container">
        <h1>Posts</h1>
        <?php foreach($posts as $post) : ?>
            <div class="well">
                <h3><?php echo $post['title']; ?></h3>
                <small>Created on <?php echo $post['at']; ?> by <?php echo $post['author']; ?></small>
                <p><?php if(strlen($post['body']) <= 50)
                     echo $post['body']; 
                    else echo substr($post['body'],0,50)."...";?></p>
                <a class="btn btn-default" style="border: 0.5px solid white" href="<?php echo ROOT_URL; ?>post.php?id=<?php echo$post['id']; ?>">Read more</a>
            </div>
        <?php endforeach; ?>
        <hr>
        <a class="btn btn-large" style="float: right; border: 2px solid white" href="<?php echo ROOT_URL; ?>newPost.php"> New post</a>
    </div>
<?php include('inc/footer.php');