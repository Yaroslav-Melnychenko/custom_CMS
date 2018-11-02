<?php 
    include 'includes/db.php';
    include 'includes/header.php';
    include 'includes/navigation.php';
?>

<!-- Page Content -->
<div class="container">
    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Search result
            </h1>

            <?php
                if(isset($_POST['search'])){
                    $search = $_POST['search'];

                    $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' OR post_title LIKE '%$search%' OR post_author LIKE '%$search%'";

                    $search_query = mysqli_query($connection, $query);

                    if(!$search_query){
                        die("Query FAILED" . mysql_error($connection, $query));
                    }

                    $count = mysqli_num_rows($search_query);

                    if($count == 0){
                        echo '<h1>NO result</h1>';
                    }else{ 

                        $select_all_posts_query = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_all_posts_query)){

                            $post_title = $row['post_title'];
                            $post_author = $row['post_author'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_content = $row['post_content'];

                            echo '<h2><a href="#">'.$post_title.'</a></h2>';
                            echo '<p class="lead">by <a href="#">'.$post_author.'</a></p>';
                            ?>
                            
                            <p>
                                <span class="glyphicon glyphicon-time"></span> 
                                <?php echo 'Posted on '.date('F m, Y', strtotime($post_date)); ?>
                            </p>

                            <hr>

                            <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">

                            <hr>

                            <?php echo '<p>'.$post_content.'</p>'; ?>

                            <a class="btn btn-primary" href="#">
                                Read More <span class="glyphicon glyphicon-chevron-right"></span>
                            </a>

                            <hr>

                        <?php }      
                    }
                }
            ?>

            <!-- Pager -->
            <ul class="pager">
                <li class="previous">
                    <a href="#">&larr; Older</a>
                </li>
                <li class="next">
                    <a href="#">Newer &rarr;</a>
                </li>
            </ul>

        </div>

        <?php include 'includes/sidebar.php'; ?>

    </div>
    <!-- /.row -->

    <hr>

<?php 
    include 'includes/footer.php';
?>