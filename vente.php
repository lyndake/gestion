<?php include('connection.php');
    $msg="";

if (isset($_POST['btnvalider'])){
			$sql= "INSERT INTO vente
			 (date,id_produit,quantite,prix,montant,id_clients,id_employe)
			 VALUES ('".mysqli_real_escape_string($link,$_POST['date'])."',
			 		      '".$_POST['id_produit']."',
			 		      '".mysqli_real_escape_string($link,$_POST['quantite'])."',
			 		      '".mysqli_real_escape_string($link,$_POST['prix'])."',
			 		      '".mysqli_real_escape_string($link,$_POST['montant'])."',
			 		      '".$_POST['id_clients']."',
			 		      '".$_POST['id_employe']."')";
			$result=mysqli_query($link,$sql);
			if ($result) {
				$msg='Insertion reussie';
			}else{
				$msg=mysqli_error($link);
			}
		
		}


   if (isset($_GET['id'])){
	$update="SELECT * FROM vente WHERE id=".$_GET['id'];
	$res=mysqli_query($link,$update);
	$dataU=mysqli_fetch_array($res);

 }


	if (isset($_GET['sup'])){
	$delete="DELETE FROM vente WHERE id=".$_GET['sup'];
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
		<h1 style="color: #046380">Ventes</h1>
	</header>
	<div class="row">
<form action="" role="form" method="POST">

		<span>

			<?php echo $msg; 	?>
</span>

		<div class="container">
			<div class="well" id="tete">
				<legend style="color: #C44C51">Enregistrement de ventes</legend>
			</div>
			<div class="well">
				<div class="form-group">
					<label for="">date:</label>
					<input type="date" class="form-control" name="date" value="<?php if (isset($_GET['id'])) echo $dataU['date']; ?>">
				</div>
				<div class="form-group">
					<label for="">id_produit:</label>
					<select class="form-control" name="id_produit">
					<?php
					
					$sqlproduit="SELECT * FROM produit";
					$repproduit=mysqli_query($link,$sqlproduit);
					while ($datacat=mysqli_fetch_array($repproduit)) {
						?>
						<option value="<?php echo $datacat['id'];?>">
						<?php echo $datacat['designation'];?>
						</option>

						<?php
					   }
					?>
				</select>
				</div>
				<div class="form-group">
					<label for="">quantite:</label>
					<input type="text" class="form-control" name="quantite" required value="<?php if (isset($_GET['id'])) echo $dataU['quantite']; ?>">
				</div>
				<div class="form-group">
					<label for="">prix:</label>
					<input type="text" class="form-control" name="prix" value="<?php if (isset($_GET['id'])) echo $dataU['prix']; ?>">
				</div>
				<div class="form-group">
					<label for="">montant:</label>
					<input type="text" class="form-control" name="montant" value="<?php if (isset($_GET['id'])) echo $dataU['montant']; ?>">
				</div>
				<div class="form-group">
					<label for="">id_clients:</label>
					<select class="form-control" name="id_clients">
					<?php
					
					$sqlclients="SELECT * FROM clients";
					$repclients=mysqli_query($link,$sqlclients);
					while ($datacat=mysqli_fetch_array($repclients)) {
						?>
						<option value="<?php echo $datacat['id'];?>">
						<?php echo $datacat['nom'];?>
						</option>

						<?php
					   }
					?>
				</select>
				</div>
				<div class="form-group">
					<label for="">id_employe:</label>
					<select class="form-control" name="id_employe">
					<?php
					
					$sqlemploye="SELECT * FROM employe";
					$repemploye=mysqli_query($link,$sqlemploye);
					while ($datacat=mysqli_fetch_array($repemploye)) {
						?>
						<option value="<?php echo $datacat['id'];?>">
						<?php echo $datacat['prenom'];?>
						</option>

						<?php
					   }
					 ?>
				</select>
				</div>
				    
				    <button name="btnvalider" type="submit" class="btn btn-primary" >enregistrer</button>
				    <a href="vente.php"><button name="" type="button" class="btn btn-warning">annuler</button></a>
				    <a href="accueil.php"><button name="" type="button" class="btn btn-default">retour</button></a>
			 </div>
			</div>
		</form>

			<div class="row">
				<table class="table" id="bas">
					<thead>
						<tr>
							<th>Numero</th>
							<th>date</th>
							<th>id_produit</th>
							<th>quantite</th>
							<th>prix</th>
							<th>montant</th>
							<th>id_clients</th>
							<th>id_employe</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$n=1;
							$list=" SELECT
							      date,
							      produit.designation,
							      vente.quantite,
							      vente.prix,
							      montant,
							      clients.nom,
							      employe.prenom
							    FROM vente
							    LEFT JOIN produit
							    ON vente.id_produit = produit.id
							    LEFT JOIN clients
							    ON vente.id_clients = clients.id
							    LEFT JOIN employe 
							    ON vente.id_employe = employe.id";
							
							$res= mysqli_query($link,$list);
	while ($data = mysqli_fetch_array($res)){
								
								?>
								<tr>
							<td> <?php echo $n; ?> </td>
							<td><?php echo $data['date']; ?></td>
							<td><?php echo $data['designation']; ?></td>
							<td><?php echo $data['quantite']; ?></td>
							<td><?php echo $data['prix']; ?></td>
							<td><?php echo $data['montant']; ?></td>
							<td><?php echo $data['nom']; ?></td>
							<td><?php echo $data['prenom']; ?></td>
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