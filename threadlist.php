<?php session_start(); ?>
<?php include('partials/_header.php') ?>
<?php include('partials/_navbar.php') ?>
<?php include('api/_dbconnect.php') ?>
<?php

$id = $_GET['id'];
$query = "SELECT * FROM `categories` WHERE `cat_id` = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="py-15 bg-white rounded-0 h-300px">
                <h1 class="display-4"><?php echo $row['cat_name'] ?></h1>
                <p class="lead"><?php echo $row['cat_description'] ?></p>
                <a class="btn btn-outline-success btn-lg rounded-0" href="#" role="button">Learn more</a>
            </div>
        </div>
        <div class="col-md-12 border border-success my-5"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1>Browse Threads</h1>
        </div>
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        if ($num != 0) {
            echo
            '
                <div class="col-md-6 text-right">
                    <button class="btn btn-success noTopicFound rounded-0">Create Topic +</button>
                </div>
            ';
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12 d-none py-10" id="newTopicForm">
            <div class="card card-custom">
                <div class="card-header border-success">
                    <h3 class="card-title">
                        Create New Topic
                    </h3>
                    <button type="button" class="newTopicFormClose close"><i aria-hidden="true" class="ki ki-close"></i></button>
                </div>
                <!--begin::Form-->
                <?php
                $method = $_SERVER['REQUEST_METHOD'];
                if ($method == "POST") {
                    $title = $_POST['title'];
                    $desc = $_POST['description'];
                    $tags = strtolower($_POST['tags']);
                    $userId = $_SESSION['userId'];
                    $query = "INSERT INTO `threads` (`thread_title`, `thread_description`, `thread_cat_id`, `thread_user_id`, `thread_tags`, `date_time`) VALUES ('$title', '$desc', '$id', '$userId', '$tags', current_timestamp())";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        $path = $_SERVER['REQUEST_URI'];
                        header("location:" . $path);
                    }
                }
                if (isset($_SESSION['loggedIn'])) {
                ?>
                    <form class="form" action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Problem Title</label>
                                <input type="text" class="form-control form-control-solid" placeholder="" name="title" />
                                <small>Please keep your title short and as crisp as possible</small>
                            </div>
                            <div class="form-group">
                                <label for="exampleTextarea">Elaborate your Problem</label>
                                <textarea class="form-control form-control-solid" rows="3" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="tags">Elaborate your Problem</label>
                                <small>Add upto 5 tags that best describe your problem (Seperate them with Comma)</small>
                                <input type="text" class="form-control form-control-solid" name="tags" required>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-right">
                            <button type="submit" class="btn btn-success mr-2 rounded-0">Submit</button>
                        </div>
                    </form>
                    <!--end::Form-->
                <?php } else { ?>
                    <div class="card-body text-center">
                        <p>Please login to post your question</p>
                        <button class="btn btn-outline-success mx-2 rounded-0" type="button" data-toggle="modal" data-target="#loginModal">Login</button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM `threads` WHERE `thread_cat_id` = $id";
        $result = mysqli_query($conn, $query);
        $noResult = true;
        ?>
        <div class="col-md-12">
            <?php
            while ($row = mysqli_fetch_assoc($result)) {
                $noResult = false;
                $threadid = $row['thread_id'];
                $threadTitle = $row['thread_title'];
                $threadDesc = $row['thread_description'];
                $tags = $row['thread_tags'];
                $threadUserId = $row['thread_user_id'];
                $tag_arr = explode(',', $tags);
                $i = 0; ?>
            <?php
                echo '    
                   <hr>
                    <div class="row py-2">
                    <div class="col-md-6">
                    <h5 class="mt-0"><a class="text-success" href="scoopsol/php-forum/thread.php?id=' . $threadid . '">' . $threadTitle . '</a></h5>
                    <p class="">' . $threadDesc . '</p>';
                if (sizeof($tag_arr) > 1) {
                    echo '
                    <p>Tags: 
                    <small class="ml-1">
                ';
                    while ($i < sizeof($tag_arr)) {
                        echo '
                    <a href="scoopsol/php-forum/tags.php?tag=' . $tag_arr[$i] . '" class="mr-1 text-white bg-success border border-success rounded-0 px-2 py-1">' . ucfirst(strtolower($tag_arr[$i])) . '</a>';
                        $i++;
                    }
                    echo '
                    </small>
                    </p>';
                }
                echo '
                    </div>';
                $queryy = "SELECT * FROM `users` WHERE `user_id` = '$threadUserId'";
                $resultt = mysqli_query($conn, $queryy);
                while ($roww = mysqli_fetch_assoc($resultt)) {
                    $threadUserName = $roww['name'];
                    $threatPostedTime = $roww['date_time'];
                    echo '
                        <div class="col-md-6 text-right align-self-end">
                        <p>Posted by: <a class="text-success" href="#">' . $threadUserName . '</a></p>
                        <p>Posted at: <span class="text-success" href="#">' . $threatPostedTime . '</span></p>
                        </div>';
                }
                echo '</div>';
            }
            ?>
        </div>
        <?php
        if ($noResult) {
            echo
            '
                <div class="col-md-12 text-center align-self-center" id="">
                    <p class="text-dark">
                        No threads found! 
                    </p>
                    <button class="btn btn-success noTopicFound">Create Topic +</button>
                </div>
            ';
        }
        ?>
    </div>
</div>

<?php include('partials/_footer.php') ?>