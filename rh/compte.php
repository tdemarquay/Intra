<?php
if(session_id() == "")session_start();
if(!isset($_SESSION['id']))
header("location: ../index.php?error=2");

include("php/connexion.php");
include("php/traitement.php");



if(isset($_GET['modifier']))
{
	$id=$_SESSION['id'];	
	$reponse = $bdd->query('SELECT * FROM rh WHERE id='.$id);
	$donnees = $reponse->fetch();
	$nom = $donnees["nom"];
	$mdp = $donnees["mdp"];
	$prenom = $donnees["prenom"];
	$mail = $donnees["email"];
	$mail_jeece = $donnees["email_jeece"];
	$tel = $donnees["tel"];
	$adresse = $donnees["adresse"];
		$promo = $donnees["promotion"];
	$cp = $donnees["cp"];
	$ville = $donnees["ville"];
	$intervenant = $donnees["intervenant"];
	$competences = $donnees["competences"];
	$android = $donnees["android"];
	$ios = $donnees["ios"];
	$windows_phone = $donnees["windows_phone"];
	$vba = $donnees["vba"];
	$java = $donnees["java"];
	$C = $donnees["C"];
	$site = $donnees["site"];
	$electronique = $donnees["electronique"];
	$traduction = $donnees["traduction"];
	if($donnees["date_ce"]=="0000-00-00") $date_ce = "";
	else $date_ce = date("d/m/Y",date_sql_to_timestamp($donnees["date_ce"]));
	$ref_ce = $donnees["ref_ce"];
	$ce_signee = $donnees["ce_signee"];
		$compte = $donnees["compte"];
		$cni = $donnees["cni"];
		$carte_vitale = $donnees["carte_vitale"];
		

}
else
{
$nom = $prenom = $mail = $mail_jeece = $tel = $adresse = $cp = $mdp = $ville = $promo = $competences = $date_ce = $ref_ce = "";
$intervenant = $android = $ios = $cni = $carte_etudiant = $carte_vitale = $windows_phone = $vba = $java = $C = $site = $electronique = $traduction = $ce_signee = $compte = 0;
}
 ?>

<!doctype html>
<html>
<head>
<link rel="Stylesheet" type="text/css" href="css/ajout.css" />
<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
<link rel="Stylesheet" type="text/css" href="css/calendar.css" />
<link rel="Stylesheet" type="text/css" href="css/form-field-tooltip.css" />
<script type="text/javascript" src="js/ajout.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/form-field-tooltip.js"></script>

<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/cp_ville.js"></script>
<script type="text/javascript" src="js/rounded-corners.js"></script>

<meta charset="utf-8">
<title>Mon compte</title>
</head>
<?php
if(isset($_GET['modifier']))
echo '<body onload="intervenantFunction(true);compteFunction()">';
else echo '<body onload="intervenantFunction(false);compteFunction()">';
?>
<a href="../index.php">
<h3 align="left"> Retour Index</h3>
</a>


<h2> Mon Compte</h2>
<div align='center'>
  <form id="formCompte" method="post" action="index.php" align='center'>

