<?php
    $result = mysqli_query($koneksi,"SELECT idkandang, namapemilik, user, password FROM kandang where user='".$_SESSION['login']['username']."'");
    if($row = mysqli_fetch_assoc($result)){
        $idkandang = $row['idkandang'];
        $namapemilik = $row['namapemilik'];
    }

    //query untuk menampilkan data pemeliharaan ayam
    $query_recording="SELECT * FROM recording WHERE idproduksi='1'";
    $jalan_recording=mysqli_query($koneksi,$query_recording);
    //untuk memeriksa jumlah baris
    $jmlbaris = mysqli_num_rows($jalan_recording);
?>
<head>
    <link rel="stylesheet" href="razorflow_php/static/rf/css/razorflow.min.css"/>
    <script src="razorflow_php/static/rf/js/jquery.min.js" type="text/javascript"></script>
    <script src="razorflow_php/static/rf/js/razorflow.wrapper.min.js" type="text/javascript"></script>
    <script src="razorflow_php/static/rf/js/razorflow.devtools.min.js" type="text/javascript"></script>
</head>
<body>
<!-- Navigation -->
<nav class="navbar navbar-default">
<div class="container-fluid">
<div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
    <span class="sr-only">Toggle navigation</span>
    <span>Menu</span>
    </button>
    <a class="navbar-brand" href="./">Performance Dashboard</a>
</div>
<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
        <li><a href="?page=manage_data&idproduksi=<?= $_SESSION['idproduksi'] ?>&status=<?= $_SESSION['status'] ?>">Manage data</a></li>
        <li class="dropdown active">
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  Performance View <span class="caret"></span></a>
				  <ul class="dropdown-menu" role="menu">
                    <?php
                    $minggu=0;
                    for($hari=$jmlbaris;$hari>=7;$hari--){
                        $hari=$hari-6;
                        $minggu=$minggu+1;
                    ?>
                       <li><a href="?page=performance_view&minggu=<?= $minggu ?>">Minggu <?= $minggu ?></a></li>
                    <?php
                    }
                    ?>
				  </ul>
		</li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        <span class='glyphicon glyphicon-user' aria-hidden='true'></span>
        <?= " ".$namapemilik ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
	    <li><a href="logout.php"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Keluar</a></li>
        </ul>
        </li>
    </ul>
</div>
</div>
</nav>

<!--Kolom untuk pemberitahuan ketika pesan berhasil atau gagal upload proposal-->
<div class="col-md-12">
    <?php
    require("detail_minggu.php");
    $dashboard = new MyDashboard ();
    $dashboard->renderEmbedded();
    ?>
</div>

</body>