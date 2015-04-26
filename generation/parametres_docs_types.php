<?php
if(session_id() == "")session_start();
if(!isset($_SESSION['id'])  || ($_SESSION['ca']!=1 && $_SESSION['bureau']!=1))
header("location: ../index.php?error=2");

include("php/connexion.php");
include("php/dates.php");
include("php/traitement.php");
include("php/blindage.php");



$date_debut=$date_fin=$taux_tva=$jeh_bas=$jeh_haut=$frais_structure=$min_frais_structure=$max_frais_structure=$phase_analyse=$max_phase_analyse=$taux_renumeration_rm=$taux_acompte=$president=$tresorier="";
$cle=-1;

If(isset($_GET['supprimer']))
{
	echo "<h4 align=\"center\">  Enregistrement correctement supprimé</h4>";
	$reponse = $bdd->exec("DELETE FROM parametre_doc_type WHERE cle=".$_GET['supprimer']);
}

else if(isset($_POST['modifier']) && $_POST['modifier']!=-1  && blindage_parametres_doc_types($_POST['modifier'])=="")//C'est une modification
{
	$req = $bdd->prepare('UPDATE parametre_doc_type SET date_debut = :date_debut, date_fin = :date_fin, tva = :taux_tva, jeh_bas = :jeh_bas, jeh_haut = :jeh_haut, frais_structure = :frais_structure,min_frais_structure = :min_frais_structure,max_frais_structure = :max_frais_structure, phase_analyse = :phase_analyse, max_phase_analyse = :max_phase_analyse, taux_renumeration_rm = :taux_renumeration_rm, taux_acompte = :taux_acompte, president = :president, tresorier = :tresorier WHERE cle = :cle');
	$req->execute(array(
		'date_debut' => date_traitee_to_date_sql($_POST['date_debut']),
		'date_fin' =>date_traitee_to_date_sql($_POST['date_fin']),
		'taux_tva' => $_POST['taux_tva'],
		'jeh_bas' => $_POST['jeh_bas'],
		'jeh_haut' => $_POST['jeh_haut'],
		'frais_structure' => $_POST['frais_structure'],
		'min_frais_structure' => $_POST['min_frais_structure'],
		'max_frais_structure' => $_POST['max_frais_structure'],
		'phase_analyse' => $_POST['phase_analyse'],
		'max_phase_analyse' => $_POST['max_phase_analyse'],
		'taux_renumeration_rm' => $_POST['taux_renumeration_rm'],
		'taux_acompte' => $_POST['taux_acompte'],
				'president' => $_POST['president'],
						'tresorier' => $_POST['tresorier'],
		'cle' => $_POST['modifier']
	));
	echo "<h4 align=\"center\">  Modifications effectuées</h4>";
	$succes=true;
}
//Insertion
else if (isset($_POST['modifier']) && $_POST['modifier']==-1  && blindage_parametres_doc_types(-1)=="")
{
	$req = $bdd->prepare('INSERT INTO parametre_doc_type(date_debut, date_fin, tva, jeh_bas, jeh_haut, frais_structure, min_frais_structure,max_frais_structurephase_analyse, max_phase_analysse, taux_renumeration_rm, taux_acompte) VALUES(:date_debut, :date_fin, :taux_tva, :jeh_bas, :jeh_haut,:frais_structure, :min_frais_structure,:max_frais_structure,:phase_analyse,:max_phase_analyse, :taux_renumeration_rm :taux_acompte, president = :president, tresorier = :tresorier )');
	$req->execute(array(
		'date_debut' => date_traitee_to_date_sql($_POST['date_debut']),
		'date_fin' => date_traitee_to_date_sql($_POST['date_fin']),
		'taux_tva' => $_POST['taux_tva'],
		'jeh_bas' => $_POST['jeh_bas'],
		'jeh_haut' => $_POST['jeh_haut'],
		'frais_structure' => $_POST['frais_structure'],
		'min_frais_structure' => $_POST['min_frais_structure'],
		'max_frais_structure' => $_POST['max_frais_structure'],
		'phase_analyse' => $_POST['phase_analyse'],
		'max_phase_analyse' => $_POST['max_phase_analyse'],
		'taux_renumeration_rm' => $_POST['taux_renumeration_rm'],
		'taux_acompte' => $_POST['taux_acompte'],
						'president' => $_POST['president'],
						'tresorier' => $_POST['tresorier'],
	));

	echo '<h4>L\'entrée a bien été ajoutée !</h4>';
	$succes=true;
}
//On récupère les POST s'ils existent sinon on initialise
elseif(isset($_POST['date_debut']))//Inutile de les faire tous car si un existe, les autres existent
{
	$date_debut = $_POST['date_debut'];
	$date_fin = $_POST['date_fin'];
	$taux_tva = (isset($_POST['taux_tva']) ? $_POST['taux_tva'] : "");
	$jeh_bas = (isset($_POST['jeh_bas']) ? $_POST['jeh_bas'] : "");
	$jeh_haut = (isset($_POST['jeh_haut']) ? $_POST['jeh_haut'] : "");
	$frais_structure = (isset($_POST['frais_structure']) ? $_POST['frais_structure'] : "");
	$min_frais_structure = (isset($_POST['min_frais_structure']) ? $_POST['min_frais_structure'] : "");
	$max_frais_structure = (isset($_POST['max_frais_structure']) ? $_POST['max_frais_structure'] : "");
	$max_phase_analyse = (isset($_POST['max_phase_analyse']) ? $_POST['max_phase_analyse'] : "");
	$phase_analyse = (isset($_POST['phase_analyse']) ? $_POST['phase_analyse'] : "");
	$taux_renumeration_rm = (isset($_POST['taux_renumeration_rm']) ? $_POST['taux_renumeration_rm'] : "");
	$taux_acompte = (isset($_POST['taux_acompte']) ? $_POST['taux_acompte'] : "");
	$cle=(isset($_POST['modifier']) ? $_POST['modifier'] : "");
	$president=(isset($_POST['president']) ? $_POST['president'] : "");
	$tresorier=(isset($_POST['tresorier']) ? $_POST['tresorier'] : "");
	echo "<h4>".blindage_parametres_doc_types($_POST['modifier'])."</h4>";
}
//On souhaite modifier
elseIf(isset($_GET['modifier']))
{
	$reponse = $bdd->query("SELECT * FROM parametre_doc_type WHERE cle=".$_GET['modifier']);
	$donnees = $reponse->fetch();
	$date_debut = date('d/m/Y',strtotime($donnees['date_debut']));
	$date_fin = date('d/m/Y',strtotime($donnees['date_fin']));
	$taux_tva = $donnees['tva'];
	$jeh_bas = $donnees['jeh_bas'];
	$jeh_haut = $donnees['jeh_haut'];
	$frais_structure = $donnees['frais_structure'];
	$min_frais_structure = $donnees['min_frais_structure'];
	$max_frais_structure = $donnees['max_frais_structure'];
	$phase_analyse = $donnees['phase_analyse'];
	$max_phase_analyse = $donnees['max_phase_analyse'];
	$taux_renumeration_rm = $donnees['taux_renumeration_rm'];
	$taux_acompte = $donnees['taux_acompte'];
	$cle=$donnees['cle'];
	$president = $donnees['president'];
	$tresorier=$donnees['tresorier'];
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>[JEECE] Paramètres Doc Types</title>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.5.1.min.js"></script>
	<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.ui/1.8.10/jquery-ui.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
	<link rel="Stylesheet" type="text/css" href="css/calendar.css" />
	<link rel="Stylesheet" type="text/css" href="css/style.css" />
</head>

<body align="center">
	<a href="../"><h3 align="left">  Retour Accueil</h3></a>
	<h2 align="center"> Paramètres docs types</h2>
	
	<table align="center" border="1" cellspacing="0" cellpadding="0" width="90%">
		<tr>
			<td style="width:80px">Date de début</td>
			<td style="width:80px">Date de fin</td>
			<td style="width:50px">Taux TVA</td>
			<td style="width:50px">JEH Bas</td>
			<td style="width:50px">JEH haut</td>
			<td style="width:60px">Frais structure</td>
            <td style="width:80px">Max Frais structure</td>
            <td style="width:80px">Min Frais structure</td>
			<td>Phase Analyse</td>
            <td style="width:80px">Max phase Analyse</td>
			<td>Rénumération étudiant</td>
            <td>Acompte</td>
            <td>Président</td>
            <td>Trésorier</td>
			<td>Modifier</td>
			<td>Supprimer</td>
		</tr>
		<?php
		$reponse = $bdd->query('SELECT * FROM parametre_doc_type');
		// On affiche chaque entrée une à une
		while ($donnees = $reponse->fetch())
		{?>
			<tr>
				
				<td><?php echo date('d/m/Y',strtotime($donnees['date_debut'])); ?></td>
				<td><?php echo date('d/m/Y',strtotime($donnees['date_fin'])); ?></td>
				<td><?php echo $donnees['tva']; ?> %</td>
				<td><?php echo $donnees['jeh_bas']; ?> €</td>
				<td><?php echo $donnees['jeh_haut']; ?> €</td>
				<td><?php echo $donnees['frais_structure']; ?> %</td>
                <td><?php echo $donnees['max_frais_structure']; ?> €</td>
                <td><?php echo $donnees['min_frais_structure']; ?> €</td>
				<td><?php echo $donnees['phase_analyse']; ?> %</td>
                <td><?php echo $donnees['max_phase_analyse']; ?> €</td>
				<td><?php echo $donnees['taux_renumeration_rm']; ?> %</td>
                <td><?php echo $donnees['taux_acompte']; ?> %</td>
                 <td><?php echo $donnees['president']; ?></td> 
                 <td><?php echo $donnees['tresorier']; ?></td>
				<td><input type="submit" style="width:100px" value="Modifier" onClick="window.location.href = 'parametres_docs_types.php?modifier=<?php echo $donnees['cle']; ?>';"/></td>
				<td><input type="button" style="width:100px" value="Supprimer" onClick="window.location.href = 'parametres_docs_types.php?supprimer=<?php echo $donnees['cle']; ?>';"/></td>
			</tr>
		<?php
		}?>
	</table>
	<form id="form1" method="post" action="./parametres_docs_types.php" align='center'>
    <fieldset>
	<?php

	if($cle!=-1)  echo"<legend> Modifier l'entrée</legend>"; else echo "<legend> Nouvelle entrée</legend>";
	?>
	
		<?php echo "<input type=\"hidden\" name=\"modifier\" value=\"".$cle."\">"; ?>
		
				<label>Date de début :</label>
					<input style="cursor: pointer" name="date_debut" type="text" value="<?php echo $date_debut;?>" onclick="new calendar(this);"/> 
                    
				<br /><label>Date de fin :</label>
					<input style="cursor: pointer" name="date_fin" type="text" value="<?php echo $date_fin;?>" onclick="new calendar(this);"/> 
                    
				<br /><label>Taux TVA (en %) :</label>
					<input name="taux_tva" type="number"  step="1" min="0"  max="100" value="<?php echo $taux_tva; ?>" />
				<br /><label>Fourchette JEH basse :</label>
					<input name="jeh_bas" type="number" step="1" min="0"value="<?php echo $jeh_bas; ?>" />
				<br /><label>Fourchette JEH haute :</label>
					<input name="jeh_haut" type="number" step="1" min="0"  value="<?php echo $jeh_haut; ?>" />
				
               
				<br /><label>Frais de structure (en %) :</label>
					<input name="frais_structure" type="number"  step="1" min="0"  max="100" value="<?php echo $frais_structure; ?>" />
				<br /><label>Min Frais de structure (en €) :</label>
					<input name="min_frais_structure" type="number"  step="1" min="0"  value="<?php echo $min_frais_structure; ?>" />
				<br /><label>Max Frais de structure (en €) :</label>
					<input name="max_frais_structure" type="number" step="1" min="0"  value="<?php echo $max_frais_structure; ?>" />
				<br /><label>Pourcentage max de la phase d'analyse :</label>
					<input name="phase_analyse" type="number"  step="1" min="0"  max="100" value="<?php echo $phase_analyse; ?>" />
                    				<br /><label>Montant max de la phase d'analyse :</label>
					<input name="max_phase_analyse" type="number"  step="0.01" min="0" value="<?php echo $max_phase_analyse; ?>" />
				<br /><label>Taux rénumération étudiant (en %) :</label>
					<input name="taux_renumeration_rm" type="number" step="1" min="0"  max="100" value="<?php echo $taux_renumeration_rm; ?>" />	
                    				<br /><label>Taux acompte (en %) :</label>
					<input name="taux_acompte" type="number" step="1" min="0"  max="100" value="<?php echo $taux_acompte; ?>" />					
                    <br /><label>Président :</label>
					<input name="president" type="text"  value="<?php echo $president; ?>" />					
                    <br /><label>Trésorier :</label>
					<input name="tresorier" type="text" value="<?php echo $tresorier; ?>" />					
				</fieldset>
					<input type="submit" name="btn_go" value="Enregistrer" style="width:900px;height:60px"/>

	</form>
</body>