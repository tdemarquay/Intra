<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
include("connexion.php");

	$reponse = $bdd->query("SELECT * FROM gestion_docs_types WHERE cle=".$_GET['telecharger']);
	$donnees = $reponse->fetch();
	$chemin = "../".strtoupper($donnees['type'])."/docs/".$donnees['date_debut'].".".$donnees['format'];
	$nom = $donnees['date_debut'].".".$donnees['format'];
	header('Content-disposition: attachment; filename="'.strtoupper($donnees['type']).'-'.$nom.'"');
	header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
	readfile($chemin);

	
?>