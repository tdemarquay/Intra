<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");

// Include classes
include_once('../php/tbs_class.php'); // Load the TinyButStrong template engine
include_once('../php/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
include("../php/traitement.php");
include("../php/get_doc_type.php");
include("../php/get_parametre.php");

// Initalize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------
// Prepare some data for the demo
// ------------------------------

//Récupérer et traiter toutes les données de formulaire reçues
$refetude=traiter_variable("refetude");
$date_rt=traiter_date("date_rt");
$societe_particulier = traiter_variable("societe_particulier");
$nom_societe = traiter_variable("nom_societe");
$adresse_client = traiter_variable("adresse_client");
$cp_client = traiter_variable("cp_client");
$ville_client = traiter_variable("ville_client");
$nom_contact = traiter_variable("nom_contact");
$tel_contact = traiter_tel("tel_contact");
$mail_contact = traiter_variable("mail_contact");
$contexte_enjeux = traiter_variable("contexte_enjeux");
$nom_cq = traiter_variable("nom_cq");

//On récupère l'adresse complète
$adresse_client= $adresse_client." ".$cp_client.' '.$ville_client;


//Gestion nom contact société
if($societe_particulier=="particulier")
{
	$nom_contact="";
	$nom_contact2="";
	$entreprise ="";
}
else
{
	$nom_contact2="Nom du contact :";
	$entreprise = "de l’entreprise ";
}
	
$president = get_parametre("president",date_traitee_to_date_sql($date_rt));
// -----------------
// Load the template
// -----------------

$template = get_doc_type("rt",date_traitee_to_date_sql($date_rt));
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
$output_file_name = $refetude."-RT.docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
