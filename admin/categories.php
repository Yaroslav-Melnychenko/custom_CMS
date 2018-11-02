<?php include('includes/admin_header.php'); ?>

    <div id="wrapper">

        <?php include('includes/admin_navigation.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Blank Page
                            <small>Subheading</small>
                        </h1>

                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-file"></i> Blank Page
                            </li>
                        </ol>

                        <div class="col-xs-6">

                            <?php 
                                if(isset($_POST['submit'])){
                                    $cat_title = $_POST['cat_title'];
                                    if($cat_title == "" || empty($cat_title)){
                                        echo "This field should not be empty!";
                                    }else{
                                        $query = "INSERT INTO categories(cat_title) VALUE('{$cat_title}')";
                                        $create_cat_query = mysqli_query($connection, $query);
                                        if(!$create_cat_query){
                                            echo die("Query error ".mysqli_error($connection));
                                        }
                                    }
                                }

                                if(isset($_POST['update'])){
                                    $cat_title = $_POST['edit'];
                                    if($cat_title == "" || empty($cat_title)){
                                        echo "This field should not be empty!";
                                    }else{
                                        $edit_id = $_GET['edit'];
                                        $query = "UPDATE categories SET cat_title='{$cat_title}' WHERE cat_id={$edit_id}";
                                        $create_cat_query = mysqli_query($connection, $query);
                                        if(!$create_cat_query){
                                            echo die("Query error ".mysqli_error($connection));
                                        }else{
                                            header("Location: categories.php");
                                        }
                                    }
                                }
                            ?>

                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat-title">Add category</label>
                                    <input type="text" name="cat_title" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" name="submit" value="Add category" class="btn btn-primary">
                                </div>
                            </form>

                            <?php 
                            if(isset($_GET['edit'])){

                                $cat_id = $_GET['edit'];

                                $query = "SELECT * FROM categories WHERE cat_id={$cat_id}";
                                $query_cat = mysqli_query($connection, $query);
                                $row = mysqli_fetch_assoc($query_cat);
                                $cat_title = $row['cat_title'];
                                
                                ?>
                                <hr>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="edit-cat-title">Edit category</label>
                                        <input type="text" name="edit" class="form-control" value="<?php echo $cat_title; ?>">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="update" value="Update category" class="btn btn-primary">
                                    </div>
                                </form>
                            <?php } ?>

                        </div>

                        <div class="col-xs-6">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Category name</th>
                                        <th class="text-center">Edit</th>
                                        <th class="text-center">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        //Find all categories and show its
                                        $query = 'SELECT * FROM categories';
                                        $select_cat_sidebar_query = mysqli_query($connection, $query);

                                        while($row = mysqli_fetch_assoc($select_cat_sidebar_query)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title']; 
                                            echo '<tr>
                                                <th>'.$cat_id.'</th>
                                                <th>'.$cat_title.'</th>
                                                <th class="text-center"><a class="text-success" href="categories.php?edit='.$cat_id.'"><i class="fa fa-edit"></i></a></th>
                                                <th class="text-center"><a class="text-danger" href="categories.php?delete='.$cat_id.'"><i class="fa fa-remove"></i></a></th>
                                                </tr>';
                                        }

                                        //Delete query
                                        if(isset($_GET['delete'])){
                                            $the_cat_id = $_GET['delete'];
                                            $query = "DELETE FROM categories WHERE cat_id={$the_cat_id}";
                                            $delete_query = mysqli_query($connection, $query);
                                            if($delete_query){
                                                header("Location: categories.php");
                                            }else{
                                                die("Query error ".mysqli_error($connection));
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php include('includes/admin_footer.php'); ?>