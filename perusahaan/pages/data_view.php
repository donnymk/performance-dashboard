<?php
$idproduksi=$_GET['idproduksi'];

//mulai session yaitu menyimpan variabel sementara di server
$_SESSION['idproduksi']=$idproduksi;

    $result = mysqli_query($koneksi,"SELECT user, password FROM perusahaan where user='".$_SESSION['login']['username']."'");
    if($row = mysqli_fetch_assoc($result)){
        $user = $row['user'];
    }

    $query_produksi="SELECT DATE_FORMAT(tgldocin, '%d-%m-%Y') AS tgldocin, ayammasuk FROM produksi WHERE idproduksi='".$_SESSION['idproduksi']."'";
    $jalan_produksi=mysqli_query($koneksi,$query_produksi);
    if($row = mysqli_fetch_assoc($jalan_produksi)){
        $tgldocin = $row['tgldocin'];
    	$ayammasuk = $row['ayammasuk'];
    }

    //query untuk menampilkan data pemeliharaan ayam
    $query_recording="SELECT * FROM recording WHERE idproduksi='".$_SESSION['idproduksi']."'";
    $jalan_recording=mysqli_query($koneksi,$query_recording);
    //untuk memeriksa jumlah baris
    $jmlbaris = mysqli_num_rows($jalan_recording);
?>
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
        <li class="active"><a href="#">Data View</a></li>
        <li class="dropdown">
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
        <?= " ".$user ?>
        <span class="caret"></span></a>
        <ul class="dropdown-menu" role="menu">
	    <li><a href="logout.php"><span class='glyphicon glyphicon-log-out' aria-hidden='true'></span> Keluar</a></li>
        </ul>
        </li>
    </ul>
</div>
</div>
</nav>

<!-- Kolom untuk menampilkan proposal yang sudah diinput -->
<div class="col-md-12" align="center">
<!--<div class="table table-responsive">-->
  <table class="table table-bordered table-striped table-condensed">
    <tr>
        <td colspan="9"><h4>Data View</h4><?= "Periode ke: ".$idproduksi." | stok awal: ".$ayammasuk." | DOC: ".$tgldocin ?></td>
    </tr>
    <tr>
        <th>Hari ke</th><th>Jumlah mati & afkir</th><th>Jumlah pakan (sak)</th><th>Bobot rata (g)</th>
    </tr>
    <?php
    //jika data ditemukan
    while($row1 = mysqli_fetch_assoc($jalan_recording)){
        $umur = $row1['umur'];
    	$mati = $row1['mati'];
        $jmlpakan = $row1['jmlpakan'];
        $bbrata = $row1['bbrata'];
    ?>
        <tr>
            <td><?= $umur ?></td><td><?= $mati ?></td><td><?= $jmlpakan ?></td><td><?= $bbrata ?></td>
        </tr>
        <?php
    }
    ?>
</table>
</div>
<!--</div>-->