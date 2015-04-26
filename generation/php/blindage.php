<?php

function blindage_parametres_doc_types($modifier)
{
$erreur="";
if(isset($_POST['date_debut']) && Empty($_POST['date_debut']))
	$erreur = $erreur."\n"."Vérifiez le champ de date de début";
elseif(isset($_POST['date_fin']) && Empty($_POST['date_fin']))
	$erreur = $erreur."\n"."Vérifiez le champ de date de fin";
elseif(isset($_POST['date_fin'])  && isset($_POST['date_debut']) && $erreur=="" && chevauchement_date_parametre_doc_type($_POST['date_debut'],$_POST['date_fin'],$modifier))
	$erreur = $erreur."\n"."Les dates saisies chevauchent un autre enregistrement !";
elseif(date_traitee_to_timestamp(traiter_date_parametre($_POST['date_debut']))>date_traitee_to_timestamp(traiter_date_parametre($_POST['date_fin'])))
	$erreur = $erreur."\n"."La date de fin doit être après la date de début !";
elseif(isset($_POST['taux_tva']) && (Empty($_POST['taux_tva']) || $_POST['taux_tva']<0 || $_POST['taux_tva']>100 || !is_numeric($_POST['taux_tva'])))
	$erreur = $erreur."\n"."Vérifiez le taux de TVA";
elseif(isset($_POST['jeh_bas']) && (Empty($_POST['jeh_bas']) || $_POST['jeh_bas']<0 || $_POST['jeh_bas']>10000 || !is_numeric($_POST['jeh_bas'])))
	$erreur = $erreur."\n"."Vérifiez la fourchette basse de JEH";
elseif(isset($_POST['jeh_haut']) && (Empty($_POST['jeh_haut']) || $_POST['jeh_haut']<0 || $_POST['jeh_haut']>10000 || !is_numeric($_POST['jeh_haut'])))
	$erreur = $erreur."\n"."Vérifiez la fourchette haute de JEH";
elseif(isset($_POST['jeh_bas']) && isset($_POST['jeh_haut']) && $_POST['jeh_bas']>$_POST['jeh_haut'])
	$erreur = $erreur."\n"."Le JEH bas ne peut-être supérieur au JEH haut";
elseif(isset($_POST['frais_structure']) && (Empty($_POST['frais_structure']) || $_POST['frais_structure']<0 || $_POST['frais_structure']>100 || !is_numeric($_POST['frais_structure'])))
	$erreur = $erreur."\n"."Vérifiez le taux de frais de structure";
elseif(isset($_POST['taux_renumeration_rm']) && (Empty($_POST['taux_renumeration_rm']) || $_POST['taux_renumeration_rm']<0 || $_POST['taux_renumeration_rm']>100 || !is_numeric($_POST['taux_renumeration_rm'])))
	$erreur = $erreur."\n"."Vérifiez le taux de phase d'analyse";
elseif(isset($_POST['taux_renumeration_rm']) && (Empty($_POST['taux_renumeration_rm']) || $_POST['taux_renumeration_rm']<0 || $_POST['taux_renumeration_rm']>100 || !is_numeric($_POST['taux_renumeration_rm'])))
	$erreur = $erreur."\n"."Vérifiez le taux de rénumération des étudiants";
	return $erreur;
}

function blindage_gestion_doc_types($modifier)
{
	$extensions_valides = array( 'docx','xlsm','xls' );
	if(isset($_FILES['fichier'])) $extension_upload = strtolower(  substr(  strrchr($_FILES['fichier']['name'], '.')  ,1)  );
	$erreur="";
	if(isset($_POST['date_debut']) && Empty($_POST['date_debut']))
		$erreur = $erreur."\n"."Vérifiez le champ de date de début";
	elseif(isset($_POST['date_fin']) && Empty($_POST['date_fin']))
		$erreur = $erreur."\n"."Vérifiez le champ de date de fin";
	elseif(isset($_POST['commentaires']) && strlen(trim($_POST['commentaires']))<1)
		$erreur = $erreur."\n"."Commentaire obligatoire ! (Quelles sont les modifs apportées par ce doc type ?)";
	 elseif(isset($_POST['date_fin'])  && isset($_POST['date_debut']) && $erreur=="" && chevauchement_date_gestion_doc_type($_POST['date_debut'],$_POST['date_fin'],$modifier,$_GET['type']))
		 $erreur = $erreur."\n"."Les dates saisies chevauchent un autre enregistrement !";
	elseif(date_traitee_to_timestamp(traiter_date_parametre($_POST['date_debut']))>date_traitee_to_timestamp(traiter_date_parametre($_POST['date_fin'])))
		$erreur = $erreur."\n"."La date de fin doit être après la date de début !";
	elseif (isset($_FILES['fichier']) && $_FILES['fichier']['error'] > 0 && $_POST['modifier']==-1) 
		$erreur =  $erreur."\n"."Vérifiez le fichier";
	elseif (isset($_FILES['fichier']) &&  !in_array($extension_upload,$extensions_valides )  && $_POST['modifier']==-1)
		$erreur =  $erreur."\n"."Le fichier n'est pas un .docx, ni un .xls";
		return $erreur;
}
	?>