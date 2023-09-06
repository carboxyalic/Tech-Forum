<?php session_start(); ?>
<?php include('partials/_header.php') ?>
<?php include('partials/_navbar.php') ?>
<?php include('api/_dbconnect.php') ?>

<?php
$tagName = $_GET['tag'];
?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="h-300px" style="display: inline-flex; flex-direction:column; justify-content:center">
                <h1 class="display-3">Tagged Threads</h1>
                <p class="font-size-h3">Tag: <span class="text-success"><?php echo $tagName ?></span></p>
            </div>
        </div>
        <div class="col-md-12 border border-success my-5"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1>Browse Threads</h1>
        </div>
        <div class="col-md-6 text-right">
            <!-- <button class="btn btn-success">Create Thread +</button> -->
        </div>
    </div>
    <div class="row">
        <?php
        if (isset($_GET['tag'])) {
            $query = "SELECT * FROM `threads`";
            $result = mysqli_query($conn, $query);
            $tagToMatch = $_GET['tag'];
            while ($row = mysqli_fetch_assoc($result)) {
                $tags = $row['thread_tags'];
                $tag_arr = explode(',', $tags);
                $i = 0;
                while ($i < sizeof($tag_arr)) {
                    if ($tagToMatch == $tag_arr[$i]) {
        ?>
                        <div class="col-md-12">
                            <?php
                            $threadId = $row['thread_id'];
                            $tagThreadsQuery = "SELECT * FROM `threads` WHERE `thread_id` = '$threadId'";
                            $tagThreadsResult = mysqli_query($conn, $tagThreadsQuery);
                            while ($tagThreadsRow = mysqli_fetch_assoc($tagThreadsResult)) {
                                $threadTags = $tagThreadsRow['thread_tags'];
                                $threadUserId = $tagThreadsRow['thread_user_id'];
                                $threadTagArr = explode(',', $threadTags);
                                $j = 0;
                                echo '
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 class="mt-0"><a class="text-success" href="scoopsol/php-forum/thread.php?id=' . $tagThreadsRow['thread_id'] . '">' . $tagThreadsRow['thread_title'] . '</a></h5>
                                        <p class="">' . $tagThreadsRow['thread_description'] . '</p>
                                        <p>Tags:
                                            <small class="ml-1">';

                                while ($j < sizeof($threadTagArr)) {
                                    echo '
                                                    <a href="scoopsol/php-forum/tags.php?tag=' . $threadTagArr[$j] . '" class="mr-1 text-white bg-success border border-success rounded px-2 py-1">' . ucfirst(strtolower($threadTagArr[$j])) . '</a>
                                                ';
                                    $j++;
                                }
                                echo '
                                            </small>
                                        </p>
                                    </div>';
                                $postedByQuery = "SELECT * FROM `users` WHERE `user_id` = '$threadUserId'";
                                $postedByResult = mysqli_query($conn, $postedByQuery);
                                while ($postedByRow = mysqli_fetch_assoc($postedByResult)) {
                                    $postedByUser = $postedByRow['name'];
                                    $postedAtTime = $postedByRow['date_time'];
                                    echo '
                                    <div class="col-md-6 text-right align-self-end">
                                        <p>Posted by: <a class="text-success" href="#">' . $postedByUser . '</a></p>
                                        <p>Posted at: <span class="text-success">' . $postedAtTime . '</span></p>
                                    </div>
                                    ';
                                }
                                echo '
                                </div>
                            ';
                            }
                            ?>
                        </div>
        <?php
                    }
                    $i++;
                }
            }
        } else {
            echo "Nikal";
        }
        ?>
    </div>
</div>

<?php include('partials/_footer.php') ?>