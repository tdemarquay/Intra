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

// Retrieve the user name to display

//Récupérer et traiter toutes les données de formulaire reçues
$refetude=traiter_variable("refetude");
$date_ap=traiter_date("date_ap");
$societe_particulier = traiter_variable("societe_particulier");
$nom_societe = traiter_variable("nom_societe");
$adresse_client = traiter_variable("adresse_client");
$cp_client = traiter_variable("cp_client");
$ville_client = traiter_variable("ville_client");
$nom_contact = traiter_variable("nom_contact");
$mail_contact = traiter_variable("mail_contact");
$tel_contact = traiter_tel("tel_contact");
$qualite_contact = traiter_variable("qualite_contact");
$droit_communication = traiter_variable("droit_communication");
$presentation_societe = traiter_variable("presentation_societe");
$contexte_enjeux = traiter_variable("contexte_enjeux");
$delai_etude = traiter_variable("delai_etude");
$jour_semaine = traiter_variable("jour_semaine");
$charge_quali = traiter_variable("nom_cq");


//Gestion fin validité de l'AP
//On doit retourner en timestamp
$date_timestamp=mktime(0, 0, 0, $date_ap[3].$date_ap[4], $date_ap[0].$date_ap[1],  $date_ap[6].$date_ap[7].$date_ap[8].$date_ap[9]);
$validite_ap = date("d/m/Y",$date_timestamp+24*60*60*30*3);

//Gestion "pour la société" entre société et particulier
if($societe_particulier=="societe")
{
	$si_societe="La société ";
	$si_societe2="la société ";
	$nom_societe=strtoupper($nom_societe);
}
else
{
	$si_societe="";
	$si_societe2="";
}

//On récupère l'adresse complète
$adresse_societe= $adresse_client."\r\n".$cp_client.' '.$ville_client;

//Gestion jour/semaine et pluriel
if($jour_semaine=="1")
{
	$duree_etude = $delai_etude." jour";
	$jour_ou_semaine = "jour";
}
elseif ($jour_semaine=="2")
{
	$duree_etude = $delai_etude." semaine";
	$jour_ou_semaine = "semaine";
}
if($delai_etude>1)
{
	$duree_etude = $duree_etude."s";
	$jour_ou_semaine = $jour_ou_semaine."s";
}

//Gestion droit communication
if($droit_communication=="1")
$droit_communication1 = "et le domaine de l’étude réalisée pour ladite société ainsi que donner un lien vers le rendu final des travaux réalisés sur ses supports de communication, à titre d’exemple de compétences. ";
else
$droit_communication1="ainsi que les travaux réalisés pour ladite société et ce à titre d'exemple de compétence.";

$president = get_parametre("president",date_traitee_to_date_sql($date_ap));
$tresorier = get_parametre("tresorier",date_traitee_to_date_sql($date_ap));

// -----------------
// Load the template
// -----------------

$template = get_doc_type("ap",date_traitee_to_date_sql($date_ap));
$TBS->LoadTemplate($template, OPENTBS_ALREADY_UTF8); // Also merge some [onload] automatic fields (depends of the type of document).

// ----------------------
// Debug mode of the demo
// ----------------------
//$TBS->Plugin(OPENTBS_DEBUG_XML_CURRENT, true); // Display the intented XML of the current sub-file, and exit.
//$TBS->Plugin(OPENTBS_DEBUG_INFO, true); // Display information about the document, and exit.
//$TBS->Plugin(OPENTBS_DEBUG_XML_SHOW); // Tells TBS to display information when the document is merged. No exit.

// --------------------------------------------
// Merging and other operations on the template
// --------------------------------------------

// Delete comments
$TBS->PlugIn(OPENTBS_DELETE_COMMENTS);

// -----------------
// Output the result
// -----------------

// Define the name of the output file
$output_file_name = $refetude."-AP.docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
