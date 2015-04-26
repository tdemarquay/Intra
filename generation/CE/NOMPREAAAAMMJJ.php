<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");

if(isset($_GET['ce']))
{
	$id=$_GET['ce'];
	
// Include classes
include_once('../php/tbs_class.php'); // Load the TinyButStrong template engine
include_once('../php/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
include("../php/connexion.php");
include("../php/traitement.php");
include("../php/get_parametre.php");

include("../php/get_doc_type.php");

// Initalize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------
// Prepare some data for the demo
// ------------------------------


$reponse = $bdd->query("SELECT * FROM rh WHERE id=".$id);
	$donnees = $reponse->fetch();
$erreur="";

if($donnees['adresse']=="" || $donnees['cp']=="" || $donnees['ville']=="")
{
	$erreur = $erreur."\n Il manque l'adresse, la ville ou le Code Postal";
}
if($donnees['ref_ce']=="")
{
	$erreur = $erreur."\n Il manque la référence CE";
}
if($donnees['date_ce']==""  || $donnees['date_ce']=="0000-00-00")
{
	$erreur = $erreur."\n Il manque la date de la CE";
}
//Récupérer et traiter toutes les données de formulaire reçues

if($erreur=="")
{

//On récupère l'adresse complète
$adresse_etudiant= stripslashes($donnees['adresse'])."\r\n".$donnees['cp'].' '.stripslashes($donnees['ville']);
$mail=$donnees['email'];
$tel=$donnees['tel'];
$tel=wordwrap($tel,2," ",1);
$prenom=$donnees['prenom'];
$nom=$donnees['nom'];
$ref_ce=$donnees['ref_ce'];

$date_ce = date("d/m/Y",date_sql_to_timestamp($donnees['date_ce']));

$president = get_parametre("president",date_traitee_to_date_sql($date_ce));
// -----------------
// Load the template
// -----------------

$template = get_doc_type("ce",date_traitee_to_date_sql($date_ce));
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
//if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
//$TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
//if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

// Delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

// -----------------
// Output the result
// -----------------

// Define the name of the output file

$output_file_name = $ref_ce.".docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
}
else {
echo $erreur; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php }
?>