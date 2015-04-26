<?php
function chevauchement_date_parametre_doc_type($debut,$fin,$cle)
{
	include("php/connexion.php");
	$debut=traiter_date_parametre($debut);
	$fin=traiter_date_parametre($fin);
	$debut = date_traitee_to_timestamp($debut);
	$fin = date_traitee_to_timestamp($fin);
	$reponse = $bdd->query('SELECT * FROM parametre_doc_type');
	$result=false;
	// On affiche chaque entrée une à une
	while ($donnees = $reponse->fetch())
	{	
		$debut_tmp=$debut;
		while($debut_tmp<=$fin && $donnees['cle']!=$cle)
		{
			if($debut_tmp>=strtotime($donnees['date_debut']) && $debut_tmp<=strtotime($donnees['date_fin']))
				return true;
			$debut_tmp=$debut_tmp+60*60*24;
		}
	}
	return false;
}

function chevauchement_date_gestion_doc_type($debut,$fin,$cle,$type)
{
	include("php/connexion.php");
	$debut=traiter_date_parametre($debut);
	$fin=traiter_date_parametre($fin);
	$debut = date_traitee_to_timestamp($debut);
	$fin = date_traitee_to_timestamp($fin);
	$reponse = $bdd->query('SELECT * FROM gestion_docs_types WHERE type=\''.$type.'\'');
	$result=false;
	// On affiche chaque entrée une à une
	while ($donnees = $reponse->fetch())
	{	
		$debut_tmp=$debut;
		while($debut_tmp<=$fin && $donnees['cle']!=$cle)
		{
			if($debut_tmp>=strtotime($donnees['date_debut']) && $debut_tmp<=strtotime($donnees['date_fin']))
				return true;
			$debut_tmp=$debut_tmp+60*60*24;
		}
	}
	return false;
}
?>