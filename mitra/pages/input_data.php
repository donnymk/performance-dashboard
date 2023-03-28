<?php
if(isset($_POST['submit'])){
    //Mulai memorises data
    $idproduksi=$_POST['idproduksi'];
    $umur=$_POST['hari'];
    $mati=$_POST['mati'];
    $afkir=$_POST['afkir'];
    $jmlpakan=$_POST['jmlpakan'];
    $matiafkir=($mati+$afkir);

    $query_masuk="INSERT INTO recording (idproduksi,umur,mati,jmlpakan) VALUES ('$idproduksi','$umur','$matiafkir','$jmlpakan')";
    if(isset($_POST['bobot'])){
        $bobot=$_POST['bobot'];
        $query_masuk="INSERT INTO recording (idproduksi,umur,mati,bbrata,jmlpakan) VALUES ('$idproduksi','$umur','$matiafkir','$bobot','$jmlpakan')";
    }

    mysqli_query($koneksi,$query_masuk);
?>
    <script>
    window.location = "?page=manage_data"+"&idproduksi="+"<?= $_SESSION['idproduksi'] ?>"+"&status="+"<?= $_SESSION['status'] ?>";
    </script>
<?php
}
?>