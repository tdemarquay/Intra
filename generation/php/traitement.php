<?php
include('chiffre_lettre.php');


function traiter_date($post)
{
	$date = (isset($_POST[$post])) ? $_POST[$post] : '';
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
		$_SESSION[$post] = $date;
	}
	return $date;
}

function traiter_date_parametre($date)
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

function date_traitee_to_date_sql($post)
{
	return date("Y-m-d",date_traitee_to_timestamp($post));
}

function date_traitee_to_timestamp($post)
{
	$post=traiter_date_parametre($post);
	return mktime(0, 0, 0, intval($post[3].$post[4]), intval($post[0].$post[1]), intval($post[6].$post[7].$post[8].$post[9]));
}

function date_sql_to_timestamp($post)
{
	return mktime(0, 0, 0, intval($post[5].$post[6]), intval($post[8].$post[9]), intval($post[0].$post[1].$post[2].$post[3]));
}

function traiter_variable($nom)
{
	$var = (isset($_POST[$nom])) ? $_POST[$nom] : '';
	//On vérifier que c'est pas un nombre
	if(gettype($var) == "string")
		$var = trim(''.$var);//Suppression des espaces inutiles
	$_SESSION[$nom] = $var;
	return $var;
}

function traiter_tel($nom)
{
	$var = (isset($_POST[$nom])) ? $_POST[$nom] : '';
	//On vérifier que c'est pas un nombre
	
	$_SESSION[$nom] = $var;
 
$var=wordwrap($var,2," ",1); 
 
	return $var;
}

function traiter_montant($nombre){
	//3 traitement : 
	//1 : Chiffres après la virgule
	//2 : "," au lieu de "."
	//3 : Séparateur Milliers centaines

	//2 chiffres après la virgule
	$nombre = sprintf("%.2f", ($nombre)); 

	//Séparateur Milliers centaines
	if($nombre>999 && $nombre <10000)
		$nombre=$nombre[0]." ".$nombre[1].$nombre[2].$nombre[3].$nombre[4].$nombre[5].$nombre[6];
	if($nombre>9999 && $nombre <100000)
		$nombre=$nombre[0].$nombre[1]." ".$nombre[2].$nombre[3].$nombre[4].$nombre[5].$nombre[6].$nombre[7];
	
	//Remplacer point par virgule
	$nombre=str_replace(".", ",", $nombre);
	
	return $nombre;
}

function chiffre_lettre($chiffre)
{
	$obj = new nuts($chiffre, "EUR");
	$lettre = $obj->convert("fr-FR");
	$lettre=str_replace(",", " et", $lettre);
	return $lettre;
}

?>