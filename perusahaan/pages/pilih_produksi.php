 <script type="text/javascript" language="JavaScript">
 function konfirmasi1()
 {
 tanya = confirm("Tandai produksi selesai?");
 if (tanya == true) return true;
 else return false;
 }</script>

<?php
    $result = mysqli_query($koneksi,"SELECT user FROM perusahaan where user='".$_SESSION['login']['username']."'");
    if($row = mysqli_fetch_assoc($result)){
        $user = $row['user'];
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

<!-- Kolom untuk menampilkan data produksi-->
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
                $buttonselesai="<button type='submit' class='btn btn-default btn-xs' name='selesai' onclick='return konfirmasi1()'>Tandai selesai</button>";
            }
            else{
                $status='selesai';
                $buttonselesai="";
            }
    ?>
    <tr>
		<td><?= $idproduksi ?></td>
        <td>
        <b><a href="?page=data_view&idproduksi=<?= $idproduksi ?>"><?= $tgldocin ?></a></b>
        </td>
        <td><?= $ayammasuk ?> ekor</td><td><?= $status ?></td>
        <td>
        <form method='post' action='?page=selesai'>
        <input type='hidden' name='idproduksi' value='<?= $idproduksi ?>'>
        <?= $buttonselesai ?>
        </form>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<a href="javascript:;" data-id="" data-toggle="modal" data-target="#modal-tambah-produksi"><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Tambah produksi</a>
</div>

<!-- modal tambah produksi-->
<div id="modal-tambah-produksi" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
	            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	            <h4 class="modal-title">Tambah Produksi</h4>
            </div>
            <div class="modal-body" align="center">
                <form action="?page=save_produksi" method="post" role="form">
                    <div class="form-group form-inline">
                    <strong>Tanggal </strong>
                    <select type="text" id="tgl" class="form-control input-sm" name="tgl">
                    <?php
                    for($tgl=1;$tgl<=31;$tgl++){
                    ?>
                    <option value='<?= $tgl ?>'><?= $tgl ?></option>
                    <?php
                    }
                    ?>
                    </select>
                    <select type="text" id="bulan" class="form-control input-sm" name="bulan">
                      <option value='01' name="add">Januari</option><option value="02">Pebruari</option><option value="03">Maret</option>
                      <option value="04">April</option><option value="05">Mei</option><option value="06">Juni</option>
                      <option value="07">Juli</option><option value="08">Agustus</option><option value="09">September</option>
                      <option value="10">Oktober</option><option value="11">Nopember</option><option value="12">Desember</option>
                    </select>
                    <select type="text" id="tahun" class="form-control input-sm" name="tahun">
                        <?php
                        $query_tahun="select year(now()) as tahun";
                        $tahun=mysqli_query($koneksi,$query_tahun);
                        if($row=mysqli_fetch_object($tahun)){
                        	$thn = $row -> tahun;
                        }
                        for($date=$thn;$date<=$thn+1;$date++){
                        ?>
                        <option value='<?= $date ?>'><?= $date ?></option>
                        <?php
                        }
                        ?>
                    </select>
                    </div>
                    <div class="form-group form-inline">
                    <strong>Stok awal </strong><input type=text name="stok" class="form-control" required>
                    </div>
                <button class="btn btn-danger" type="submit" name="submit">
                <span class='glyphicon glyphicon-floppy-disk' aria-hidden='true'></span> OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>