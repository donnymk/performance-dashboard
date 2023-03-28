<?php
session_start();
if (isset($_POST['username'])) {
    $username=$_POST['username'];
    $password=$_POST['password'];

    include "../plugins/koneksi.php";

    // Mencegah MySQL injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($koneksi, $username);
    $password = mysqli_real_escape_string($koneksi, $password);

    // SQL query untuk memeriksa apakah user terdapat di database?
    $query = mysqli_query($koneksi,"select * from perusahaan where user='$username' AND password='$password'");
    if(mysqli_num_rows($query)==0){
		echo '<div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Warning!</strong> Username dan / atau password salah.</div>';
	}
    else{
        $_SESSION['login']['username'] = $username;
		$_SESSION['login']['password'] = $password;
        echo "ok";
    }
}

?>