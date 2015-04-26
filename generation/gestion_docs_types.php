<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id'])  || ($_SESSION['ca']!=1 && $_SESSION['bureau']!=1))
header("location: ../index.php?error=2");

include("php/connexion.php");
include("php/dates.php");
include("php/traitement.php");
include("php/blindage.php");



$date_debut=$date_fin=$type=$commentaires=$adresse_fichier="";
$cle=-1;

If(isset($_GET['supprimer']))
{
	echo "<h4 align=\"center\">  Enregistrement correctement supprimé</h4>";

	$reponse = $bdd->query("SELECT * FROM gestion_docs_types WHERE cle=".$_GET['supprimer']);
	$donnees = $reponse->fetch();
	$chemin = strtoupper($donnees['type'])."/docs/".$donnees['date_debut'].".".$donnees['format'];
	unlink($chemin);
		$reponse = $bdd->exec("DELETE FROM gestion_docs_types WHERE cle=".$_GET['supprimer']);
}
elseIf(isset($_GET['telecharger']))
{
	$reponse = $bdd->query("SELECT * FROM gestion_docs_types WHERE cle=".$_GET['telecharger']);
	$donnees = $reponse->fetch();
	$chemin = strtoupper($donnees['type'])."/docs/".$donnees['date_debut'].".".$donnees['format'];
	$nom = $donnees['date_debut'].".".$donnees['format'];
	header('Content-disposition: attachment; filename="'.$nom.'"');
   header('Content-type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
   readfile($chemin);
}
else if(isset($_POST['modifier']) && $_POST['modifier']!=-1  && blindage_gestion_doc_types($_POST['modifier'])=="")//C'est une modification
{

	$reponse = $bdd->query("SELECT * FROM gestion_docs_types WHERE cle=".$_POST['modifier']);
	$donnees = $reponse->fetch();
	$chemin = strtoupper($donnees['type'])."/docs/".$donnees['date_debut'].".".$donnees['format'];
	
		if (  $_FILES['fichier']['error'] > 0)  //On renomme uniquement
		{
			$chemin2 = strtoupper($donnees['type'])."/docs/".date_traitee_to_date_sql($_POST['date_debut']).".".$donnees['format'];
			rename($chemin, $chemin2);
		}
		else
		{
			$chemin = strtoupper($donnees['type'])."/docs/".$donnees['date_debut'].".".$donnees['format'];
			unlink($chemin);
			$resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],strtoupper($_GET['type'])."/docs/".date_traitee_to_date_sql($_POST['date_debut']).".".pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION));
		}
	

	$req = $bdd->prepare('UPDATE gestion_docs_types SET date_debut = :date_debut, date_fin = :date_fin, type = :type, commentaires = :commentaires WHERE cle = :cle');
	$req->execute(array(
		'date_debut' => date_traitee_to_date_sql($_POST['date_debut']),
		'date_fin' => date_traitee_to_date_sql($_POST['date_fin']),
		'type' => $_GET['type'],
		'commentaires' => $_POST['commentaires'],
		'cle' => $_POST['modifier']
	));
	echo "<h4 align=\"center\">  Modifications effectuées</h4>";
	$succes=true;


	  
}
//Insertion
else if (isset($_POST['modifier']) && $_POST['modifier']==-1  && blindage_gestion_doc_types(-1)=="")
{
	$req = $bdd->prepare('INSERT INTO gestion_docs_types(date_debut, date_fin, type, commentaires, format) VALUES(:date_debut, :date_fin, :type, :commentaires, :format)');
	$req->execute(array(
		'date_debut' => date_traitee_to_date_sql($_POST['date_debut']),
		'date_fin' => date_traitee_to_date_sql($_POST['date_fin']),
		'type' => $_GET['type'],
		'commentaires' => $_POST['commentaires'],
		'format' => pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION),
	));
	
	  $resultat = move_uploaded_file($_FILES['fichier']['tmp_name'],strtoupper($_GET['type'])."/docs/".date_traitee_to_date_sql($_POST['date_debut']).".".pathinfo($_FILES['fichier']['name'], PATHINFO_EXTENSION));

	echo '<h4>L\'entrée a bien été ajoutée !</h4>';
	$succes=true;
}
//On récupère les POST s'ils existent sinon on initialise
elseif(isset($_POST['date_debut']))//Inutile de les faire tous car si un existe, les autres existent
{
	$date_debut = $_POST['date_debut'];
	$date_fin = $_POST['date_fin'];
	$commentaires = $_POST['commentaires'];
	$cle=(isset($_POST['modifier']) ? $_POST['modifier'] : "");
	echo "<h4>".blindage_gestion_doc_types($_POST['modifier'])."</h4>";
}
//On souhaite modifier
elseIf(isset($_GET['modifier']))
{
	$reponse = $bdd->query("SELECT * FROM gestion_docs_types WHERE cle=".$_GET['modifier']);
	$donnees = $reponse->fetch();
	$date_debut = date('d/m/Y',strtotime($donnees['date_debut']));
	$date_fin = date('d/m/Y',strtotime($donnees['date_fin']));
	$type = $donnees['type'];
	$commentaires = $donnees['commentaires'];
	$cle=$donnees['cle'];
	$fichier = $donnees['date_debut'];

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
<script type="text/javascript">
function docChangeGestion()
{
	window.location.href='gestion_docs_types.php?type='+document.getElementById("docChoisiId").value;
}

</script>
<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
<link rel="Stylesheet" type="text/css" href="css/calendar.css" />
<link rel="Stylesheet" type="text/css" href="css/style.css" />
</head>

<body align="center">
<a href="../">
<h3 align="left"> Retour Accueil</h3>
</a>
<h2 align="center"> Gestion des docs types</h2>
Filtre :
<SELECT name="doc" id="docChoisiId" size="1" id="doc" onchange="docChangeGestion()">
  <OPTION value="actuels" <?php if(!isset($_GET['type'])) echo "selected" ?> onClick="javascript:window.location.href = 'gestion_docs_types.php'"> Actuels
    <OPTION value="d"  <?php if(isset($_GET['type']) && $_GET['type']=="d") echo "selected" ?>>Devis
  <OPTION value="cc"  <?php if(isset($_GET['type']) && $_GET['type']=="cc") echo "selected" ?>>Convention Client
  <OPTION value="ap" <?php if(isset($_GET['type']) && $_GET['type']=="ap") echo "selected" ?> >Avant-Projet
  <OPTION value="pl" <?php if(isset($_GET['type']) && $_GET['type']=="pl") echo "selected" ?>>Prêt de Licence
  <OPTION value="rm" <?php if(isset($_GET['type']) && $_GET['type']=="rm") echo "selected" ?>>Récapitulatif de Mission
  <OPTION value="ac" <?php if(isset($_GET['type']) && $_GET['type']=="ac") echo "selected" ?>>Avenant Client
  <OPTION value="arm" <?php if(isset($_GET['type']) && $_GET['type']=="arm") echo "selected" ?>>Avenant au RM
  <OPTION value="rt" <?php if(isset($_GET['type']) && $_GET['type']=="rt") echo "selected" ?>>Rapport Technique
  <OPTION value="pv" <?php if(isset($_GET['type']) && $_GET['type']=="pv") echo "selected" ?> >Procès Verbal
  <OPTION value="rp" <?php if(isset($_GET['type']) && $_GET['type']=="rp") echo "selected" ?> >Rapport Pédagogique
  <OPTION value="sat_cli" <?php if(isset($_GET['type']) && $_GET['type']=="sat_cli") echo "selected" ?> >Satisfaction Client
  <OPTION value="sat_int" <?php if(isset($_GET['type']) && $_GET['type']=="sat_int") echo "selected" ?> >Satisfaction 
  <OPTION value="ce" <?php if(isset($_GET['type']) && $_GET['type']=="ce") echo "selected" ?> >Convention Etudiant
</SELECT>
<br />
<br />
<table border="1" cellspacing="0" cellpadding="0" width="900">
  <tr>
    <td>Date de début</td>
    <td>Date de fin</td>
    <td>Type</td>
    <td>Télécharger</td>
    <td>Modifier</td>
    <td>Supprimer</td>
  </tr>
  <?php
		if(isset($_GET['type']) && strcmp($_GET['type'],"actuels")!=0)
		{			
		
			
				$type = $_GET['type'];
				$reponse = $bdd->query('SELECT * FROM gestion_docs_types WHERE type=\''.$type.'\'');
			
		}
		else
		$reponse = $bdd->query('SELECT * FROM gestion_docs_types WHERE date_debut<=DATE(NOW()) AND date_fin>=DATE(NOW())');
		// On affiche chaque entrée une à une
		while ($donnees = $reponse->fetch())
		{?>
  <tr>
    <td><?php echo date('d/m/Y',strtotime($donnees['date_debut'])); ?></td>
    <td><?php echo date('d/m/Y',strtotime($donnees['date_fin'])); ?></td>
    <td><?php echo $donnees['type']; ?></td>
    <td><input type="submit" style="width:100px" value="Télécharger" onClick="window.location.href= 'php/download_doc_type.php?telecharger=<?php echo $donnees['cle']; ?>&type=<?php echo $donnees['type']; ?>';"/></td>
    <td><input type="submit" style="width:100px" value="Modifier" onClick="window.location.href = 'gestion_docs_types.php?modifier=<?php echo $donnees['cle']; ?>&type=<?php echo $donnees['type']; ?>';"/></td>
    <td><input type="button" style="width:100px" value="Supprimer" onClick="window.location.href = 'gestion_docs_types.php?supprimer=<?php echo $donnees['cle']; ?>&type=<?php echo $donnees['type']; ?>';"/></td>
  </tr>
  <?php
		}?>
</table>
<?php
	if(isset($_GET['type']) && strcmp($_GET['type'],"actuels")!=0)
	{?>
<form id="form1" method="post" action="./gestion_docs_types.php?type=<?php echo $_GET['type']; ?>" align='center' enctype="multipart/form-data">
<br /><br /><fieldset>
<?php
	if($cle!=-1)  echo"<legend>Modifier l'entrée</legend>"; else echo "<legend>Nouvelle entrée</legend>";
	?>

  <?php echo "<input type=\"hidden\" name=\"modifier\" value=\"".$cle."\">"; ?>
  
    <label>Date de début :</label>
    <input style="cursor: pointer;width:350px" name="date_debut" type="text"  value="<?php echo $date_debut;?>" onclick="new calendar(this);"/>
    <br />
    <label>Date de fin :</label>
    <input style="cursor: pointer;width:350px" name="date_fin" type="text"  value="<?php echo $date_fin;?>" onclick="new calendar(this);"/>
    <br />
    <label>Document :</label>
    <?php if($cle!=-1) { ?>
    <button type="button" value="Télécharger" style="width:350px" onClick="window.location.href= 'php/download_doc_type.php?telecharger=<?php echo $cle; ?>&type=<?php echo $type; ?>';"/>
    Télécharger
    </button>
    <?php } ?>
    <input type="file" name="fichier" id="fichier" style="width:350px"/>
    <br />
    <label>Commentaires :</label>
    <textarea rows="4" name="commentaires" style="width:350px"cols="50"><?php echo $commentaires; ?></textarea>
  </fieldset>
  <input type="submit" name="btn_go" value="Enregistrer" style="width:900px;height:60px"/><br /><br />
</form>
<?php } ?>
</body>
