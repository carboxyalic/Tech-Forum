<?php session_start(); ?>
<?php
include('partials/_header.php');
include('partials/_navbar.php');
include('api/_dbconnect.php')
?>

<?php

$url = $_SERVER['REQUEST_URI'];
$urlArray = explode('?', $url); ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="py-15 h-300px d-flex flex-center flex-column">
                <h1 class="display-3 font-weight-bold">Search Result</h1>
                <form method="GET" action="scoopsol/php-forum/search.php">
                    <div class="form-group w-800px">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search for..." name="search">
                            <div class="input-group-append">
                                <button class="btn btn-success" type="submit">Go!</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12 border border-success my-5"></div>
        <?php
        if (count($urlArray) > 1) {
        ?>
            <?php
            if (isset($_GET['search'])) {
                $toSearch = $_GET['search'];
                $searchQuery = "SELECT * FROM `threads` WHERE MATCH (thread_title, thread_description) against ('$toSearch')";
                $searchResult = mysqli_query($conn, $searchQuery);
                $noOfResults = mysqli_num_rows($searchResult);
                if ($noOfResults > 0) {
            ?>
                    <div class="col-md-12">
                        <h1>Search Results for: <em><?php echo $_GET['search'] ?></em></h1>
                    </div>
                    <div class="col-md-12">
                        <?php
                        while ($row = mysqli_fetch_assoc($searchResult)) {
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
                                <p class="">' . $threadDesc . '</p>
                            ';
                            if (sizeof($tag_arr) > 1) {
                                echo '
                                    <p>Tags: 
                                    <small class="ml-1">
                                ';
                                while ($i < sizeof($tag_arr)) {
                                    echo '
                                        <a href="scoopsol/php-forum/tags.php?tag=' . $tag_arr[$i] . '" class="mr-1 text-white bg-success border border-success rounded px-2 py-1">' . ucfirst(strtolower($tag_arr[$i])) . '</a>
                                    ';
                                    $i++;
                                }
                                echo '
                                    </small>
                                    </p>
                                ';
                            }
                            echo '
                            </div>
                            ';
                            $queryy = "SELECT * FROM `users` WHERE `user_id` = '$threadUserId'";
                            $resultt = mysqli_query($conn, $queryy);
                            while ($roww = mysqli_fetch_assoc($resultt)) {
                                $threadUserName = $roww['name'];
                                $threatPostedTime = $roww['date_time'];
                                echo '
                                    <div class="col-md-6 text-right align-self-end">
                                    <p>Posted by: <a class="text-success" href="#">' . $threadUserName . '</a></p>
                                    <p>Posted at: <span class="text-success" href="#">' . $threatPostedTime . '</span></p>
                                    </div>
                                ';
                            }
                            echo '</div>';
                        } ?>
                    </div>
                <?php
                } else {
                ?>
                    <div class="col-md-12 text-center">
                        <div class="h-350px flex-column flex-center d-flex">
                            <h1 class="text-success">No results found for <em>'<?php echo $_GET['search'] ?></em>'</h1>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        <?php
        } else {
        ?>
            <div class="col-md-12">
                <h1 class="pb-5">Explore by Categories</h1>
            </div>
            <?php
            $query = "SELECT * FROM `categories`";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                echo
                '
                        <div class="col-md-4">
                            <div class="card card-custom gutter-b card-stretch">
                                <div class="card-header">
                                    <div class="card-title">
                                        <a class="card-label" href="scoopsol/php-forum/threadlist.php?id=' . $row['cat_id'] . '">
                                            ' . $row['cat_name'] . '
                                        </a>
                                    </div>
                                </div>
                                <!--<img src="https://picsum.photos/2000/1000?coding,code" class="card-img-top rounded-0 img-fluid" alt="">-->
                                <div class="card-body">
                                    <p class="text-dark">
                                        ' . substr($row['cat_description'], 0, 200) . '
                                    ...</p>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <a href="scoopsol/php-forum/threadlist.php?id=' . $row['cat_id'] . '" class="btn btn-outline-success font-weight-bold">Explore</a>
                                </div>
                            </div>
                        </div>
                    ';
            }
            ?>
        <?php
        }
        ?>
    </div>
</div>

<?php include('partials/_footer.php') ?>