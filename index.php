<?php
$databaseHost = 'localhost';
$databaseName = 'test';
$databaseUsername = 'root';
$databasePassword = '';
 
$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName);
if (isset($_POST['nama'])) {
 	$nama = strip_tags(mysql_real_escape_string(trim($_POST['nama'])));
 	$email = strip_tags(mysql_real_escape_string(trim($_POST['mail'])));
 	$id = strip_tags(mysql_real_escape_string(trim($_POST['id_user'])));

 	if(isset($id)) {	
	 		$sql = "update user set nama ='".$nama."', email='".$email."' where id='".$id."'";
	 		
	    	$query = mysqli_query($mysqli, $sql);
 	}else{
 			$sql = "insert into user(nama, email) values('".$nama."','".$email."')";
	    	$query = mysqli_query($mysqli, $sql);
 	}	

    if ($query) {
    	echo "Sukses";
    }else{
    	echo mysql_error();
    }
 }

if(isset($_GET)) {
	$id = strip_tags(mysql_real_escape_string(trim($_GET['id'])));
	$sql = "SELECT * FROM user WHERE id=$id";
	$query = mysqli_query($mysqli, $sql);
	$user = mysqli_fetch_assoc($query);
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Tester</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<body>
<div class="form-group col-md-4">
	<form method="POST" action="index.php">
		<input type="hidden" name="id_user" value="<?php echo $user['id']; ?>">
		<input type="text" name="nama" class="form-control" value="<?php echo $user['nama']; ?>"> 
		<input type="email" name="mail" class="form-control" value="<?php echo $user['email']; ?>">
		<button type="submit" class="btn btn-primary">Simpan</button>
	</form>
</div>
<div>
	<table class="table table-responsive">
		<tr>
			<th>Nomor</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Aksi</th>
		</tr>
		<?php
		$result = mysqli_query($mysqli, "SELECT * FROM user ORDER BY id DESC");
		 while($value = mysqli_fetch_array($result)){
		?>
		<tr>

			<td><?php echo $value['id']; ?></td>
			<td><?php echo $value['nama']; ?></td>
			<td><?php echo $value['email'];?></td>
			<td>
				<center>
					<a href="index.php?id=<?php echo $value[id]; ?>">Edit</a>
					<a href="index.php?id=<?php echo $value[id]; ?>">Hapus</a>
				</center>
			</td>
		</tr>
		<?php } ?>
	</table>
</div>
</body>
</html>