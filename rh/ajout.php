<?php
if(session_id() == "")session_start();
if(!isset($_SESSION['id']) && ($_SESSION['ca']==1 || $_SESSION['bureau']==1))
header("location: ../index.php?error=2");

include("php/connexion.php");
include("php/traitement.php");



if(isset($_GET['modifier']))
{
	$id=$_GET['modifier'];	
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
<?php
if(isset($_GET['modifier'])) echo"<title>Modifier un membre</title>";
else  echo"<title>Ajouter un membre</title>";
?>
</head>
<?php
if(isset($_GET['modifier']))
echo '<body onload="intervenantFunction(true);compteFunction()">';
else echo '<body onload="intervenantFunction(false);compteFunction()">';
?>
<a href="index.php">
<h3 align="left"> Retour Gestion RH</h3>
</a>

<?php
if(isset($_GET['modifier'])) echo"<h2> Modifier un membre</h2>";
else  echo"<h2> Nouveau Membre</h2>";
?>
<div align='center'>
  <form id="formMembre" method="post" action="index.php" align='center'>

<?php if(isset($_GET['modifier'])) echo "<input type=\"hidden\" name=\"modifier\" value=\"".$_GET['modifier']."\">"; ?>

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
      <label>Promotion</label>
      <input  placeholder="Promotion" value="<?php echo $promo; ?>"  name="promo" min="1980" ste="1" max="2100" type="number"/>
    </fieldset>
    <fieldset>
      <legend>Intervenant</legend>
      <label>Intervenant ?</label>
      
      
      <input name="intervenant" id="intervenant_id" value="1" <?php if($intervenant==1) echo "checked"; ?> type="checkbox" <?php if(isset($_GET['modifier'])) echo 'onchange="intervenantFunction(true)"'; else echo 'onchange="intervenantFunction(false)"'; ?>/>
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
          <legend>Convention Etudiante</legend>
      <label>Date Signature </label>
      <input placeholder="JJ/MM/AAAA"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_ce" id="date_ce_id" type="text" onclick="new calendar(this);" value="<?php echo $date_ce; ?>"/>
           <br /> <label>Référence CE</label>
      <input placeholder="Référence CE" style="width:130px" value="<?php echo $ref_ce; ?>" name="ref_ce" type="text">
      <input  type="button" style="width:70px" value="Générer" value="<?php echo $cp; ?>"onClick="refCE()"/>
      <br /> <label> CE signée </label>
      <input name="ce_signee"  value="1" <?php if($ce_signee==1) echo "checked"; ?>  type="checkbox" />
      <br /> <label> Carte d'identité donnée </label>
      <input name="cni"  value="1" <?php if($cni==1) echo "checked"; ?>  type="checkbox" />
      <br /> <label> Carte Vitale donnée </label>
      <input name="carte_vitale"  value="1" <?php if($carte_vitale==1) echo "checked"; ?>  type="checkbox" />
	</fieldset>
        <fieldset>
      <legend>Compte</legend>
     <label>Activer son compte ?</label>
      <input name="compte"  value="1" type="checkbox" <?php if($compte==1) echo "checked";?>  onChange="compteFunction(<?php echo $compte; ?>)"/>
      <div id="compteDiv" style="display:none">
     <?php if(!isset($_GET['modifier'])) { ?> <br /><label>Le prévenir par mail de la création de son compte ?</label>
<input name="mail_compte"  value="1" type="checkbox" /><?php } ?>
           <br /> <label>Mot de passe</label>
      <input if(placeholder="Mot de Passe" <?php if(isset($_GET['modifier'])) echo "tooltipText='Si vous laissez ce champ vide, le mot de passe ne sera pas changé'"; ?> style="width:130px" name="mdp" type="text">
      <input  type="button" style="width:70px" value="Générer" onClick="genererMdp()"/>
</div>
    </fieldset>
    <?php
	$annee = array();
	if(isset($_GET['modifier']))
	{
				$reponse = $bdd->query('SELECT * FROM rh_annee WHERE membre='.$id);
				
	while($donnees = $reponse->fetch())
	{ array_push($annee, $donnees['annee']); ?>
		<fieldset>
      <legend>Année <?php echo $donnees['annee']; ?></legend>
                  <label>Supprimer ce poste cette année</label>
      <input name="supprimer_annee<?php echo $donnees['annee']; ?>"  value="1" type="checkbox" />
            <br>
      <label>Poste</label>
      <input  placeholder="Poste" value="<?php echo $donnees["poste"]; ?>" required name="poste<?php echo $donnees['annee']; ?>" type="text"/>
      <br>
            <label>Membre du CA</label>
      <input name="ca<?php echo $donnees['annee']; ?>"  value="1" <?php if($donnees['ca']==1) echo "checked"; ?> type="checkbox" />
            <br>
            <label>Membre du bureau</label>
      <input name="bureau<?php echo $donnees['annee']; ?>" value="1" <?php if($donnees['bureau']==1) echo "checked"; ?> type="checkbox" />
                              <br>
            <label>Chèque</label>
      <input name="cheque<?php echo $donnees['annee']; ?>"  value="1" <?php if($donnees['cheque']==1) echo "checked"; ?> type="checkbox" />
                                    <br>
            <label>Carte Etudiant</label>
      <input name="carte_etudiant<?php echo $donnees['annee']; ?>"  value="1" <?php if($donnees['carte_etudiant']==1) echo "checked"; ?> type="checkbox" />
    </fieldset>
	<?php }
	}
	?>
            <fieldset>
      <legend>Année 
      <select tooltipText="Attention : une seule année peut être ajoutée à la fois" name="annee" id="annee_id" size="1" style="width:100px" >
        <?php  for($i=date("Y");$i>1985;$i--)
		{
			if(!in_array($i."/".($i+1),$annee))
			{
			?>
        <OPTION <?php  if ((date("m")>6 && $i==date("Y")) || (date("m")<6 && $i==(date("Y")-1))) echo "selected";?> value=<?php echo $i; ?> ><?php echo $i."/".($i+1); ?>
        <?php } }?>
      </select></legend>
      <label>Poste</label>
      <input  placeholder="Poste" <?php if(!isset($_GET['modifier'])) echo"required"; ?> name="poste" type="text"/>
      <br>
            <label>Membre du CA</label>
      <input name="ca"  value="1" type="checkbox" />
            <br>
            <label>Membre du bureau</label>
      <input name="bureau" value="1" type="checkbox" />
                              <br>
            <label>Chèque</label>
      <input name="cheque"  value="1" type="checkbox" />
                                          <br>
            <label>Carte Etudiant</label>
      <input name="carte_etudiant"  value="1" type="checkbox" />
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