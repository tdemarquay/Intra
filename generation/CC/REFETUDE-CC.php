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
$date_cc=traiter_date("date_cc");
$societe_particulier=traiter_variable("societe_particulier");
$nom_societe=traiter_variable("nom_societe");
$adresse_client =traiter_variable("adresse_client");
$cp_client =traiter_variable("cp_client");
$ville_client =traiter_variable("ville_client");
$nom_contact =traiter_variable("nom_contact");
$mail_contact =traiter_variable("mail_contact");
$tel_contact =traiter_tel("tel_contact");
$qualite_contact =traiter_variable("qualite_contact");
$droit_communication =traiter_variable("droit_communication");
$nom_cdp =traiter_variable("nom_cdp");
$mail_cdp = traiter_variable("mail_cdp");
$tel_cdp =traiter_tel("tel_cdp");
$description_etude = traiter_variable("description_etude");
$delai_etude = traiter_variable("delai_etude");
$jour_semaine = traiter_variable("jour_semaine");
$nombre_jeh = traiter_variable("nombre_jeh_cc");
$ht_sans_frais = traiter_variable("ht_sans_frais_cc");
$ht_frais = traiter_variable("ht_frais_cc");
$presence_acompte = traiter_variable("presence_acompte");
$ht_acompte = traiter_variable("ht_acompte_cc");
$nombre_livrable_intermediaire = traiter_variable("nombre_livrable_intermediaire");
$ht_lot_1 = traiter_variable("ht_lot_1");
$jeh_lot_1 = traiter_variable("jeh_lot_1");
$ht_lot_2 = traiter_variable("ht_lot_2");
$jeh_lot_2 = traiter_variable("jeh_lot_2");
$ht_lot_3 = traiter_variable("ht_lot_3");
$jeh_lot_3 = traiter_variable("jeh_lot_3");
$ht_lot_4 = traiter_variable("ht_lot_4");
$jeh_lot_4 = traiter_variable("jeh_lot_4");

//On récupère l'adresse complète
$adresse_client= $adresse_client."\r\n".$cp_client.' '.$ville_client;

//Gestion fin théorique
//On doit retourner en timestamp
$date_timestamp=mktime(0, 0, 0, $date_cc[3].$date_cc[4], $date_cc[0].$date_cc[1],  $date_cc[6].$date_cc[7].$date_cc[8].$date_cc[9]);
$limite_reception_acompte = date("d/m/Y",$date_timestamp+24*60*60*30);
if($jour_semaine=="1")
	$date_timestamp=$date_timestamp+24*60*60*$delai_etude;
elseif ($jour_semaine=="2")
	$date_timestamp=$date_timestamp+24*60*60*7*$delai_etude;
$fin_theorique_etude=date("d/m/Y",$date_timestamp);
$_SESSION['date_fin_theorique_etude'] = $fin_theorique_etude;

//Gestion jour/semaine et pluriel
if($delai_etude>1) 
{
	if($jour_semaine=="1") $jour_semaine="jours";
	elseif($jour_semaine=="2") $jour_semaine="semaines";
}
else
{
	if($jour_semaine=="1") $jour_semaine="jour";
	elseif($jour_semaine=="2") $jour_semaine="semaine";
}

//Gestion du Particulier/Société
$adresse_societe_particulier = "Siège sociale de la société";
$nom_contact_existe = "Nom du contact :";
$pour_la = " la société ";
$nom_contact2 = "";
if(isset($_POST['societe_particulier']) && $_POST['societe_particulier']=="particulier")
{
	$nom_contact = "";
	$nom_contact2=$nom_societe;
	$adresse_societe_particulier="Adresse";
	$nom_contact_existe = "";
	$pour_la = "";
	$qualite_contact="";
}
else $nom_societe=strtoupper($nom_societe);


//Gestion des montants
//Calcul des TTC
$ttc_acompte=($ht_acompte)*(get_parametre("tva",date_traitee_to_date_sql($date_cc))+1);
$ttc=($ht_frais+$ht_sans_frais)*(get_parametre("tva",date_traitee_to_date_sql($date_cc))+1);
$ttc_lot_1=($ht_lot_1)*(get_parametre("tva",date_traitee_to_date_sql($date_cc))+1);
$ttc_lot_2=($ht_lot_2)*(get_parametre("tva",date_traitee_to_date_sql($date_cc))+1);
$ttc_lot_3=($ht_lot_3)*(get_parametre("tva",date_traitee_to_date_sql($date_cc))+1);
$ttc_lot_4=($ht_lot_4)*(get_parametre("tva",date_traitee_to_date_sql($date_cc))+1);



