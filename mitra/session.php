<?php
session_start();
include "../plugins/koneksi.php";

// Ambil nama user berdasarkan username dengan mysql_fetch_assoc
$ses_sql=mysqli_query($koneksi,"select user from kandang where user='".$_SESSION['login']['username']."'");
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['user'];
if(!isset($login_session)){
mysqli_close($koneksi); // Menutup koneksi
echo "<script>
		location.replace('../')</script>";
}
?>