<?php if(isset($_GET['modifier'])) echo "<input type=\"hidden\" name=\"modifier\" value=\"".$id."\">"; ?>
<input type="hidden" name="moncompte" value="1">
    <fieldset>
      <legend>Coordonnées</legend>
      <label>Nom</label>
      <input  placeholder="Nom" value="<?php echo $nom; ?>" required name="nom" type="text"/>
      <br>
      <label>Prénom</label>
      <input  placeholder="Prénom" value="<?php echo $prenom; ?>" required name="prenom" type="text"/>
      <br>
      <label>Mail</label>
      <input  placeholder="Mail" name="mail" value="<?php echo $mail; ?>" required type="mail"/>
      <br>
            <label>Mail JEECE (si créée)</label>
      <input placeholder="Mail JEECE" style="width:130px" value="<?php echo $mail_jeece; ?>" tooltipText="Ne remplir ce champ que si l'adresse JEECE a été créée" name="mail_jeece" type="text">
      <input  type="button" style="width:70px" value="Générer" onClick="mailJeece()"/>
      <br>
      <label>Téléphone </label>
      <input placeholder="Téléphone" name="tel" value="<?php echo $tel; ?>" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" type="tel"/>
      <br>
      <label>Adresse</label>
      <input  placeholder="Adresse" value="<?php echo $adresse; ?>"  name="adresse" type="text"/>
      <br>
      <label>Code Postal</label>
      <input  placeholder="Code Postal" value="<?php echo $cp; ?>" id="cp_ce" name="cp" type="text"/>
       <br>
      <label>Ville</label>
      <input  placeholder="Ville" value="<?php echo $ville; ?>"  id="ville_ce" name="ville" type="text"/>
       <br>
      <label>Promotion (année) </label>
      <input  placeholder="Promotion" value="<?php echo $promo; ?>"  name="promo" min="1980" ste="1" max="2100" type="number"/>
    </fieldset>
    <fieldset>
      <legend>Intervenant</legend>
      <label>Intervenant ?</label>
      
      
      <input name="intervenant" id="intervenant_id" value="1" <?php if($intervenant==1) echo "checked"; ?> type="checkbox" onchange="intervenantFunctionCompte()"/>
      <div id="intervenantDiv" style="display:none">
        <table width="724" border="0" align="center">
          <tr>
            <td width="236"><label>Android</label>
            <input name="android" style="width:20px" value="1" <?php if($android==1) echo "checked"; ?> type="checkbox" />
            <td width="236"><label>iOS</label>
            <input name="ios" style="width:20px" value="1" <?php if($ios==1) echo "checked"; ?>  type="checkbox" /></td>
            <td width="238"><label>Windows Phone</label>
            <input name="windows_phone" style="width:20px" <?php if($windows_phone==1) echo "checked"; ?>  value="1" type="checkbox" /></td>
          </tr>
          <tr>
            <td><label>VBA</label>
            <input name="vba" style="width:20px" value="1" <?php if($vba==1) echo "checked"; ?> type="checkbox" />
            <td><label>Java</label>
            <input name="java" style="width:20px" value="1" <?php if($java==1) echo "checked"; ?>  type="checkbox" /></td>
            <td><label>C/C++</label>
            <input name="C" style="width:20px" value="1" <?php if($C==1) echo "checked"; ?>  type="checkbox" /></td>
          </tr>
          <tr>
            <td><label>Site Internet</label>
            <input name="site" style="width:20px" value="1" <?php if($site==1) echo "checked"; ?>  type="checkbox" /></td>
                        <td><label>Electronique</label>
            <input name="electronique" style="width:20px" <?php if($electronique==1) echo "checked"; ?>  value="1" type="checkbox" /></td>
                        <td><label>Traduction</label>
            <input name="traduction" style="width:20px"<?php if($traduction==1) echo "checked"; ?>  value="1" type="checkbox" /></td>
          </tr>
        </table>

        <br /><label> Commentaires compétences</label>
<textarea placeholder="Commentaires compétences" rows="4" name="competences"><?php echo $competences; ?></textarea>
      </div>
	</fieldset>

        <fieldset>
<label>Mot de passe</label>
      <input if(placeholder="Mot de Passe" <?php if(isset($_GET['modifier'])) echo "tooltipText='Si vous laissez ce champ vide, le mot de passe ne sera pas changé'"; ?> style="width:130px" name="mdp" type="text">
      <input  type="button" style="width:70px" value="Générer" onClick="genererMdp()"/>
</div>
    </fieldset>
    <?php
	$annee = array();
	if(date("m")>5) $annee = date("Y")."/".(date("Y")+1);
	else $annee = (date("Y")-1)."/".date("Y");
				$reponse = $bdd->query('SELECT * FROM rh_annee WHERE membre='.$id.' AND annee=\''.$annee.'\'');

				$poste = "";
				$donnees = $reponse->fetch();
				
					$poste=$donnees['poste'];
				
				
 ?>
		<fieldset>
      <legend>Année <?php echo $annee; ?></legend>
            
      <label>Poste</label>
      <input  placeholder="Poste" value="<?php echo $poste; ?>" required name="poste" type="text"/>
    </fieldset>
	
           
    <input type="submit" name="btn_go" value="Enregistrer" style="width:800px;height:60px"/><br><br>
  </form>
</div>

</body>
</html>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEE');
tooltipObj.setCloseMessage('Exit');
tooltipObj.initFormFieldTooltip();
</script> 