<!DOCTYPE html>
<html lang="en">

<head>
	<base href="../../../">
	<meta charset="utf-8" />
	<title>PHP - Crud App</title>
	<meta name="description" content="Support center feedback example" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="scoopsol/php-forum/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="scoopsol/php-forum/assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="scoopsol/php-forum/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<link href="scoopsol/php-forum/assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
	<link href="scoopsol/php-forum/assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
	<link href="scoopsol/php-forum/assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
	<link href="scoopsol/php-forum/assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
	<link href="scoopsol/php-forum/assets/css/pages/login/classic/login-4.css" rel="stylesheet" type="text/css" />
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="scoopsol/php-forum/assets/media/logos/favicon.ico" />
</head>
<script>
	$(document).ready(function() {
		$(".noTopicFound").click(function() {
			$(this).parent().removeClass('d-block').addClass('d-none');
			$("#newTopicForm").removeClass('d-none').addClass('d-block');
		});
		$(".newTopicFormClose").click(function() {
			$("#newTopicForm").removeClass('d-block').addClass('d-none');
			$(".noTopicFound").parent().removeClass('d-none').addClass('d-block');
		});
	})
</script>
<script>
	$(document).ready(function() {
		$(".noCommentFound").click(function() {
			$(this).parent().removeClass('d-block').addClass('d-none');
			$("#newCommentForm").removeClass('d-none').addClass('d-block');
		});
		$(".newCommentFormClose").click(function() {
			$("#newCommentForm").removeClass('d-block').addClass('d-none');
			$(".noCommentFound").parent().removeClass('d-none').addClass('d-block');
		});
	})
</script>
<script>
	function logoutCheck() {
		return confirm("Are you sure you want to logout?");
	}
</script>
<?php include('./api/_dbconnect.php') ?>

<body id="kt_body" class="bg-white header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable" data-new-gr-c-s-check-loaded="14.1073.0" data-gr-ext-installed="" data-scrolltop="on">
	<?php
	$url = $_SERVER['REQUEST_URI'];
	$path = parse_url($url, PHP_URL_PATH);
	$pathQuery = parse_url($url, PHP_URL_QUERY);
	$filename = basename($path);
	?>