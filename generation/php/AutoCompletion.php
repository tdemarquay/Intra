<?php

if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
require_once('./AutoCompletionCPVille.class.php');
include('connexion.php');

//Initialisation de la liste
$list = array();

//Connexion MySQL

//Construction de la requete
$strQuery = "SELECT CP CodePostal, VILLE Ville FROM cp_autocomplete WHERE ";
if (isset($_POST["codePostal"]))
{
    $strQuery .= "CP LIKE :codePostal ";
}
else
{
    $strQuery .= "VILLE LIKE :ville ";
}
$strQuery .= "AND CODEPAYS = 'FR' ";
//Limite
if (isset($_POST["maxRows"]))
{
    $strQuery .= "LIMIT 0, :maxRows";
}
$query = $bdd->prepare($strQuery);
if (isset($_POST["codePostal"]))
{
    $value = $_POST["codePostal"]."%";
    $query->bindParam(":codePostal", $value, PDO::PARAM_STR);
}
else
{
    $value = $_POST["ville"]."%";
    $query->bindParam(":ville", $value, PDO::PARAM_STR);
}
//Limite
if (isset($_POST["maxRows"]))
{
    $valueRows = intval($_POST["maxRows"]);
    $query->bindParam(":maxRows", $valueRows, PDO::PARAM_INT);
}

$query->execute();

$list = $query->fetchAll(PDO::FETCH_CLASS, "AutoCompletionCPVille");;

echo json_encode($list);
?>