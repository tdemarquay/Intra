<?php


include('connexion.php');
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
function get_doc_type($type,$date)
{
	include("../php/connexion.php");
	
	$reponse = $bdd->query("SELECT * FROM gestion_docs_types WHERE type='".$type."'" );

	while ($donnees = $reponse->fetch())
	{	
		if(date_sql_to_timestamp3($date)>=date_sql_to_timestamp3($donnees['date_debut']) && date_sql_to_timestamp3($date)<=date_sql_to_timestamp3($donnees['date_fin']))
		{
			return "docs/".$donnees['date_debut'].".".$donnees['format'];
		}
	}
	echo "Erreur, aucune doc dispo à cette date...";
	//mail('thibaultdemarquay@gmail.com', '[JEECE] Erreur de génération', "Le paramètre ".$type." n'a pas pu être trouvé pour la date du ".$date);
	return 0;
}

function date_traitee_to_date_sql3($post)
{
	return date("Y-m-d",date_traitee_to_timestamp3($post));
}

function date_traitee_to_timestamp3($post)
{
	$post=traiter_date_parametre2($post);
	return mktime(0, 0, 0, intval($post[3].$post[4]), intval($post[0].$post[1]), intval($post[6].$post[7].$post[8].$post[9]));
}

function date_sql_to_timestamp3($post)
{
	return mktime(0, 0, 0, intval($post[5].$post[6]), intval($post[8].$post[9]), intval($post[0].$post[1].$post[2].$post[3]));
}

function traiter_date_parametre3($date)
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

	
?>