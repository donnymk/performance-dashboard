<?php include "session.php"; ?>
<!DOCTYPE  html>
<html>
	<head>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Performance Dashboard - Farm Kemitraan Broiler</title>
        <!-- CSS -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
	<link href="../assets/css/TableZebra.css" rel="stylesheet">
    <!--<link href="../assets/css/custom-navbar.css" rel="stylesheet">-->
	<!-- Add jQuery library -->
	<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	</head>
<body>
<div class="container">
  	<div class="row">
    <div class="content">
  	<?php
			if(empty($_GET['page'])){
				include("pages/pilih_produksi.php");
			}
			else {
				$page = $_GET['page'];
				$file = "pages/$page.php";
				if (file_exists($file)) {
					include("pages/$page.php");
				}
				else {
					include("pages/pilih_produksi.php");
				}
			}
		?>
    </div>
    </div>
  </div>
  <br>
  </body>
</html>