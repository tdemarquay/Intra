<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");

// Include classes
include_once('../php/tbs_class.php'); // Load the TinyButStrong template engine
include_once('../php/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
include("../php/traitement.php");
include("../php/get_doc_type.php");

// Initalize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin


// ------------------------------
// Prepare some data for the demo
// ------------------------------

//Récupérer et traiter toutes les données de formulaire reçues
$refetude=traiter_variable("refetude");
$date_sat_int=traiter_date("date_sat_int");
$date_fin_mission=traiter_date("date_fin_mission");
$nom_intervenant =traiter_variable("nom_intervenant");
$prenom_intervenant =traiter_variable("prenom_intervenant");
$adresse_intervenant =traiter_variable("adresse_intervenant");
$cp_intervenant =traiter_variable("cp_intervenant");
$ville_intervenant =traiter_variable("ville_intervenant");
$ref_ce_intervenant =traiter_variable("ref_ce_intervenant");
$promotion_intervenant =traiter_variable("promotion_intervenant");
$nom_cq =traiter_variable("nom_cq");
$nom_cdp =traiter_variable("nom_cdp");


//On récupère l'adresse complète
$adresse_intervenant= $adresse_intervenant."\r\n".$cp_intervenant.' '.$ville_intervenant;

//Récupérer NOMPRE
if($nom_intervenant !="" && $prenom_intervenant!="")
{
	if(strlen($prenom_intervenant)==1)
		$prenom=$prenom_intervenant[0];
		else if(strlen($prenom_intervenant)==2)
		$prenom=$prenom_intervenant[0].$prenom_intervenant[1];
		else
		$prenom=$prenom_intervenant[0].$prenom_intervenant[1].$prenom_intervenant[2];
		
			if(strlen($nom_intervenant)==1)
		$nom=$nom_intervenant[0];
		else if(strlen($nom_intervenant)==2)
		$nom=$nom_intervenant[0].$nom_intervenant[1];
		else
		$nom=$nom_intervenant[0].$nom_intervenant[1].$nom_intervenant[2];
		
	$nompre=strtoupper($prenom.$nom);
}
else
	$nompre="NOMPRE";

// -----------------
// Load the template
// -----------------

$template = get_doc_type("sat_int",date_traitee_to_date_sql($date_sat_int));
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
// $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
// $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
   // $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

// Delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

// -----------------
// Output the result
// -----------------

// Define the name of the output file
$output_file_name = $refetude."-".$nompre."-SAT_INT.docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