//Chiffres->lettres
$ht_acompte_lettre=chiffre_lettre($ht_acompte);
$ttc_acompte_lettre=chiffre_lettre($ttc_acompte);
$ht_sans_frais_lettre=chiffre_lettre($ht_sans_frais);
$frais_lettre=chiffre_lettre($ht_frais);
$ttc_lettre=chiffre_lettre($ttc);
$ht_lot_1_lettre=chiffre_lettre($ht_lot_1);
$ttc_lot_1_lettre=chiffre_lettre($ttc_lot_1);
$ht_lot_2_lettre=chiffre_lettre($ht_lot_2);
$ttc_lot_2_lettre=chiffre_lettre($ttc_lot_2);
$ht_lot_3_lettre=chiffre_lettre($ht_lot_3);
$ttc_lot_3_lettre=chiffre_lettre($ttc_lot_3);
$ht_lot_4_lettre=chiffre_lettre($ht_lot_4);
$ttc_lot_4_lettre=chiffre_lettre($ttc_lot_4);

//Calcul du paiement final
$ht_final = ($ht_frais+$ht_sans_frais);
if($presence_acompte=="1")
$ht_final=$ht_final-$ht_acompte;
if($nombre_livrable_intermediaire>0)
$ht_final = $ht_final-$ht_lot_1;
if($nombre_livrable_intermediaire>1)
$ht_final = $ht_final-$ht_lot_2;
if($nombre_livrable_intermediaire>2)
$ht_final = $ht_final-$ht_lot_3;
if($nombre_livrable_intermediaire>3)
$ht_final = $ht_final-$ht_lot_4;

//Traiter les montants
$ht_frais = traiter_montant($ht_frais); 
$ht_sans_frais = traiter_montant($ht_sans_frais); 
$ttc=traiter_montant($ttc);
$ht_acompte = traiter_montant($ht_acompte); 
$ttc_acompte= traiter_montant($ttc_acompte);
$ht_lot_1 = traiter_montant($ht_lot_1); 
$ttc_lot_1 = traiter_montant($ttc_lot_1); 
$ht_lot_2 = traiter_montant($ht_lot_2); 
$ttc_lot_2 = traiter_montant($ttc_lot_2); 
$ht_lot_3 = traiter_montant($ht_lot_3); 
$ttc_lot_3 = traiter_montant($ttc_lot_3); 
$ht_lot_4 = traiter_montant($ht_lot_4); 
$ttc_lot_4 = traiter_montant($ttc_lot_4); 

//Traitement paiement final
$ttc_final=($ht_final)*(get_parametre("tva",date_traitee_to_date_sql($date_cc))+1);
$ttc_final_lettre=chiffre_lettre($ttc_final);
$ht_final_lettre=chiffre_lettre($ht_final);
$ttc_final = traiter_montant($ttc_final); 
$ht_final = traiter_montant($ht_final); 

//Si acompte, traitement texte
if($presence_acompte=="1")
{
	$reception_acompte=" ou en cas de non réception de  l’acompte avant le $limite_reception_acompte.";
	$paiement_acompte1="\r\n 	- Un acompte de ";
	$paiement_acompte2="€ HT";
	$paiement_acompte3="(".$ht_acompte_lettre." hors taxes), soit, à titre indicatif et en application du taux de TVA actuel de 20,0%, ";
	$paiement_acompte4="€ TTC";
	$paiement_acompte5="(".$ttc_acompte_lettre." toutes taxes comprise).";

	
}
else
{
	$reception_acompte=".";
	$paiement_acompte1="";
	$paiement_acompte2="";
	$paiement_acompte3="";
	$paiement_acompte4="";
	$paiement_acompte5="";
	$ht_acompte="";
	$ttc_acompte="";
}


//Delai paiement traitement texte
$delai_reglement="";
$alone=1;
if($presence_acompte=="1")
{
	$alone=0;
	$delai_reglement= $delai_reglement."l’acompte au plus tard 15 jours après la signature de la présente Convention et réception de la facture, ";
}
if($nombre_livrable_intermediaire==1)
{
	$alone=0;
	$delai_reglement= $delai_reglement."le montant du solde intermédiaire au plus tard 15 jours après la signature du Procès-verbal de Recette Intermédiaire et réception de la facture, ";
}
if($nombre_livrable_intermediaire>1)
{
	$alone=0;
	$delai_reglement= $delai_reglement."le montant des soldes intermédiaires au plus tard 15 jours après la signature du Procès-verbal de Recette Intermédiaire et réception de la facture, ";
}
if($alone==1)
	$delai_reglement= $delai_reglement."le solde final des sommes dues au titre de l’étude au plus tard 1 mois après la date de signature du Procès-verbal de Recette Finale et réception de la facture.";
else
	$delai_reglement= $delai_reglement."et le solde final des sommes dues au titre de l’étude au plus tard 1 mois après la date de signature du Procès-verbal de Recette Finale et réception de la facture.";


