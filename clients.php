 
<?php include('connection.php');
     $msg="";
    
    if (isset($_POST['btnvalider'])){
	$sql="INSERT INTO clients (nom,prenom,email,telephone) 
	VALUES('".mysqli_real_escape_string($link,$_POST['nom'])."',
        '".mysqli_real_escape_string($link,$_POST['prenom'])."',
        '".mysqli_real_escape_string($link,$_POST['email'])."',
        '".mysqli_real_escape_string($link,$_POST['telephone'])."')";
    $result=mysqli_query($link,$sql);
				if ($result) {
					$msg='insertion reussie';
				}else{
					$msg=mysqli_error($link);
				}
		}

   if (isset($_GET['id'])){
	$update="SELECT * FROM clients WHERE id=".$_GET['id'];
	$res=mysqli_query($link,$update);
	$dataU=mysqli_fetch_array($res);
}

if (isset($_GET['sup'])){
	$delete="DELETE FROM clients WHERE id=".$_GET['sup'];
	$res=mysqli_query($link,$delete);
}

 ?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<?php include('menu.php'); ?>

	<header>
		<h1>formulaire</h1>
		</header>

<div class="row">

<form action="" role="form" method="POST">
<span>
			<?php echo $msg; ?>
		</span>

		<div class="container">
			<div class="well" id="tete">
				<legend style="color: #C44C51" >Enregistrement des clients</legend>
				</div>
			<div class="well">
				<div class="form-group">
					<label for="">nom:</label>
					<input type="text" class="form-control" name="nom" value="<?php if (isset($_GET['id'])) echo $dataU['nom']; ?>">
				</div>
				<div class="form-group">
					<label for="">prenom:</label>
					<input type="text" class="form-control" name="prenom" required value="<?php if (isset($_GET['id'])) echo $dataU['prenom']; ?>">
				</div>
				<div class="form-group">
					<label for="">email:</label>
					<input type="text" class="form-control" name="email" value="<?php if (isset($_GET['id'])) echo $dataU['email']; ?>">
				</div>
				<div class="form-group">
					<label for="">telephone:</label>
					<input type="text" class="form-control" name="telephone" value="<?php if (isset($_GET['id'])) echo $dataU['telephone']; ?>">
				</div>

				<button name="btnvalider" type="submit" class="btn btn-primary" >enregistrer</button>
				<a href="clients.php"><button name="" type="button" class="btn btn-warning">annuler</button></a>
				<a href="accueil.php"><button name="" type="button" class="btn btn-default">retour</button></a>
			 </div>
			</form>

			<div class="row">
				<table class="table">
					<thead>
						<tr>
							<th>Numero</th>
							<th>nom</th>
							<th>prenom</th>
							<th>email</th>
							<th>telephone</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$n=1;
							$list=" SELECT * FROM clients";
							$res= mysqli_query($link,$list);
	while ($data = mysqli_fetch_array($res)){
								?>
								<t r>
							<td> <?php echo $n; ?> </td>
							<td><?php echo $data['nom']; ?></td>
							<td><?php echo $data['prenom']; ?></td>
							<td><?php echo $data['email']; ?></td>
							<td><?php echo $data['telephone']; ?></td>
							<td>
								<a href="?id=<?php echo $data['id']; ?>"><button type="button" class="btn btn-info">Modifier</button></a>

				     <a href="?sup=<?php echo $data['id']; ?>"><button type="button" class="btn btn-danger">Supprimer</button></a>
							</td>
						</tr>
						
						<?php $n++;
						 } ?>
					 
					 </tbody>
				</table>

			</div>
			

		</div>
		


<style type="text/css">
	
	body{
		background-color: #DAD0CE
	}



        </div>
<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>

</body>
</html>