<?php session_start(); ?>
<?php include('partials/_header.php') ?>
<?php include('partials/_navbar.php') ?>
<?php include('api/_dbconnect.php') ?>
<div class="container">
    <div class="row">
        <div class="col-md-12 text-center my-5">
            <h1 class="text-dark">
                Browse Categories
            </h1>
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
                    <div class="card-body">
                        <p class="text-dark">
                            ' . substr($row['cat_description'], 0, 200) . '
                        ...</p>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <a href="scoopsol/php-forum/threadlist.php?id=' . $row['cat_id'] . '" class="btn btn-outline-success font-weight-bold rounded-0">Explore</a>
                    </div>
                </div>
            </div>
            ';
        }
        ?>
    </div>
</div>

<?php include('partials/_footer.php') ?>