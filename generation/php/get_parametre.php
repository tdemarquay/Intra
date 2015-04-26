<?php

if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
include('connexion.php');
function get_parametre($type,$date)
{
	include("../php/connexion.php");
	
	$reponse = $bdd->query("SELECT * FROM parametre_doc_type " );

	while ($donnees = $reponse->fetch())
	{	
		if(date_sql_to_timestamp2($date)>=date_sql_to_timestamp2($donnees['date_debut']) && date_sql_to_timestamp2($date)<=date_sql_to_timestamp2($donnees['date_fin']))
		{
			if($type=="tva" ||$type=="frais_structure" ||$type=="phase_analyse" ||$type=="taux_renumeration_rm"||$type=="taux_acompte" )
			{  return $donnees[$type]/100;}
			else
			return $donnees[$type];
		}
	}
	echo "Erreur, aucune paramètre dispo à cette date...";
	//mail('thibaultdemarquay@gmail.com', '[JEECE] Erreur de génération', "Le paramètre ".$type." n'a pas pu être trouvé pour la date du ".$date);
	return 0;
}

function date_traitee_to_date_sql2($post)
{
	return date("Y-m-d",date_traitee_to_timestamp2($post));
}

function date_traitee_to_timestamp2($post)
{
	$post=traiter_date_parametre2($post);
	return mktime(0, 0, 0, intval($post[3].$post[4]), intval($post[0].$post[1]), intval($post[6].$post[7].$post[8].$post[9]));
}

function date_sql_to_timestamp2($post)
{
	return mktime(0, 0, 0, intval($post[5].$post[6]), intval($post[8].$post[9]), intval($post[0].$post[1].$post[2].$post[3]));
}

function traiter_date_parametre2($date)
{
	$date = trim(''.$date);
	if($date=="0/0" OR $date=="")
	{
		$date="00/00/0000";
	}
	else
	{
		if (!is_numeric($date[1]))
		{	
			$date='0'.$date;
		}
		if (!is_numeric($date[4]))
		{
			$day=$date[0].$date[1];
			$date=$day.'/0'.$date[3].$date[4].$date[5].$date[6].$date[7].$date[8];
		}
		$date = trim(''.$date);
	}
	return $date;
}
// echo $_GET['date'];
// echo str_replace("%2F","/",$_GET['date']);
if(isset($_GET['date']) && isset ($_GET['type']))
	echo json_encode(get_parametre($_GET['type'],$_GET['date']));
	
?>