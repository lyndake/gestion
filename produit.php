<?php include('connection.php');
    $msg="";

if (isset($_POST['btnvalider'])){
			$sql= "INSERT INTO produit
			 (designation,quantite,prix,description,id_fournisseur)
			 VALUES ('".mysqli_real_escape_string($link,$_POST['designation'])."',
			 		      '".mysqli_real_escape_string($link,$_POST['quantite'])."',
			 		      '".mysqli_real_escape_string($link,$_POST['prix'])."',
			 		      '".mysqli_real_escape_string($link,$_POST['description'])."',
			 		      '".$_POST['id_fournisseur']."')";
			$result=mysqli_query($link,$sql);
			if ($result){
				$msg='Insertion reussie';
			}else{
				$msg=mysqli_error($link);
			}
		
		}

   if (isset($_GET['id'])){
	$update="SELECT * FROM produit WHERE id=".$_GET['id'];
	$res=mysqli_query($link,$update);
	$dataU=mysqli_fetch_array($res);

 }

	if (isset($_GET['sup'])){
	$delete="DELETE FROM produit WHERE id=".$_GET['sup'];
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
				<legend style="color: #C44C51">Enregistrement de produits</legend>
				</div>
					    <div class="well">
			            <div class="form-group">
					               <label for="">designation:</label>
					                    <input type="text" class="form-control" name="designation" value="<?php if (isset($_GET['id'])) echo $dataU['designation']; ?>">
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
					              <label for="">description:</label>
					              <input type="text" class="form-control" name="description" value="<?php if (isset($_GET['id'])) echo $dataU['description']; ?>">
				            </div>
				            <div class="form-group">
				           	<label for="">id_fournisseur:</label>
					<select class="form-control" name="id_fournisseur">
					<?php
					
					$sqlfournisseur="SELECT * FROM fournisseur";
					$repfournisseur=mysqli_query($link,$sqlfournisseur);
					while ($datacat=mysqli_fetch_array($repfournisseur)) {
						?>
						<option value="<?php echo $datacat['id'];?>">
						<?php echo $datacat['id'].'-'.$datacat['nom'];?>
						</option>

						<?php
					   }
					?>
				</select>
	   	</div>
				<button type="submit" name="btnvalider" class="btn btn-primary">enregistrer</button>
				<a href="produit.php"><button name="" type="button" class="btn btn-warning">annuler</button></a>
				<a href="accueil.php"><button name="" type="button" class="btn btn-default">retour</button></a>
			 </div>
			</div>
			</form>
	</div>
		</form>

			<div class="row">
				<table class="table" id="bas">
					<thead>
						<tr>
							<th>Numero</th>
							<th>designation</th>
							<th>quantite</th>
							<th>prix</th>
							<th>description</th>
							<th>id_fournisseur</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$n=1;
							$list=" SELECT
							designation,
							quantite,
							prix,
							description,
							fournisseur.nom
							FROM produit
							LEFT JOIN fournisseur
							ON produit.id_fournisseur = fournisseur.id";
							$res= mysqli_query($link,$list);
	      while ($data= mysqli_fetch_array($res)){
								?>
								<tr>
							<td> <?php echo $n; ?> </td>
							<td><?php echo $data['designation']; ?></td>
							<td><?php echo $data['quantite']; ?></td>
							<td><?php echo $data['prix']; ?></td>
							<td><?php echo $data['description']; ?></td>
							<td><?php echo $data['nom']; ?></td>
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
</div>







<style type="text/css">
	body{
		background-color: #DAD0CE
	}



<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="bootstrap.min.js"></script>
</body>
</html>" "