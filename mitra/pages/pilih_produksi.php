<?php
    $result = mysqli_query($koneksi,"SELECT idkandang, namapemilik FROM kandang where user='".$_SESSION['login']['username']."'");
    if($row = mysqli_fetch_assoc($result)){
        $idkandang = $row['idkandang'];
        $namapemilik = $row['namapemilik'];
    }

    $query_produksi="SELECT idproduksi, DATE_FORMAT(tgldocin, '%d-%m-%Y')AS tgldocin, ayammasuk, status FROM produksi WHERE idkandang='1'";
    $jalan_produksi=mysqli_query($koneksi,$query_produksi);
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

<!-- Kolom untuk menampilkan data pemeliharaan ayam -->
<div class="col-md-12" align="center">

<table>
<tr>
        <td colspan="3">Pilih periode produksi</td>
    </tr>
<tr>
        <th>No</th><th>Tanggal</th><th>Stok awal</th><th>Status</th>
    </tr>
    <?php
        while($row = mysqli_fetch_assoc($jalan_produksi)){
            $idproduksi = $row['idproduksi'];
            $tgldocin = $row['tgldocin'];
    	    $ayammasuk = $row['ayammasuk'];
            $status = $row['status'];
            if($status==1){
                $status='berlangsung';
            }
            else{
                $status='selesai';
            }
    ?>
    <tr>
		<td><?= $idproduksi ?></td>
        <td>
        <b><a href="?page=manage_data&idproduksi=<?= $idproduksi ?>&status=<?= $status ?>"><?= $tgldocin ?></a></b>
        </td>
        <td><?= $ayammasuk ?> ekor</td><td><?= $status ?></td>
    </tr>
    <?php
    }
    ?>
</table>
</div>