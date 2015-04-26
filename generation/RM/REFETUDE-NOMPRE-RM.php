<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");

// Include classes
include_once('../php/tbs_class.php'); // Load the TinyButStrong template engine
include_once('../php/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
include("../php/traitement.php");
include("../php/get_parametre.php");

include("../php/get_doc_type.php");

// Initalize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------
// Prepare some data for the demo
// ------------------------------

//Récupérer et traiter toutes les données de formulaire reçues
$refetude=traiter_variable("refetude");
$cdp_intervenant=traiter_variable("cdp_intervenant");
$date_rmcdp=traiter_date("date_rm");
$nom_societe=traiter_variable("nom_societe");
$nom_etudiant =traiter_variable("nom_etudiant");
$prenom_etudiant =traiter_variable("prenom_etudiant");
$adresse_etudiant =traiter_variable("adresse_etudiant");
$cp_etudiant =traiter_variable("cp_etudiant");
$ville_etudiant =traiter_variable("ville_etudiant");
$mail_etudiant = traiter_variable("mail_etudiant");
$tel_etudiant =traiter_tel("tel_etudiant");
$ref_ce_etudiant = traiter_variable("ref_ce_etudiant");
$description_etude_en = traiter_variable("description_etude_en");
$date_fin_theorique_etude = traiter_date("date_fin_theorique_etude");
$nombre_jeh_cdp = traiter_variable("nombre_jeh_cdp");
$renumeration_brute_cdp = traiter_variable("renumeration_brute_cdp");

//On récupère l'adresse complète
$adresse_etudiant= $adresse_etudiant."\r\n".$cp_etudiant.' '.$ville_etudiant;

//Maj nom cdp
$nom_etudiant=strtoupper($nom_etudiant);

//Récupérer NOMPRE
if($nom_etudiant !="" && $prenom_etudiant!="")
{
	if(strlen($prenom_etudiant)==1)
		$prenom=$prenom_etudiant[0];
		else if(strlen($prenom_etudiant)==2)
		$prenom=$prenom_etudiant[0].$prenom_etudiant[1];
		else
		$prenom=$prenom_etudiant[0].$prenom_etudiant[1].$prenom_etudiant[2];
		
			if(strlen($nom_etudiant)==1)
		$nom=$nom_etudiant[0];
		else if(strlen($nom_etudiant)==2)
		$nom=$nom_etudiant[0].$nom_etudiant[1];
		else
		$nom=$nom_etudiant[0].$nom_etudiant[1].$nom_etudiant[2];
		
	$nompre=strtoupper($prenom.$nom);
}
else
	$nompre="NOMPRE";

//Gestion des montants
//Chiffres->lettres
$renumeration_brute_cdp_lettre=chiffre_lettre($renumeration_brute_cdp);

//Traiter les montants
$renumeration_brute_cdp = traiter_montant($renumeration_brute_cdp); 

//Pluriel JEH
if($nombre_jeh_cdp<2)
	$nombre_jeh_cdp = $nombre_jeh_cdp." Jour-Etude Homme";
else
	$nombre_jeh_cdp = $nombre_jeh_cdp." Jours-Etude Homme";

//Gestion Cdp/Intervenant
if($cdp_intervenant=="cdp")
{
	$cdp_intervenant = "CHEF DE PROJET";
	$cdp_intervenant2="CDP";
}
else
{
	$cdp_intervenant = "INTERVENANT";
	$cdp_intervenant2="I";
}
$president = get_parametre("president",date_traitee_to_date_sql($date_rmcdp));
// -----------------
// Load the template
// -----------------

$template = get_doc_type("rm",date_traitee_to_date_sql($date_rmcdp));
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
if($cdp_intervenant=="cdp")
$output_file_name = $refetude."-".$nompre."-RMCDP.docx";
else
$output_file_name = $refetude."-".$nompre."-RMI.docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
