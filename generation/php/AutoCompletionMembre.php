<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
require_once('./AutoCompletionMembreClass.php');
include('connexion.php');

/*//Initialisation de la liste
$list = array();

//Connexion MySQL

//Construction de la requete
$strQuery = "SELECT * FROM rh WHERE ";
if (isset($_POST["nom"]))
{
    $strQuery .= "nom LIKE :nom ";
}


//Limite
if (isset($_POST["maxRows"]))
{
    $strQuery .= "LIMIT 0, :maxRows";
}
$query = $bdd->prepare($strQuery);
if (isset($_POST["nom"]))
{
    $value = $_POST["nom"]."%";
    $query->bindParam(":nom", $value, PDO::PARAM_STR);
}
//Limite
if (isset($_POST["maxRows"]))
{
    $valueRows = intval($_POST["maxRows"]);
    $query->bindParam(":maxRows", $valueRows, PDO::PARAM_INT);
}

$query->execute();

$list = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionMembreClass");;

echo json_encode($list);*/
if(isset($_GET['nom']))
{
	$reponse = $bdd->query("SELECT * FROM rh WHERE nom LIKE '%".$_GET['nom']."%'");
	$return_arr = array();
		// On affiche chaque entrée une à une
		while ($donnees = $reponse->fetch())
		{
			$tab['nom']=$donnees['nom'];
			$tab['prenom']=$donnees['prenom'];
			$tab['adresse']=$donnees['adresse'];
			$tab['cp']=$donnees['cp'];
			if($donnees['email_jeece']=="")
			$tab['mail']=$donnees['email'];
			else
			$tab['mail']=$donnees['email_jeece'];
			$tab['tel']=$donnees['tel'];
			$tab['ville']=$donnees['ville'];
			$tab['date_ce']=$donnees['date_ce'];
			$tab['ref_ce']=$donnees['ref_ce'];
			$tab['promo']=$donnees['promotion'];
			array_push($return_arr,$tab);
			
		}
		
		echo json_encode($return_arr);
}
?>