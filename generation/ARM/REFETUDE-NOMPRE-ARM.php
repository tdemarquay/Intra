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
$numero_arm=traiter_variable("numero_arm");
$cdp_intervenant=traiter_variable("cdp_intervenant");
$date_arm=traiter_date("date_arm");
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
$definition_mission_arm =traiter_variable("definition_mission_arm");
$description_phase_arm =traiter_variable("description_phase_arm");
$delai_mission_arm =traiter_variable("delai_mission_arm");
$nouvelle_date_fin =traiter_date("nouvelle_date_fin");
$indemnisation_arm =traiter_variable("indemnisation_arm");
$nouvelle_indemnisation_arm =traiter_variable("nouvelle_indemnisation_arm");
$jeh_arm =traiter_variable("jeh_arm");

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

//Reference RM
$ref_rm_etudiant = $refetude."-".$nompre."-RM".$cdp_intervenant2;

//Gestion avenant
$nombre_alinea = 0;
if($definition_mission_arm=="1")
{
	$nombre_alinea++;
	if($delai_mission_arm!="1" && $indemnisation_arm!="1") $alinea_definition="\n\n\nAlinéa I : DEFINITION DE LA MISSION";
	else $alinea_definition="\nAlinéa I : DEFINITION DE LA MISSION";
	if($indemnisation_arm=="1" && $delai_mission_arm!="1")$modification_definition="Conformément à l’Avant-Projet ".$refetude."-AP, la mission consiste en ".$description_etude_en.". L'étudiant s'engage à respecter les termes de la Convention Client ".$refetude."-CC et du cahier des charges associé, liant la Junior-Entreprise et le client, dont il déclare avoir pris connaissance. En particulier, il s’engage à réaliser ".$description_phase_arm.".";
	else $modification_definition="Conformément à l’Avant-Projet ".$refetude."-AP, la mission consiste en ".$description_etude_en.". L'étudiant s'engage à respecter les termes de la Convention Client ".$refetude."-CC et du cahier des charges associé, liant la Junior-Entreprise et le client, dont il déclare avoir pris connaissance. En particulier, il s’engage à réaliser ".$description_phase_arm.".\n";
	$article1_remplace="\nL’article I du Récapitulatif de Mission est annulé et remplacé par :";
}
else
{
	$alinea_definition="";
	$modification_definition="";
	$article1_remplace="";
}

if($delai_mission_arm=="1")
{
	$nombre_alinea++;
	if($nombre_alinea==1) $alinea_delai="Alinéa I : DELAIS DE REALISATION ";
	else $alinea_delai="Alinéa II : DELAIS DE REALISATION ";
	$modification_delai=$prenom_etudiant." ".$nom_etudiant;
	if($definition_mission_arm!="1" || $indemnisation_arm=="1")$modification_delai2=" s’engage à respecter les délais de réalisation de l’étude qui prendra fin le ".$nouvelle_date_fin." sauf cas de force majeure ou cause imputable au client.\n";
	else $modification_delai2=" s’engage à respecter les délais de réalisation de l’étude qui prendra fin le ".$nouvelle_date_fin." sauf cas de force majeure ou cause imputable au client.";
	$article2_remplace="\nL’article II du Récapitulatif de Mission est annulé et remplacé par :";
}
else
{
	$article2_remplace="";
	$alinea_delai="";
	$modification_delai="";
	$modification_delai2="";
}

if($indemnisation_arm=="1")
{
	$nombre_alinea++;
	if($nombre_alinea==1) $alinea_indemnisation="Alinéa I : INDEMNISATION ";
	elseif($nombre_alinea==2) $alinea_indemnisation="Alinéa II : INDEMNISATION ";
	else $alinea_indemnisation="Alinéa III : INDEMNISATION ";
	if($jeh_arm>1)
	$modification_indemnisation="JEECE reversera une indemnisation de ".traiter_montant($nouvelle_indemnisation_arm)." € bruts (".chiffre_lettre($nouvelle_indemnisation_arm)." bruts) sur la base de ".$jeh_arm." Jours-Etude Homme conformément à la mission de l’étudiant. Cette indemnisation est, toutefois, subordonnée au paiement effectif de l'étude par le client et la validation du rapport pédagogique et technique par JEECE comme précisé dans l’article 7 du Récapitulatif de Mission.\n\n";
	else
	$modification_indemnisation="JEECE reversera une indemnisation de ".traiter_montant($nouvelle_indemnisation_arm)." € bruts (".chiffre_lettre($nouvelle_indemnisation_arm)." bruts) sur la base de ".$jeh_arm." Jour-Etude Homme conformément à la mission de l’étudiant. Cette indemnisation est, toutefois, subordonnée au paiement effectif de l'étude par le client et la validation du rapport pédagogique et technique par JEECE comme précisé dans l’article 7 du Récapitulatif de Mission.\n\n";
	
	if($nombre_alinea==1)  $modification_indemnisation=$modification_indemnisation."\n\n";
	if($delai_mission_arm=="1" && $nombre_alinea==2)  $modification_indemnisation=$modification_indemnisation."\n";
	$article3_remplace="\nL’article III du Récapitulatif de Mission est annulé et remplacé par :";
}
else
{
	$article3_remplace="";
	$alinea_indemnisation="";
	$modification_indemnisation="";
	$modification_indemnisation2="";
}

//Si un seul alinéa
if($nombre_alinea==1)
$alinea_remplace="L'alinéa suivant vient modifier le Récapitulatif de mission ".$ref_rm_etudiant." :";
else
$alinea_remplace="Les alinéas suivant viennent modifier le Récapitulatif de mission ".$ref_rm_etudiant." :";

//Gestion avenant précédent
if($numero_arm>1)
{
	if($numero_arm=="") $numero_arm="01";
	else if(intval($numero_arm)<11)
		$numero_avenant_precedent_rm="0".($numero_arm-1);
	else $numero_avenant_precedent_rm=$numero_arm-1;
		$avenant_precedent="Cet avenant annule et remplace le précédent Avenant ".$refetude."-ARM".$cdp_intervenant2.$numero_avenant_precedent_rm.".";
}
else
	$avenant_precedent="Cet Avenant vient donc modifier le récapitulatif de mission étudiant ".$ref_rm_etudiant.".";

//On rajoute un 0 devant le numéro de l'avenant  s'il n'y a qu'un seul chiffre
if($numero_arm=="") $numero_arm="01";
else if($numero_arm<10 && $numero_arm[0]!=0 && $numero_arm!="")
$numero_arm="0".$numero_arm;

$president = get_parametre("president",date_traitee_to_date_sql($date_arm));

// -----------------
// Load the template
// -----------------

$template = get_doc_type("arm",date_traitee_to_date_sql($date_arm));
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

// -----------------
// Output the result
// -----------------

// Define the name of the output file

$output_file_name = $refetude."-".$nompre."-ARM".$cdp_intervenant2.$numero_arm.".docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
