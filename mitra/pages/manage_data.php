<!--Jika selected hari = 7, 14, 21, 28, 35 dan 42 maka input bobot tersedia -->
<script>
    $(document).ready(function() {
    $('#bobot').attr('disabled','disabled');
    $('select[name="hari"]').on('change',function(){
    var  hari = $(this).val();
        if(hari == "7" || hari == "14" || hari == "21" || hari == "28" || hari == "35" || hari == "42"){
        $('#bobot').removeAttr('disabled');
         }else{
         $('#bobot').attr('disabled','disabled');
        }

      });
    });
</script>

<?php
$idproduksi=$_GET['idproduksi'];
$status=$_GET['status'];
$disabled="";
if($status=="selesai"){
    $disabled="disabled";
}

//mulai session yaitu menyimpan variabel sementara di server
$_SESSION['idproduksi']=$idproduksi;
$_SESSION['status']=$status;

    $result = mysqli_query($koneksi,"SELECT idkandang, namapemilik, user, password FROM kandang where user='".$_SESSION['login']['username']."'");
    if($row = mysqli_fetch_assoc($result)){
        $idkandang = $row['idkandang'];
        $namapemilik = $row['namapemilik'];
    }

    $query_produksi="SELECT DATE_FORMAT(tgldocin, '%d-%m-%Y')AS tgldocin, ayammasuk FROM produksi WHERE idproduksi='".$_SESSION['idproduksi']."'";
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
        <li class="active"><a href="#">Manage data</a></li>
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

<!--Kolom untuk pemberitahuan ketika pesan berhasil atau gagal-->
<div id="msg" class="col-md-12">
    <?php
    //script untuk input data jika submit button diklik
    include "input_data.php";
    ?>
</div>

<!-- Kolom untuk form input data pemeliharaan ayam -->
<div class="col-md-4">
    <form id="uploadForm" method="post" role="form">
    <table class="table table-bordered">
        <tr>
            <td><h4>Input data pemeliharaan broiler</h4></td>
        </tr>
<tr>
    <td>
    <div class="form-group">
        <strong>Hari *</strong><br/>
    <input type="hidden" name="idproduksi" value="<?= $_SESSION['idproduksi'] ?>">
    <select type="text" id="hari" class="form-control" name="hari" required>
        <option value=''>--Pilih--</option>
        <?php
        for($hari=1;$hari<=42;$hari++){
        ?>
        <option value='<?= $hari ?>'><?= $hari ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="form-group">
    <div class="row">
    <div class="col-md-6">
        <strong>Jumlah mati *</strong><br/>
  <input type="number" id="mati" class="form-control" name="mati" placeholder="0" min="0" max="99" required>
    </div>
    <div class="col-md-6">
    <strong>Jumlah afkir *</strong><br/>
    <input type="number" id="afkir" class="form-control" name="afkir" placeholder="0" min="0" max="99" required>
    </div>
    </div>
    </div>
    <div class="form-group">
    <div class="row">
    <div class="col-md-6">
    <strong>Jumlah pakan (sak) *</strong><br/>
    <input type="text" id="jmlpakan" class="form-control" name="jmlpakan" placeholder="0" min="1" max="99" required>
    </div>
    <div class="col-md-6">
        <strong>Bobot rata-rata (g) *</strong><br/>
  <input type="number" id="bobot" class="form-control" name="bobot" placeholder="0" min="0" max="2999">
    </div>
    </div>
    </div>
    </td>
</tr>
</table><center>
<button type="submit" class="btn btn-danger" name="submit" <?= $disabled ?>>Simpan</button>
</center>
    </form>
</div>

<!-- Kolom untuk menampilkan data pemeliharaan ayam -->
<div class="col-md-8" align="center">
<!--<div class="table table-responsive">-->
  <table class="table table-bordered table-striped table-condensed">
    <tr>
        <td colspan="9"><h4>Data View</h4><?= "Periode ke: ".$idproduksi." | stok awal: ".$ayammasuk." | DOC in: ".$tgldocin ?></td>
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