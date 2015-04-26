<?php
if(session_id() == "")session_start();
if(!isset($_SESSION['id']))
header("location: ../index.php?error=2");

include("php/connexion.php");
include("php/verification.php");
include("php/traitement.php");


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>[JEECE] Liste des membres</title>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="jquery.dataTables.js"></script>
<script type="text/javascript" src="../generation/js/calendar.js"></script>
<script type="text/javascript" src="js/scriptMembres.js"></script>
<script type="text/javascript" src="dataTables.colVis.js"></script>
<script type="text/javascript" src="dataTables.colReorder.js"></script>

<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
<link rel="Stylesheet" type="text/css" href="../generation/css/calendar.css" />
<link rel="Stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<link rel="Stylesheet" type="text/css" href="css/dataTables.colVis.css" />
<link rel="Stylesheet" type="text/css" href="css/dataTables.colReorder.css" />
<link rel="Stylesheet" type="text/css" href="css/style.css" />
</head>

<body align="center">
<a href="../">
<h3 align="left"> Retour Accueil</h3>
</a>
<h2 align="center"> Liste des membres</h2>
    <fieldset style="width:50px;margin-left: auto;margin-right: auto;">
      <legend>Année</legend>
      <select name="annee" id="annee_id" size="1" onchange="majAnnee()" >
        <OPTION value="toutes">Toutes
        <?php  for($i=date("Y");$i>1985;$i--)
		{?>
        <OPTION <?php  if ((date("m")>6 && $i==date("Y")) || (date("m")<6 && $i==(date("Y")-1))) echo "selected";?> value=<?php echo $i; ?> ><?php echo $i."/".($i+1); ?>
        <?php } ?>
      </select>
      </fieldset><br />
<table class="display" id="example" align="center" border="1" cellspacing="0" cellpadding="0" style="width:90%">
  <thead>
    <tr>
    
      <td>Nom</td>
      <td>Prénom</td>
      <td>Année</td>
      <td>Adresse</td>
      <td>Code Postal</td>
      <td>Ville</td>
      <td>Mail</td>
      <td>Mail JEECE</td>
      <td>Tel</td>
      <td>Promo</td>
      <td>Bureau</td>
      <td>CA</td>
      <td>Poste</td>
      <td>Intervenant</td>
      <td>Date CE</td>
      <td>Ref CE</td>
      <td>Dossier Etudiant Complet</td>
    </tr>
  </thead>
  <tbody>
    <?php
		$reponse = $bdd->query('SELECT * FROM rh_annee,rh WHERE rh_annee.membre=rh.id');
		// On affiche chaque entrée une à une
		while ($donnees = $reponse->fetch())
		{?>
    <tr>
      <td><?php echo $donnees['nom']; ?></td>
      <td><?php echo $donnees['prenom']; ?></td>
      <td><?php echo $donnees['annee']; ?></td>
      <td><?php echo $donnees['adresse']; ?></td>
      <td><?php echo $donnees['cp']; ?></td>
      <td><?php echo $donnees['ville']; ?></td>
      <td><?php echo $donnees['email']; ?></td>
      <td><?php echo $donnees['email_jeece']; ?></td>
      <td><?php echo wordwrap($donnees['tel'],2," ",1); ?></td>
      <td><?php echo $donnees['promotion']; ?></td>
      <td><?php if($donnees['bureau']==1) echo "<img alt='1' src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg' alt='0'></img>" ?></td>
      <td><?php if($donnees['ca']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php echo $donnees['poste']; ?></td>
      <td><?php if($donnees['intervenant']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php 	if($donnees["date_ce"]=="0000-00-00") echo "";
	else echo date('d/m/Y',strtotime($donnees['date_ce'])); ?></td>
      <td><?php echo $donnees['ref_ce']; ?></td>
      <td><?php if($donnees['cheque']==1 && $donnees['ce_signee']==1 && $donnees['cni']==1 && $donnees['carte_vitale']==1 && $donnees['carte_etudiant']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
    </tr>
    <?php
		}?>
  </tbody>
</table>
<br /> <br />
</body>