//Livrable intermédiaire, traitement texte
if($nombre_livrable_intermediaire>0)
{
	$paiement_lot1_1="\r\n 	- Un solde intermédiaire de ";
	$paiement_lot1_2=" € HT";
	$paiement_lot1_3=" (".$ht_lot_1_lettre." hors taxes), correspondant à la réalisation de ".$jeh_lot_1." Jours-Étude Homme soit, à titre indicatif et en application du taux de TVA actuel de 20,0%, ";
	$paiement_lot1_4=" € TTC";
	$paiement_lot1_5=" (".$ttc_lot_1_lettre." toutes taxes comprise) suite à la signature du Procès-verbal de Recette Intermédiaire.";
}
else
{
	$paiement_lot1_1="";
	$paiement_lot1_2="";
	$paiement_lot1_3="";
	$paiement_lot1_4="";
	$paiement_lot1_5="";
	$ht_lot_1="";
	$ttc_lot_1="";
}

if($nombre_livrable_intermediaire>1)
{
	$paiement_lot2_1="\r\n 	- Un solde intermédiaire de ";
	$paiement_lot2_2=" € HT";
	$paiement_lot2_3=" (".$ht_lot_2_lettre." hors taxes), correspondant à la réalisation de ".$jeh_lot_2." Jours-Étude Homme soit, à titre indicatif et en application du taux de TVA actuel de 20,0%, ";
	$paiement_lot2_4=" € TTC";
	$paiement_lot2_5=" (".$ttc_lot_2_lettre." toutes taxes comprise) suite à la signature du Procès-verbal de Recette Intermédiaire.";
}
else
{
	$paiement_lot2_1="";
	$paiement_lot2_2="";
	$paiement_lot2_3="";
	$paiement_lot2_4="";
	$paiement_lot2_5="";
	$ht_lot_2="";
	$ttc_lot_2="";
}

if($nombre_livrable_intermediaire>2)
{
	$paiement_lot3_1="\r\n 	- Un solde intermédiaire de ";
	$paiement_lot3_2=" € HT";
	$paiement_lot3_3=" (".$ht_lot_3_lettre." hors taxes), correspondant à la réalisation de ".$jeh_lot_3." Jours-Étude Homme soit, à titre indicatif et en application du taux de TVA actuel de 20,0%, ";
	$paiement_lot3_4=" € TTC";
	$paiement_lot3_5=" (".$ttc_lot_3_lettre." toutes taxes comprise) suite à la signature du Procès-verbal de Recette Intermédiaire.";
}
else
{
	$paiement_lot3_1="";
	$paiement_lot3_2="";
	$paiement_lot3_3="";
	$paiement_lot3_4="";
	$paiement_lot3_5="";
	$ht_lot_3="";
	$ttc_lot_3="";
}

if($nombre_livrable_intermediaire>3)
{
	$paiement_lot4_1="\r\n 	- Un solde intermédiaire de ";
	$paiement_lot4_2=" € HT";
	$paiement_lot4_3=" (".$ht_lot_4_lettre." hors taxes), correspondant à la réalisation de ".$jeh_lot_4." Jours-Étude Homme soit, à titre indicatif et en application du taux de TVA actuel de 20,0%, ";
	$paiement_lot4_4=" € TTC";
	$paiement_lot4_5=" (".$ttc_lot_4_lettre." toutes taxes comprise) suite à la signature du Procès-verbal de Recette Intermédiaire.";
}
else
{
	$paiement_lot4_1="";
	$paiement_lot4_2="";
	$paiement_lot4_3="";
	$paiement_lot4_4="";
	$paiement_lot4_5="";
	$ht_lot_4="";
	$ttc_lot_4="";
}

//Gestion droit communication
if($droit_communication=="1")
{
	$droit_communication1="\rArticle XII: Droit de communication";
	$droit_communication2 = "Le client autorise JEECE à citer le nom de ".$nom_societe." et le domaine de l’étude réalisée ainsi qu’à donner un lien vers le rendu final de l’étude sur ses supports de communication, à titre d’exemple de compétences.\r";
	$article_propriete = "Article XIII: Propriété de l’étude";
	$article_litige = "Article XIV: Litiges et tribunaux compétents";
	$article_cnil = "Article XV: CNIL";
	$article_effet = "Article XVI: Prise d’effet";
}
else
{
	$droit_communication1="";
	$droit_communication2 ="";
	$article_propriete = "Article XII: Propriété de l’étude";
	$article_litige = "Article XIII: Litiges et tribunaux compétents";
	$article_cnil = "Article XIV: CNIL";
	$article_effet = "Article XV: Prise d’effet";
}



$president = get_parametre("president",date_traitee_to_date_sql($date_cc));

// -----------------
// Load the template
// -----------------

$template = get_doc_type("cc",date_traitee_to_date_sql($date_cc));
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
$output_file_name = $refetude."-CC.docx";
	// Output the result as a downloadable file (only streaming, no data saved in the server)
	$TBS->Show(OPENTBS_DOWNLOAD, $output_file_name); // Also merges all [onshow] automatic fields.
	// Be sure that no more output is done, otherwise the download file is corrupted with extra data.
	exit();
