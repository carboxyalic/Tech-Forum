<?php session_start(); ?>
<?php include('partials/_header.php') ?>
<?php include('partials/_navbar.php') ?>
<?php include('api/_dbconnect.php') ?>
<?php
$id = $_GET['id'];
$query = "SELECT * FROM `threads` WHERE `thread_id` = $id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$threadOwner = $row['thread_user_id'];
$queryy = "SELECT * FROM `users` WHERE `user_id` = '$threadOwner'";
$resultt = mysqli_query($conn, $queryy);
$roww = mysqli_fetch_assoc($resultt)
?>
<div class="container">
    <div class="row h-300px">
        <div class="col-md-12 align-self-center">
            <div class="py-15 bg-white rounded-0">
                <h1 class="display-4"><?php echo $row['thread_title'] ?></h1>
                <p class="lead"><?php echo $row['thread_description'] ?></p>
                <p><b>Posted by: </b><a class="text-success" href="#" role="button"><?php echo $roww['name'] ?></a></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 border border-success my-5"></div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h1>Discussion</h1>
        </div>
        <?php
        $query = "SELECT * FROM `comments` WHERE `thread_id` = $id";
        $result = mysqli_query($conn, $query);
        $num = mysqli_num_rows($result);
        if ($num != 0) {
            echo
            '
                <div class="col-md-6 text-right">
                    <button class="btn-success btn noCommentFound">Comment +</button>
                </div>
            ';
        }
        ?>
    </div>
    <div class="row">
        <div class="col-md-12 d-none py-10" id="newCommentForm">
            <div class="card card-custom">
                <div class="card-header border-success">
                    <h3 class="card-title">
                        Add a Comment
                    </h3>
                    <button type="button" class="newCommentFormClose close"><i aria-hidden="true" class="ki ki-close"></i></button>
                </div>
                <!--begin::Form-->
                <?php
                $method = $_SERVER['REQUEST_METHOD'];
                if ($method == "POST" && isset($_POST['comment'])) {
                    $comment = $_POST['comment'];
                    $userId = $_SESSION['userId'];
                    $query = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_user_id`, `date_time`) VALUES ('$comment', '$id', '$userId', current_timestamp());";
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
                                <label for="exampleTextarea">Type your Comment</label>
                                <textarea class="form-control form-control-solid" rows="3" name="comment"></textarea>
                            </div>
                        </div>
                        <div class="card-footer border-0 text-right">
                            <button type="submit" class="btn btn-success mr-2">Submit</button>
                        </div>
                    </form>
                    <!--end::Form-->
                <?php } else { ?>
                    <div class="card-body text-center">
                        <p>Please login to post your comment</p>
                        <button class="btn btn-outline-success mx-2" type="button" data-toggle="modal" data-target="#loginModal">Login</button>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php
        $id = $_GET['id'];
        $query = "SELECT * FROM `comments` WHERE `thread_id` = $id";
        $result = mysqli_query($conn, $query);
        $noResult = true;
        while ($row = mysqli_fetch_assoc($result)) {
            $noResult = false;
            $commentContent = $row['comment_content'];
            $commentUserId = $row['comment_user_id'];
            $commentId = $row['comment_id'];
        ?>
            <div class="col-md-12">
                <?php
                echo '
                <hr>
                <div class="row">
                <div class="col-md-6">
                <div class="media py-2">
                <div class="symbol symbol-40 symbol-light-success mr-5">
				<span class="symbol-label">
				<img src="scoopsol/php-forum/assets/media/svg/avatars/007-boy-2.svg" class="h-75 align-self-end" alt="">
				</span>
				</div>
                <div class="media-body">';
                $queryy = "SELECT * FROM `users` WHERE `user_id` = '$commentUserId'";
                $resultt = mysqli_query($conn, $queryy);
                while ($row = mysqli_fetch_assoc($resultt)) {
                    echo '<h5 class="mt-0"><a href="#" class="text-success">' . $row['name'] . '</a></h5>';
                }
                echo '
                <p class="mb-0">' . $commentContent . '</p>
                <div class="d-flex">';
                $recordCountReplies = "SELECT COUNT(*) FROM replies WHERE `comment_id` = $commentId";
                $recordCountRepliesResult = mysqli_query($conn, $recordCountReplies);
                $recordCountRepliesRow = implode(mysqli_fetch_assoc($recordCountRepliesResult));
                if ($recordCountRepliesRow > 0) {
                    echo '
                    <p class="align-self-center mb-0"><span>Replies:</span><button class="btn rounded-0 border-0 text-success py-0" type="button" data-toggle="collapse" data-target="#repliesCollapse' . $commentId . '" aria-expanded="false" aria-controls="repliesCollapse' . $commentId . '">' . $recordCountRepliesRow . ' Replies</button></p>
                    ';
                }
                echo '
                <p class="mb-0">
                <span class="pr-2">Actions:</span>
                ';
                ?>

                <?php
                $queryy = "SELECT * FROM `users` WHERE `user_id` = '$commentUserId'";
                $resultt = mysqli_query($conn, $queryy);
                $row = mysqli_fetch_assoc($resultt);
                $userId = $row['user_id'];
                if (isset($_SESSION['loggedIn'])) {
                    $confirmUserId = $_SESSION['userId'];
                    if ($userId == $confirmUserId) {
                        echo '
                        <a href="#" class="btn btn-icon btn-light btn-hover-success btn-sm">
                            <span class="svg-icon svg-icon-md svg-icon-success">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                    viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953) " />
                                        <path
                                            d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                        </a>
                        <a href="#" class="btn btn-icon btn-light btn-hover-danger btn-sm">
                            <span class="svg-icon svg-icon-md svg-icon-success">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                    viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24" />
                                        <path
                                            d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z"
                                            fill="#000000" fill-rule="nonzero" />
                                        <path
                                            d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z"
                                            fill="#000000" opacity="0.3" />
                                    </g>
                                </svg>
                            </span>
                        </a>';
                    }
                }
                echo '
                <button class="btn btn-icon btn-light btn-hover-success btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample' . $commentId . '" aria-expanded="false" aria-controls="collapseExample' . $commentId . '">
                    <span class="svg-icon svg-icon-md svg-icon-success">
                        <svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path
                                    d="M21.4451171,17.7910156 C21.4451171,16.9707031 21.6208984,13.7333984 19.0671874,11.1650391 C17.3484374,9.43652344 14.7761718,9.13671875 11.6999999,9 L11.6999999,4.69307548 C11.6999999,4.27886191 11.3642135,3.94307548 10.9499999,3.94307548 C10.7636897,3.94307548 10.584049,4.01242035 10.4460626,4.13760526 L3.30599678,10.6152626 C2.99921905,10.8935795 2.976147,11.3678924 3.2544639,11.6746702 C3.26907199,11.6907721 3.28437331,11.7062312 3.30032452,11.7210037 L10.4403903,18.333467 C10.7442966,18.6149166 11.2188212,18.596712 11.5002708,18.2928057 C11.628669,18.1541628 11.6999999,17.9721616 11.6999999,17.7831961 L11.6999999,13.5 C13.6531249,13.5537109 15.0443703,13.6779456 16.3083984,14.0800781 C18.1284272,14.6590944 19.5349747,16.3018455 20.5280411,19.0083314 L20.5280247,19.0083374 C20.6363903,19.3036749 20.9175496,19.5 21.2321404,19.5 L21.4499999,19.5 C21.4499999,19.0068359 21.4451171,18.2255859 21.4451171,17.7910156 Z"
                                    fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                    </span>
                </button>
                </p>
                </div>
                </div>
                </div>
                </div>
                <div class="col-md-6 text-right align-self-end" >
                <p class="mb-0">
                <a href="#" class="btn btn-icon btn-light btn-hover-success btn-sm">
                    <span class="svg-icon svg-icon-md svg-icon-success">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <rect fill="#000000" opacity="0.3" x="11" y="4" width="2" height="10" rx="1" />
                                <path
                                    d="M6.70710678,19.7071068 C6.31658249,20.0976311 5.68341751,20.0976311 5.29289322,19.7071068 C4.90236893,19.3165825 4.90236893,18.6834175 5.29289322,18.2928932 L11.2928932,12.2928932 C11.6714722,11.9143143 12.2810586,11.9010687 12.6757246,12.2628459 L18.6757246,17.7628459 C19.0828436,18.1360383 19.1103465,18.7686056 18.7371541,19.1757246 C18.3639617,19.5828436 17.7313944,19.6103465 17.3242754,19.2371541 L12.0300757,14.3841378 L6.70710678,19.7071068 Z"
                                    fill="#000000" fill-rule="nonzero"
                                    transform="translate(12.000003, 15.999999) scale(1, -1) translate(-12.000003, -15.999999) " />
                            </g>
                        </svg>
                    </span>
                </a>
                <span class="mx-2">0 Votes</span>
                <a href="#" class="btn btn-icon btn-light btn-hover-success btn-sm">
                    <span class="svg-icon svg-icon-md svg-icon-success">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24" />
                                <rect fill="#000000" opacity="0.3" x="11" y="5" width="2" height="14" rx="1" />
                                <path
                                    d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
                                    fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                    </span>
                </a>
                <span class="mx-2">0 Votes</span>
                </p>
                </div>';
                $replyDisplayQuery = "SELECT * FROM `replies` WHERE `comment_id` = '$commentId'";
                $replyDisplayResult = mysqli_query($conn, $replyDisplayQuery);
                while ($replyDisplayRow = mysqli_fetch_assoc($replyDisplayResult)) {
                    echo '
                    <div class="col-md-12 pl-25 collapse" id="repliesCollapse' . $commentId . '">
                    <h5 class="text-success">Murtaza</h5>
                    <p class="text-dark">' . $replyDisplayRow['reply_content'] . '</p>
                    </div>
                    ';
                }
                echo '
                <div class="col-md-12">
                    <div class="collapse" id="collapseExample' . $commentId . '">';

                if (isset($_SESSION['loggedIn'])) {
                    echo '
                        <form class="form" action="' . $_SERVER['REQUEST_URI'] . '" method="POST">
                            <div class="card-body">
                            <div class="form-group d-none">
                                    <input class="form-control form-control-solid" name="comment_id" value = "' . $commentId . '">
                                </div>
                                <div class="form-group">
                                    <label for="">Type your Reply</label>
                                    <textarea class="form-control form-control-solid" rows="3" name="reply"></textarea>
                                </div>
                            </div>
                            <div class="card-footer border-0 text-right">
                                <button type="submit" class="btn btn-success mr-2">Submit</button>
                            </div>
                        </form>';
                } else {
                    echo '
                        <div class="text-center">
                        <p>Please login to reply!</p>
                        <button class="btn btn-outline-success mx-2" type="button" data-toggle="modal" data-target="#loginModal">Login</button>
                        </div>
                        ';
                }
                echo '
                    </div>
                </div>';
                echo '
                </div>
                ';
                ?>
            </div>

        <?php
        }
        if ($noResult) {
            echo
            '
                <div class="col-md-12 text-center align-self-center" id="">
                    <p class="text-dark">No comments found!</p>
                    <button class="btn btn-success noCommentFound">Add Comment +</button>
                </div>
            ';
        }
        ?>
    </div>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply'])) {
    if (isset($_SESSION['loggedIn'])) {
        $commentId = $_POST['comment_id'];
        $replyContent = $_POST['reply'];
        $replyQuery = "INSERT INTO `replies` (`reply_content`, `comment_id`, `reply_user_id`, `date_time`) VALUES ('$replyContent', '$commentId', '$userId', current_timestamp());";
        $replyQueryResult = mysqli_query($conn, $replyQuery);
        if ($replyQueryResult) {
            $id = $_GET['id'];
            echo "Select query is not displaying result in first iteration";
        }
    }
}
?>

<?php include('partials/_footer.php') ?>