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

//Récupérer et traiter toutes les données de formulaire reçues
$refetude=traiter_variable("refetude");
$numero_pl = traiter_variable("numero_pl");
$date_pl=traiter_date("date_pl");
$nom_cdp =traiter_variable("nom_cdp");
$tel_cdp =traiter_tel("tel_cdp");
$mail_cdp =traiter_variable("mail_cdp");
$societe_particulier=traiter_variable("societe_particulier");
$nom_societe=traiter_variable("nom_societe");
$adresse_client =traiter_variable("adresse_client");
$cp_client =traiter_variable("cp_client");
$ville_client =traiter_variable("ville_client");
$nom_contact =traiter_variable("nom_contact");
$mail_contact =traiter_variable("mail_contact");
$tel_contact =traiter_tel("tel_contact");
$qualite_contact =traiter_variable("qualite_contact");
$nom_logiciel =traiter_variable("nom_logiciel");
$numero_licence =traiter_variable("numero_licence");
$date_fin_pl=traiter_date("date_fin_pl");

//On récupère l'adresse complète
$adresse_client= $adresse_client."\r\n".$cp_client.' '.$ville_client;

//On rajoute un 0 devant le numéro de prêt de licence s'il n'y a qu'un seul chiffre
if($numero_pl=="") $numero_pl="01";
else if($numero_pl<10 && $numero_pl[0]!=0 && $numero_pl!="")
$numero_pl="0".$numero_pl;


//On enlève "pour la société" si c'est un particulier
if($societe_particulier=="societe")
{
	$nom_societe=strtoupper($nom_societe);
	$si_societe="la société ";
	$nom_contact2=$nom_contact;
}
else
{
	$si_societe="";
	$qualite_contact="";
	$nom_contact=$nom_societe;
	$nom_contact2="";
}

$president = get_parametre("president",date_traitee_to_date_sql($date_pl));

// -----------------
// Load the template
// -----------------

$template = get_doc_type("pl",date_traitee_to_date_sql($date_pl));
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
//$TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
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
$output_file_name = $refetude."-PL".$numero_pl.".docx";
// Output the result as a downloadable file (only streaming, no data saved in the server)
$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
exit();

