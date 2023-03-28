<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Performance Dashboard - Farm Kemitraan Broiler</title>
		<!-- CSS -->
		<link href="../assets/images/logo_jawa_tengah_icon.ico" rel="icon" type="image/x-icon">
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/style.css" rel="stylesheet">
	<link href="../assets/css/TableZebra.css" rel="stylesheet">
    <!--<link href="../assets/css/custom-navbar.css" rel="stylesheet">-->
    <!-- Add jQuery library -->
	<script src="../assets/js/jquery.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
    <script>
    function check_login() {
        var username=document.getElementById('username').value;
        var password=document.getElementById('password').value;
        var dataString='username='+ username + '&password='+password;
        if (username==""){
    	    $('#username').focus();
    	    //return true;
    	}
    	else if (password==""){
    	    $('#password').focus();
    	    //return true;
    	}
        else{
            //Ubah tulisan pada elemen <p> saat click login
    	    $('#msg').html('<center><br><label>Silakan tunggu ...</label></center>');
            $.ajax({
                type:"post",
                url: "proses.php",
                data:dataString,
                cache:false,
                success: function(pesan){
                    if(pesan=='ok'){
    				    //Arahkan ke halaman utama jika script pemroses mencetak kata ok
    				    window.location = './';
    			    }
    			    else{
    				    //Cetak peringatan untuk username & password salah
    				    $('#msg').html(pesan);
    			    }
                }
            });
            return false;
        }
    }
    </script>
	</head>
<body>
<!-- Navigation -->
<div class="container">
<nav class="navbar navbar-default">
<div class="navbar-header">
	  <a class="navbar-brand" href="#">Performance Dashboard</a>
</div>
</nav>
</div>
    <div class="container">
    <div id="msg" style="min-height: 50px"></div>
	      <form method="post">
			<center><table>
            <tr><td colspan="2"><h4>MASUK (PERUSAHAAN)</h4></td></tr>
			<tr>
            <td>
            <div class="form-group">
            <span class='glyphicon glyphicon-user' aria-hidden='true'></span> Username<br/>
			<input class="form-control" id="username" name="username" type="text" required>
            </div>
            <div class="form-group">
            <span class='glyphicon glyphicon-lock' aria-hidden='true'></span> Password<br/>
			<input class="form-control" id="password" name="password" type="password" required>
            </div>
            </td></tr>
			</table>
			<center><button class="btn btn-primary" type="submit" name="submit" onclick="return check_login()"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Masuk</button></center>
			</center>
		  </form>
	</div>
  </body>
</html>