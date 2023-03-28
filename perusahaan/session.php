<?php
session_start();
include "../plugins/koneksi.php";
/*if(!isset($login_session)){
mysqli_close($koneksi); // Menutup koneksi
echo "<script>
		location.replace('user_login.php')</script>";
}*/
if(!isset($_SESSION['login'])){
    mysqli_close($koneksi); // Menutup koneksi
	header('location: user_login.php');
}

// Ambil nama user berdasarkan username dengan mysql_fetch_assoc
//$ses_sql=mysqli_query($koneksi,"select user from bidang_teknis where user='".$_SESSION['login']['username']."'");
//$row = mysqli_fetch_assoc($ses_sql);
//$login_session =$row['user'];

?>