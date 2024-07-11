<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title><?php echo COMPANY ?></title>
	<!-- links css -->	
    <?php include "./views/include/css.php"; ?>

</head>
<body>
	<?php 
		$ajaxRequest=false; 
		require_once "./controllers/viewsController.php";
		$instanceView = new viewsController();
		$views = $instanceView->getControllerViews();

		if($views=="login" || $views=="404"){
			require_once "./views/contents/".$views."View.php";
		}else{
	?>
	<!-- Main container -->
	<main class="full-box main-container">
		<!-- Nav lateral -->
        <?php include "./views/include/navLateral.php"; ?>
		<!-- Page content -->
		<section class="full-box page-content">
		<?php 
			include "./views/include/navBar.php"; 
			include $views;			
		?>			
	</main>
		
	<!-- Scrpts -->
    <?php } include "./views/include/scripts.php"; ?>
	
	
</body>
</html>