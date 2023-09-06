<?php include('partials/_loginmodal.php') ?>
<?php include('partials/_signupmodal.php') ?>

<div class="container-fluid bg-success mt-5">
    <div class="row">
        <div class="col-md-12 text-center py-5 text-white">
            <span>All Rights Reserved | PHP FORUM</span>
        </div>
    </div>
</div>
<?php

if (isset($_GET['emailexist'])) {
?>
    <script>
        $(document).ready(function() {
            $(".alertBox").toggleClass('d-none');
            $(".alertBox").children().addClass("alert-danger show");
            $("#alertBoxText").text("Alert! Email already exist");
        })
    </script>
<?php
}

if (isset($_GET['signup'])) {
?>
    <script>
        $(document).ready(function() {
            $(".alertBox").toggleClass('d-none');
            $(".alertBox").children().addClass("alert-success show");
            $("#alertBoxText").text("Success! Account created, log in to continue");
        })
    </script>
<?php
}

if (isset($_GET['error'])) {
?>
    <script>
        $(document).ready(function() {
            $(".alertBox").toggleClass('d-none');
            $(".alertBox").children().addClass("alert-danger show");
            $("#alertBoxText").text("Alert! Try again later");
        })
    </script>
<?php
}

if (isset($_GET['passwordmatch'])) {
?>
    <script>
        $(document).ready(function() {
            $(".alertBox").toggleClass('d-none');
            $(".alertBox").children().addClass("alert-danger show");
            $("#alertBoxText").text("Alert! Password do not match");
        })
    </script>
<?php
}

if (isset($_GET['wrongpassword'])) {
?>
    <script>
        $(document).ready(function() {
            $(".alertBox").toggleClass("d-none");
            $(".alertBox").children().addClass("alert-danger show");
            $("#alertBoxText").text("Alert! Wrong Password");
        })
    </script>
<?php
}

if (isset($_GET['wrongemail'])) {
?>
    <script>
        $(document).ready(function() {
            $(".alertBox").toggleClass('d-none');
            $(".alertBox").children().addClass("alert-danger show");
            $("#alertBoxText").text("Alert! Wrong Email");
        })
    </script>
<?php
}
?>
<script>
    var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="scoopsol/php-forum/assets/plugins/global/plugins.bundle.js"></script>
<script src="scoopsol/php-forum/assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="scoopsol/php-forum/assets/js/scripts.bundle.js"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Scripts(used by this page)-->
<script src="scoopsol/php-forum/assets/js/pages/custom/login/login-general.js"></script>
<!--end::Page Scripts-->
<script src="scoopsol/php-forum/assets/js/pages/widgets.js"></script>
<script src="scoopsol/php-forum/assets/js/pages/custom/profile/profile.js"></script>
<script src="scoopsol/php-forum/assets/js/pages/crud/file-upload/image-input.js"></script>

</body>

</html>