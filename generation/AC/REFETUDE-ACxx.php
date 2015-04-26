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

// prevent from a PHP configuration problem when using mktime() and date()
if (version_compare(PHP_VERSION,'5.1.0')>=0) {
	if (ini_get('date.timezone')=='') {
		date_default_timezone_set('UTC');
	}
	
}

// Initalize the TBS instance
$TBS = new clsTinyButStrong; // new instance of TBS
$TBS->Plugin(TBS_INSTALL, OPENTBS_PLUGIN); // load the OpenTBS plugin

// ------------------------------
// Prepare some data for the demo
// ------------------------------

//Récupérer et traiter toutes les données de formulaire reçues
$refetude=traiter_variable("refetude");
$numero_ac=traiter_variable("numero_ac");
$date_cc=traiter_date("date_cc");
$date_ac=traiter_date("date_ac");
$societe_particulier=traiter_variable("societe_particulier");
$nom_societe=traiter_variable("nom_societe");
$adresse_client =traiter_variable("adresse_client");
$cp_client =traiter_variable("cp_client");
$ville_client =traiter_variable("ville_client");
$nom_contact =traiter_variable("nom_contact");
$mail_contact =traiter_variable("mail_contact");
$tel_contact =traiter_variable("tel_contact");
$qualite_contact =traiter_variable("qualite_contact");
$nom_cdp =traiter_variable("nom_cdp");
$mail_cdp = traiter_variable("mail_cdp");
$tel_cdp =traiter_variable("tel_cdp");
$objet_avenant = traiter_variable("objet_avenant");
$modification_delai = traiter_variable("modification_delai");
$date_fin_theorique_ac = traiter_date("date_fin_theorique_ac");
$modification_budget = traiter_variable("modification_budget");
$ht_ac = traiter_variable("ht_ac");
$nombre_jeh_ac = traiter_variable("nombre_jeh_ac");
$numero_devis_ac = traiter_variable("numero_devis_ac");

//On récupère l'adresse complète
$adresse_client= $adresse_client."\r\n".$cp_client.' '.$ville_client;

//On rajoute un 0 devant le numéro de l'avenant client s'il n'y a qu'un seul chiffre
if($numero_ac=="") $numero_ac="01";
else if($numero_ac<10 && $numero_ac[0]!=0 && $numero_ac!="")
$numero_ac="0".$numero_ac;

//Gestion du Particulier/Société
$adresse_societe_particulier = "Siège sociale de la société";
$nom_contact_existe = "Nom du contact :";
$entre="la société ".$nom_societe.", représentée par ".$nom_contact.", ";
$la_societe = "la société ";
if(isset($_POST['societe_particulier']) && $_POST['societe_particulier']=="particulier")
{
	$la_societe="";
	$nom_contact =$nom_societe;
	$adresse_societe_particulier="Adresse";
	$nom_contact_existe = "";
	$entre=$nom_societe." ";
	$qualite_contact = "";
}
else $nom_societe=strtoupper($nom_societe);
	
//Chiffres->lettres
$ht_ac_lettre=chiffre_lettre($ht_ac);

//Traiter les montants
$ht_ac = traiter_montant($ht_ac); 

//On rajoute un 0 devant le numéro de devis s'il n'y a qu'un seul chiffre
if($numero_devis_ac=="") $numero_devis_ac="01";
else if($numero_devis_ac<10 && $numero_devis_ac[0]!=0 && $numero_devis_ac!="")
$numero_devis_ac="0".$numero_devis_ac;
	
//Gestion Alinéa
$alinea_budget = "";
$alinea_budget2 = "";
$alinea_delai = "";
$alinea_delai2 = "";
if($modification_delai == "1")
{
	$alinea_delai = "\rAlinéa 1 : Délais de réalisation\r\r";
	$alinea_delai2 = "En conséquence le délai de réalisation de l’étude mentionné à l’article IV de la Convention Client ".$refetude."-CC est prolongé jusqu’au ".$date_fin_theorique_ac.".";
}
if($modification_budget == "1")
{
	if($modification_delai == "1")
	$alinea_budget = "\rAlinéa 2 : Prix\r";
	else
	$alinea_budget = "Alinéa 1 : Prix\r";
	
	$alinea_budget2 = "Le prix de l’étude mentionné à l’article V de la Convention Client se trouve donc modifié, d’un commun accord avec les deux parties ; le prix est fixé à un montant de ".$ht_ac." € HT (".$ht_ac_lettre.") correspondant à ".$nombre_jeh_ac." Jours-Etude homme conformément à la législation applicable aux Junior-Entreprises. La nouvelle tarification est détaillée dans le devis joint à ce document (réf. : ".$refetude."-D".$numero_devis_ac.").\r";
}

//Gestion avenant précédent
if($numero_ac>1)
{
	if($numero_ac=="") $numero_ac="01";
	else if(intval($numero_ac)<11)
		$numero_avenant_precedent="0".(intval($numero_ac)-1);
	else $numero_avenant_precedent=intval($numero_ac)-1;
		$avenant_precedent="Cet avenant annule et remplace le précédent Avenant ".$refetude."-AC".$numero_avenant_precedent.".";
}
else
	$avenant_precedent="Cet Avenant vient donc modifier la Convention Client ".$refetude."-CC et l’Avant-projet  ".$refetude."-AP qui y sont annexés.";
	
	$president = get_parametre("president",date_traitee_to_date_sql($date_ac));

// -----------------
// Load the template
// -----------------

$template = $template = get_doc_type("ac",date_traitee_to_date_sql($date_ac));
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
$output_file_name = $refetude."-AC".$numero_ac.".docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
