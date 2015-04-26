<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");

// Include classes
include_once('../php/tbs_class.php'); // Load the TinyButStrong template engine
include_once('../php/tbs_plugin_opentbs.php'); // Load the OpenTBS plugin
include('../php/tbs_plugin_excel.php');
include("../php/traitement.php");
include("../php/get_parametre.php");
include("../php/get_doc_type.php");

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
	if (ini_get('date.timezone')=='') {
		date_default_timezone_set('UTC');
	}
	
}

// Initalize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin
$TBS->Plugin(TBS_INSTALL, TBS_EXCEL); // load the OpenTBS plugin


// ------------------------------
// Prepare some data for the demo
// ------------------------------

//Récupérer et traiter toutes les données de formulaire reçues
$refetude=traiter_variable("refetude");
$date_d=traiter_date("date_d");
$societe_particulier=traiter_variable("societe_particulier");
$nom_societe=traiter_variable("nom_societe");
$adresse_client =traiter_variable("adresse_client");
$cp_client =traiter_variable("cp_client");
$mail_cdp =traiter_variable("mail_cdp");
$mail_client =traiter_variable("mail_contact");
$nom_contact =traiter_variable("nom_contact");
$nom_cdp =traiter_variable("nom_cdp");
$numero_d = traiter_variable("numero_d");
$tel_cdp =traiter_tel("tel_cdp");

//On rajoute un 0 devant le numéro de prêt de licence s'il n'y a qu'un seul chiffre
if($numero_d=="") $numero_d="01";
else if($numero_d<10 && $numero_d[0]!=0 && $numero_d!="")
$numero_d="0".$numero_d;

if($societe_particulier=="particulier")
{
	$nom_societe2=$nom_societe;
	$client2="";
	$contact = "";
}
else
{
	$nom_societe2=$nom_societe;
	$client2=$nom_contact;
	$contact = "Contact :";
}

$date_validite = date("d/m/Y", mktime(0, 0, 0, $date_d[3].$date_d[4], $date_d[0].$date_d[1], $date_d[6].$date_d[7].$date_d[8].$date_d[9])+7*24*60*60);

//Traitement paiement final
$frais=get_parametre("frais_structure",date_traitee_to_date_sql($date_d));
$tva=get_parametre("tva",date_traitee_to_date_sql($date_d));

$total_frais = "=SI(H40<>0;(MAX(ARRONDI.SUP(".$frais."*H40;-1);20));0)";

// -----------------
// Load the template
// -----------------

$template = get_doc_type("d",date_traitee_to_date_sql($date_d));
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
//if (isset($_POST['debug']) && ($_POST['debug']=='current')) $TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
// $TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
//if (isset($_POST['debug']) && ($_POST['debug']=='show'))    $TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

// Delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);
$TBS->PlugIn(OPENTBS_SELECT_SHEET, "Paramètres");

// -----------------
// Output the result
// -----------------

// Define the name of the output file
$output_file_name = $refetude."-D".$numero_d.".".pathinfo($template, PATHINFO_EXTENSION);
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
