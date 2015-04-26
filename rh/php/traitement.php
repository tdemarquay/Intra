<?php


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
	if($post!=="")
	return date("Y-m-d",date_traitee_to_timestamp($post));
	else return "";
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


?>