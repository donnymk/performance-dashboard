<?php
$idproduksi=$_POST['idproduksi'];

mysqli_query($koneksi,"UPDATE produksi SET status='0' WHERE idproduksi='".$idproduksi."'");
echo "<script>
    location.replace('./')</script>";
?>