<?php
if (isset($_POST['tgl']))
 { $tgl=$_POST['tgl']; }

if (isset($_POST['bulan']))
 { $bulan=$_POST['bulan']; }

if (isset($_POST['tahun']))
 { $tahun=$_POST['tahun']; }

if (isset($_POST['stok']))
 { $stok=$_POST['stok']; }

	  // Memasukkan data ke dalam tabel //
 $query_masuk="INSERT INTO produksi (idkandang,tgldocin,ayammasuk,status)VALUES ('1','$tahun-$bulan-$tgl','$stok','1')";
	 // Simpan ke Database
	mysqli_query($koneksi,$query_masuk);
 	echo "<script>
		location.replace('./')</script>";
 ?>