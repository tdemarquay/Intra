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
<title>[JEECE] Liste des intervenants</title>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="jquery.dataTables.js"></script>
<script type="text/javascript" src="../generation/js/calendar.js"></script>
<script type="text/javascript" src="js/scriptIntervenants.js"></script>
<script type="text/javascript" src="dataTables.colVis.js"></script>
<script type="text/javascript" src="dataTables.colReorder.js"></script>

<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
<link rel="Stylesheet" type="text/css" href="../generation/css/calendar.css" />
<link rel="Stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<link rel="Stylesheet" type="text/css" href="css/style.css" />
<link rel="Stylesheet" type="text/css" href="css/dataTables.colVis.css" />
<link rel="Stylesheet" type="text/css" href="css/dataTables.colReorder.css" />
</head>

<body align="center">
<a href="../">
<h3 align="left"> Retour Accueil</h3>
</a>
<h2 align="center"> Liste des intervenants</h2>

<table class="display" id="example" align="center" border="1" cellspacing="0" cellpadding="0" style="width:90%">
  <thead>
    <tr>
    
      <td>Nom</td>
      <td>Prénom</td>
      <td>Adresse</td>
      <td>Code Postal</td>
      <td>Ville</td>
      <td>Mail</td>
      <td>Mail JEECE</td>
      <td>Tel</td>
      <td>Promo</td>
      <td>Date CE</td>
      <td>Ref CE</td>
      <td>Dossier Etudiant Complet</td>
      <td>Android</td>
      <td>iOs</td>
      <td>Windows Phone</td>
      <td>VBA</td>
      <td>Java</td>
      <td>C/C++</td>
      <td>Sites Web</td>
      <td>Electronique</td>
      <td>Traduction</td>
      <td>Commentaires Compétences</td>
    </tr>
  </thead>
  <tbody>
    <?php
	
	
	
	
	if(date("m") <9)
	$reponse = $bdd->query('SELECT * FROM rh WHERE intervenant=1 AND promotion >='.date("Y"));
	else
		$reponse = $bdd->query('SELECT * FROM rh WHERE intervenant=1 AND promotion >'.date("Y"));
		
		// On affiche chaque entrée une à une
		while ($donnees = $reponse->fetch())
		{
			
			//Dossier etudiant complet ?
			if(date("m") <6)
			$reponse2 = $bdd->query('SELECT * FROM rh_annee WHERE membre='.$donnees['id'].' AND annee=\''.(date("Y")-1).'/'.(date("Y")).'\'');
			else
			$reponse2 = $bdd->query('SELECT * FROM rh_annee WHERE membre='.$donnees['id'].' AND annee=\''.date("Y").'/'.(date("Y")+1).'\'');
			$dossier=0;
			while ($donnees2 = $reponse2->fetch())
			{
				if($donnees2['cheque']==1  && $donnees2['carte_etudiant']==1)
				$dossier=1;
			}
			
			?>
    <tr>
      <td><?php echo $donnees['nom']; ?></td>
      <td><?php echo $donnees['prenom']; ?></td>
      <td><?php echo $donnees['adresse']; ?></td>
      <td><?php echo $donnees['cp']; ?></td>
      <td><?php echo $donnees['ville']; ?></td>
      <td><?php echo $donnees['email']; ?></td>
      <td><?php echo $donnees['email_jeece']; ?></td>
      <td><?php echo wordwrap($donnees['tel'],2," ",1); ?></td>
      <td><?php echo $donnees['promotion']; ?></td>
      <td><?php 	if($donnees["date_ce"]=="0000-00-00") echo "";
	else echo date('d/m/Y',strtotime($donnees['date_ce'])); ?></td>
      <td><?php echo $donnees['ref_ce']; ?></td>
      <td><?php if($donnees['ce_signee']==1 && $donnees['cni']==1 && $donnees['carte_vitale']==1 && $dossier==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['ios']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['android']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['windows_phone']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['vba']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['java']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['C']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['site']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['electronique']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if( $donnees['traduction']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php echo $donnees['competences']; ?></td>
    </tr>

    <?php
		}?>
  </tbody>
</table>
<br /> <br />
</body>
