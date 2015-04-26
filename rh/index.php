<?php
if(session_id() == "")session_start();
if(!isset($_SESSION['id'])  || ($_SESSION['ca']!=1 && $_SESSION['bureau']!=1))
header("location: ../index.php?error=2");


?>
<?php
include("php/connexion.php");
include("php/verification.php");
include("php/traitement.php");


if(isset($_GET['supprimer']))
{
			$_SESSION['sauvegardeSupprimer'] = $_GET ;
	header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
else if(isset($_SESSION['sauvegardeSupprimer']))
{
	$_GET = $_SESSION["sauvegardeSupprimer"];
		unset($_SESSION["sauvegardeSupprimer"]);
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4 align="center"><h4 align=\"center\">  Membre correctement supprimé</h4>';
	$reponse = $bdd->exec("DELETE FROM rh WHERE id=".$_GET['supprimer']);
	$reponse = $bdd->exec("DELETE FROM rh_annee WHERE membre=".$_GET['supprimer']);
}
else if(isset($_GET['reinitialiser']))
{

		$_SESSION['sauvegardeReinitialiser'] = $_GET ;
	header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
if(isset($_SESSION['sauvegardeReinitialiser']))
{
	$_GET = $_SESSION["sauvegardeReinitialiser"];
		unset($_SESSION["sauvegardeReinitialiser"]);
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4 align="center">  Mot de passe réinitialisé et Mot de Passe envoyé par mail</h4>';
	$mdp = genererMDP();
	$reponse = $bdd->exec("UPDATE rh SET mdp='".sha1($mdp)."', compte=1 WHERE id=".$_GET['reinitialiser']);
	$reponse = $bdd->query('SELECT * FROM rh WHERE id='.$_GET['reinitialiser']);
		// On affiche chaque entrée une à une
		$mail = "";
		while ($donnees = $reponse->fetch())
		{
			if( $donnees['email_jeece']!="") $mail =  $donnees['email_jeece'];
		else $mail =  $donnees['email'];

		}
						
	
    		if(preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $to))
{
	$passage_ligne = "\n";
}
else
{
	$passage_ligne = "\r\n";
}
		
$headers = "From: \"Thibault DEMARQUAY\"<thibaultdemarquay@gmail.com>".$passage_ligne;
		
	$headers= $headers."Reply-to: \"Thibault DEMARQUAY\" <thibaultdemarquay@gmail.com>".$passage_ligne; 
$headers = $headers.'Mime-Version: 1.0'.$passage_ligne;
$headers= $headers.'Content-type: text/html; charset=utf-8'.$passage_ligne;


		$message = "Bonjour,<br /><br />Voici vos informations de connexion pour l'intranet JEECE :<br/>Identifiant : ".$mail."<br />Mot de pase : ".$mdp."<br/><br />Lien Intranet : <a href='demarquay.fr/jeece'>Lien</a><br/><br/>Jeecement,";
		$sujet = "[JEECE] Réinitialisation de votre mot de passe";
mail($mail,$sujet,$message,$headers);
}

else if(isset($_POST['modifier']))//C'est une modification
{
	$_SESSION['sauvegardeModifier'] = $_POST ;
			    $fichierActuel = $_SERVER['PHP_SELF'] ;
    if(!empty($_SERVER['QUERY_STRING']))
    {
        $fichierActuel .= '?' . $_SERVER['QUERY_STRING'] ;
    }
	header('Location: ' . $fichierActuel);
    exit;
}
else if(isset($_SESSION["sauvegardeModifier"]))
{
		//Onvérifie qu'il y a aun moins une année
		$_POST = $_SESSION["sauvegardeModifier"];
		unset($_SESSION["sauvegardeModifier"]);
	$n=0;
	$annee = array();
	$cheque = array();
	$poste = array();
	$ca = array();
	$carte_etudiant = array();
	$bureau = array();
	$mandatSupprime = array();
	if(!isset($_POST['moncompte']))
	{
	for($i=1986;$i<(date("Y")+1);$i++)
	{
		if(isset($_POST["poste".$i."/".($i+1)]) && $_POST["poste".$i."/".($i+1)]!="")
		{
			array_push($annee, $i."/".($i+1));
			$cheque_d = (isset($_POST["cheque".$i."/".($i+1)])) ? $_POST["cheque".$i."/".($i+1)] : 0;
			$carte_etudiant_d = (isset($_POST["carte_etudiant".$i."/".($i+1)])) ? $_POST["carte_etudiant".$i."/".($i+1)] : 0;
			$ca_d = (isset($_POST["ca".$i."/".($i+1)])) ? $_POST["ca".$i."/".($i+1)] : 0;
			$bureau_d = (isset($_POST["bureau".$i."/".($i+1)])) ? $_POST["bureau".$i."/".($i+1)] : 0;
			$suppr = (isset($_POST["supprimer_annee".$i."/".($i+1)])) ? $_POST["supprimer_annee".$i."/".($i+1)] : 0;
			array_push($mandatSupprime,$suppr);
			array_push($cheque, $cheque_d);
			array_push($poste, $_POST["poste".$i."/".($i+1)]);
			array_push($bureau, $bureau_d);
			array_push($ca, $ca_d);
			array_push($carte_etudiant, $carte_etudiant_d);
			if($suppr==0)
			$n=$n+1;
		}
		
	}
	}
	if($_POST['poste']=="" && $n==0  && !isset($_POST['moncompte']))
	{
		echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4 align="center"> Modification impossible car le membre doit au moins avoir un poste sur une année </h4>';
	}
	else
	{
	try{
		$reponse = $bdd->query('SELECT * FROM rh WHERE id='.$_POST['modifier']);
				$donnees = $reponse->fetch();
				if($_POST['mdp']=="")
				{
				$mdp = $donnees['mdp'];
				
				}
				else 
				{
				$mdp = sha1($_POST['mdp']);
			
				}
				
	
		

	
	if(isset($_POST['moncompte']))
{
		$req = $bdd->prepare('UPDATE rh SET nom = :nom, prenom = :prenom, adresse= :adresse, cp = :cp, ville = :ville, email = :email, email_jeece = :email_jeece, tel = :tel, promotion = :promotion, intervenant = :intervenant, competences = :competences,   mdp = :mdp, android = :android, ios = :ios, windows_phone = :windows_phone, vba = :vba, java = :java, C = :C, site = :site, electronique = :electronique, traduction = :traduction WHERE id = :id');
	$req->execute(array(
		'nom' => strtoupper($_POST['nom']),
		'prenom' => $_POST['prenom'],
		'adresse' => $_POST['adresse'],
		'cp' => $_POST['cp'],
		'ville' => $_POST['ville'],
		'email' => $_POST['mail'],
		'email_jeece' => $_POST['mail_jeece'],
		'tel' => $_POST['tel'],
		'promotion' => $_POST['promo'],
		'intervenant' => (isset($_POST['intervenant'])) ? $_POST['intervenant'] : 0,
		'competences' => $_POST['competences'],
		'mdp' => $mdp,
		'android' => (isset($_POST['android'])) ? $_POST['android'] : 0,
		'ios' => (isset($_POST['ios'])) ? $_POST['ios'] : 0,
		'windows_phone' => (isset($_POST['windows_phone'])) ? $_POST['windows_phone'] : 0,
		'vba' => (isset($_POST['vba'])) ? $_POST['vba'] : 0,
		'java' => (isset($_POST['java'])) ? $_POST['java'] : 0,
		'C' => (isset($_POST['C'])) ? $_POST['C'] : 0,
		'site' => (isset($_POST['site'])) ? $_POST['site'] : 0,
		'electronique' => (isset($_POST['electronique'])) ? $_POST['electronique'] : 0,
		'traduction' => (isset($_POST['traduction'])) ? $_POST['traduction'] : 0,
		'id' => $_POST['modifier']
	));
}
else
{
		$req = $bdd->prepare('UPDATE rh SET nom = :nom, prenom = :prenom, adresse= :adresse, cp = :cp, ville = :ville, email = :email, email_jeece = :email_jeece, tel = :tel, promotion = :promotion, intervenant = :intervenant, competences = :competences, ref_ce = :ref_ce, date_ce = :date_ce, ce_signee = :ce_signee, mdp = :mdp, android = :android, ios = :ios, windows_phone = :windows_phone, vba = :vba, java = :java, C = :C, site = :site, electronique = :electronique, traduction = :traduction, compte = :compte, cni = :cni, carte_vitale = :carte_vitale WHERE id = :id');
	$req->execute(array(
		'nom' => strtoupper($_POST['nom']),
		'prenom' => $_POST['prenom'],
		'adresse' => $_POST['adresse'],
		'cp' => $_POST['cp'],
		'ville' => $_POST['ville'],
		'email' => $_POST['mail'],
		'email_jeece' => $_POST['mail_jeece'],
		'tel' => $_POST['tel'],
		'promotion' => $_POST['promo'],
		'intervenant' => (isset($_POST['intervenant'])) ? $_POST['intervenant'] : 0,
		'competences' => $_POST['competences'],
		'ref_ce' => $_POST['ref_ce'],
		'date_ce' => date_traitee_to_date_sql($_POST['date_ce']),
		'ce_signee' => (isset($_POST['ce_signee'])) ? $_POST['ce_signee'] : 0,
		'mdp' => $mdp,
		'android' => (isset($_POST['android'])) ? $_POST['android'] : 0,
		'ios' => (isset($_POST['ios'])) ? $_POST['ios'] : 0,
		'windows_phone' => (isset($_POST['windows_phone'])) ? $_POST['windows_phone'] : 0,
		'vba' => (isset($_POST['vba'])) ? $_POST['vba'] : 0,
		'java' => (isset($_POST['java'])) ? $_POST['java'] : 0,
		'C' => (isset($_POST['C'])) ? $_POST['C'] : 0,
		'site' => (isset($_POST['site'])) ? $_POST['site'] : 0,
		'electronique' => (isset($_POST['electronique'])) ? $_POST['electronique'] : 0,
		'traduction' => (isset($_POST['traduction'])) ? $_POST['traduction'] : 0,
		'compte' => (isset($_POST['compte'])) ? $_POST['compte'] : 0,
		'cni' => (isset($_POST['cni'])) ? $_POST['cni'] : 0,
		'carte_vitale' => (isset($_POST['carte_vitale'])) ? $_POST['carte_vitale'] : 0,
		'id' => $_POST['modifier']
	));
}
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
		echo "test";
	trigger_error($e->getMessage(), E_USER_ERROR);
	}
	
if($_POST['poste']!="" && !isset($_POST['moncompte']))
{
		// On affiche chaque entrée une à une
		$req = $bdd->prepare('INSERT INTO rh_annee(membre, annee, bureau, ca, poste, cheque, carte_etudiant) VALUES(:membre, :annee, :bureau, :ca, :poste, :cheque, :carte_etudiant)');
	$req->execute(array(
		'membre' => $_POST['modifier'],
		'annee' => $_POST['annee']."/".($_POST['annee']+1),
		'bureau' => (isset($_POST['bureau'])) ? $_POST['bureau'] : 0,
		'ca' => (isset($_POST['ca'])) ? $_POST['ca'] : 0,
		'poste' => $_POST['poste'],
		'cheque' => (isset($_POST['cheque'])) ? $_POST['cheque'] : 0,
		'carte_etudiant' => (isset($_POST['carte_etudiant'])) ? $_POST['carte_etudiant'] : 0,
	));
}
if($n!=0 && !isset($_POST['moncompte']))
{
		for($i=0;$i<count($annee);$i++)
	{
		// On affiche chaque entrée une à une
		$req = $bdd->prepare('UPDATE rh_annee SET  bureau = :bureau, ca = :ca, poste = :poste, cheque = :cheque, carte_etudiant = :carte_etudiant WHERE membre = :membre AND annee = :annee');
	$req->execute(array(
		'membre' => $_POST['modifier'],
		'annee' => $annee[$i],
		'bureau' => $bureau[$i],
		'ca' => $ca[$i],
		'poste' => $poste[$i],
		'carte_etudiant' => $carte_etudiant[$i],
		'cheque' => $cheque[$i]
		));
		
		if($mandatSupprime[$i]==1)
$reponse = $bdd->exec("DELETE FROM rh_annee WHERE membre=".$_POST['modifier']." AND annee ='".$annee[$i]."'");
	}
	
	
}
if(isset($_POST['moncompte']))
{
		if(date("m")>5) $annee = date("Y")."/".(date("Y")+1);
	else $annee = (date("Y")-1)."/".date("Y");
			$req = $bdd->prepare('UPDATE rh_annee SET   poste = :poste WHERE membre = :membre AND annee = :annee');
	$req->execute(array(
		'membre' => $_POST['modifier'],
		'annee' => $annee,
		'poste' => $_POST['poste'],
		));
}
	
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4 align="center">  Modifications effectuées</h4>';
	}
	
}
//Insertion
else if(isset($_POST['nom']))//C'est une modification
{
	$_SESSION['sauvegardeAjouter'] = $_POST ;

	header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}
if(isset($_SESSION["sauvegardeAjouter"]))
{
	$_POST = $_SESSION["sauvegardeAjouter"];
		unset($_SESSION["sauvegardeAjouter"]);
	$reponse = $bdd->query('SELECT * FROM rh WHERE nom=\''.strtoupper(addslashes($_POST['nom'])).'\' AND prenom=\''.$_POST['prenom'].'\'');
		// On affiche chaque entrée une à une
		$nb = 0;
		while ($donnees = $reponse->fetch())
			$nb=$nb+1;

	if($nb==0)
	{
	
	if($_POST['mdp']=="")
{
			// PREMIERE SOLUTION
			// on declare une chaine de caractères
			$chaine = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@";
			
			//nombre de caractères dans le mot de passe
			$nb_caract = 8;
			
			//on fait une boucle
			for($u = 1; $u <= $nb_caract; $u++) {
				
			//on compte le nombre de caractères présents dans notre chaine
				$nb = strlen($chaine);
				
			// on choisie un nombre au hasard entre 0 et le nombre de caractères de la chai
			
				$nb = mt_rand(0,($nb-1));
				
			// on ecrit  le résultat
				$mdp = $chaine[$nb];
			}
			
		
	}
	$req = $bdd->prepare('INSERT INTO rh(nom, prenom, adresse, cp, ville, email, email_jeece, tel, promotion, intervenant, competences, ref_ce, date_ce, ce_signee, mdp, android, ios, windows_phone, vba, java, C, site, electronique, traduction, compte, carte_vitale, cni) VALUES(:nom, :prenom, :adresse, :cp, :ville, :mail, :mail_jeece, :tel, :promotion, :intervenant, :competences, :ref_ce, :date_ce, :ce_signee, :mdp, :android, :ios, :windows_phone, :vba, :java, :C, :site, :electronique, :traduction, :compte, :carte_vitale, :cni)');

	$req->execute(array(
		'nom' => strtoupper($_POST['nom']),
		'prenom' => $_POST['prenom'],
		'adresse' => $_POST['adresse'],
		'cp' => $_POST['cp'],
		'ville' => $_POST['ville'],
		'mail' => $_POST['mail'],
		'mail_jeece' => $_POST['mail_jeece'],
		'tel' => $_POST['tel'],
		'promotion' => $_POST['promo'],
		'intervenant' => (isset($_POST['intervenant'])) ? $_POST['intervenant'] : 0,
		'competences' => $_POST['competences'],
		'ref_ce' => $_POST['ref_ce'],
		'date_ce' => date_traitee_to_date_sql($_POST['date_ce']),
		'ce_signee' => (isset($_POST['ce_signee'])) ? $_POST['ce_signee'] : 0,
		'mdp' => sha1($_POST['mdp']),
		'android' => (isset($_POST['android'])) ? $_POST['android'] : 0,
		'ios' => (isset($_POST['ios'])) ? $_POST['ios'] : 0,
		'windows_phone' => (isset($_POST['windows_phone'])) ? $_POST['windows_phone'] : 0,
		'vba' => (isset($_POST['vba'])) ? $_POST['vba'] : 0,
		'java' => (isset($_POST['java'])) ? $_POST['java'] : 0,
		'C' => (isset($_POST['C'])) ? $_POST['C'] : 0,
		'site' => (isset($_POST['site'])) ? $_POST['site'] : 0,
		'electronique' => (isset($_POST['electronique'])) ? $_POST['electronique'] : 0,
		'traduction' => (isset($_POST['traduction'])) ? $_POST['traduction'] : 0,
		'cni' => (isset($_POST['cni'])) ? $_POST['cni'] : 0,
		'carte_vitale' => (isset($_POST['carte_vitale'])) ? $_POST['carte_vitale'] : 0,
		'compte' => (isset($_POST['compte'])) ? $_POST['compte'] : 0
	));
	

$id = $bdd->lastInsertId();
		// On affiche chaque entrée une à une
		$req = $bdd->prepare('INSERT INTO rh_annee(membre, annee, bureau, ca, poste, cheque, carte_etudiant) VALUES(:membre, :annee, :bureau, :ca, :poste, :cheque, :carte_etudiant)');
	$req->execute(array(
		'membre' => $id,
		'annee' => $_POST['annee']."/".($_POST['annee']+1),
		'bureau' => (isset($_POST['bureau'])) ? $_POST['bureau'] : 0,
		'ca' => (isset($_POST['ca'])) ? $_POST['ca'] : 0,
		'poste' => $_POST['poste'],
		'cheque' => (isset($_POST['cheque'])) ? $_POST['cheque'] : 0,
		'carte_etudiant' => (isset($_POST['carte_etudiant'])) ? $_POST['carte_etudiant'] : 0,
	));
	
	
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4>L\'entrée a bien été ajoutée !</h4>';
	
	if(isset($_POST['mail_compte']) && $_POST['mail_compte']==1)
	{
				if( $_POST['mail_jeece']!="") $mail =  $_POST['mail_jeece'];
		else $mail =  $_POST['mail'];
if(preg_match("#@(hotmail|live|msn).[a-z]{2,4}$#", $to))
{
	$passage_ligne = "\n";
}
else
{
	$passage_ligne = "\r\n";
}
		
$headers = "From: \"Thibault DEMARQUAY\"<thibaultdemarquay@gmail.com>".$passage_ligne;
		
	$headers= $headers."Reply-to: \"Thibault DEMARQUAY\" <thibaultdemarquay@gmail.com>".$passage_ligne; 
$headers = $headers.'Mime-Version: 1.0'.$passage_ligne;
$headers= $headers.'Content-type: text/html; charset=utf-8'.$passage_ligne;


		$message = "Bonjour,<br /><br />Voici vos informations de connexion pour l'intranet JEECE :<br/>Identifiant : ".$mail."<br />Mot de pase : ".$_POST['mdp']."<br/><br />Lien Intranet : <a href='demarquay.fr/jeece'>Lien</a><br/><br/>Jeecement,";
		$sujet = "[JEECE] Création de votre compte Intranet";
mail($mail,$sujet,$message,$headers);
	}
	}
	else
	echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4>Ce membre existe déjà !</h4>';
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>[JEECE] Gestion RH</title>
<script type="text/javascript" src="jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="jquery.dataTables.js"></script>
<script type="text/javascript" src="../generation/js/calendar.js"></script>
<script type="text/javascript" src="script.js"></script>
<script type="text/javascript" src="dataTables.colVis.js"></script>
<script type="text/javascript" src="dataTables.colReorder.js"></script>
<script type="text/javascript" src="dataTables.tableTools.js"></script>

<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
<link rel="Stylesheet" type="text/css" href="../generation/css/calendar.css" />
<link rel="Stylesheet" type="text/css" href="css/jquery.dataTables.css" />
<link rel="Stylesheet" type="text/css" href="css/dataTables.colVis.css" />
<link rel="Stylesheet" type="text/css" href="css/dataTables.colReorder.css" />
<link rel="Stylesheet" type="text/css" href="css/dataTables.tableTools.css" />
<link rel="Stylesheet" type="text/css" href="css/style.css" />
</head>

<body align="center">
<a href="../">
<h3 align="left"> Retour Accueil</h3>
</a>
<h2 align="center"> Gestion des membres</h2>
    <fieldset style="width:50px;margin-left: auto;margin-right: auto;">
      <legend>Année</legend>
      <select name="annee" id="annee_id" size="1" onchange="majAnnee()" >
        <OPTION value="toutes">Toutes
        <?php  for($i=date("Y");$i>1985;$i--)
		{?>
        <OPTION <?php  if ((date("m")>6 && $i==date("Y")) || (date("m")<6 && $i==(date("Y")-1))) echo "selected";?> value=<?php echo $i; ?> ><?php echo $i."/".($i+1); ?>
        <?php } ?>
      </select>
      </fieldset><br />
<table class="display" id="example" align="center" border="1" cellspacing="0" cellpadding="0" style="width:90%">
  <thead>
    <tr>
    
      <td>Nom</td>
      <td>Prénom</td>
      <td>Année</td>
      <td>Adresse</td>
      <td>Code Postal</td>
      <td>Ville</td>
      <td>Mail</td>
      <td>Mail JEECE</td>
      <td>Tel</td>
      <td>Promo</td>
      <td>Bureau</td>
      <td>CA</td>
      <td>Poste</td>
      <td>Intervenant</td>
      <td>Date CE</td>
      <td>Ref CE</td>
      <td>Dossier Etudiant Complet</td>
      <td>CE signée</td>
      <td>Carte Identité</td>
      <td>Carte Vitale</td>
      <td>Carte Etudiant</td>
      <td>Chèque</td>
      <td>Mot de Passe</td>
      <td>CE</td>
      <td>Modifier</td>
      <td>Supprimer</td>
    </tr>
  </thead>
  <tbody>
    <?php
		$reponse = $bdd->query('SELECT * FROM rh_annee,rh WHERE rh_annee.membre=rh.id');
		// On affiche chaque entrée une à une
		while ($donnees = $reponse->fetch())
		{?>
    <tr>
      <td><?php echo $donnees['nom']; ?></td>
      <td><?php echo $donnees['prenom']; ?></td>
      <td><?php echo $donnees['annee']; ?></td>
      <td><?php echo $donnees['adresse']; ?></td>
      <td><?php echo $donnees['cp']; ?></td>
      <td><?php echo $donnees['ville']; ?></td>
      <td><?php echo $donnees['email']; ?></td>
      <td><?php echo $donnees['email_jeece']; ?></td>
      <td><?php echo wordwrap($donnees['tel'],2," ",1); ?></td>
      <td><?php echo $donnees['promotion']; ?></td>
      <td><?php if($donnees['bureau']==1) echo "<img alt='1' src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg' alt='0'></img>" ?></td>
      <td><?php if($donnees['ca']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php echo $donnees['poste']; ?></td>
      <td><?php if($donnees['intervenant']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php 	if($donnees["date_ce"]=="0000-00-00") echo "";
	else echo date('d/m/Y',strtotime($donnees['date_ce'])); ?></td>
      <td><?php echo $donnees['ref_ce']; ?></td>
      <td><?php if($donnees['cheque']==1 && $donnees['ce_signee']==1 && $donnees['cni']==1 && $donnees['carte_vitale']==1 && $donnees['carte_etudiant']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if($donnees['ce_signee']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
            <td><?php if($donnees['cni']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
                  <td><?php if($donnees['carte_vitale']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
                        <td><?php if($donnees['carte_etudiant']==1) echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
      <td><?php if($donnees['cheque']==1)  echo "<img src='images/oui.jpg'></img>"; else echo "<img src='images/non.jpg'></img>" ?></td>
            <td><input type="submit" style="width:100px" value="Réinitialiser" onClick="window.location.href = 'index.php?reinitialiser=<?php echo $donnees['id']; ?>';"/></td>
      <td><input type="submit" style="width:100px" value="CE" onClick="
      verifCE('<?php echo $donnees['date_ce'].'\',\''.$donnees['nom'].'\',\''.$donnees['prenom'].'\',\''.addslashes($donnees['adresse']).'\',\''.$donnees['cp'].'\',\''.addslashes($donnees['ville']).'\','.$donnees['id'] ?>);"/></td>
      <td><input type="submit" style="width:100px" value="Modifier" onClick="window.location.href = 'ajout.php?modifier=<?php echo $donnees['id']; ?>';"/></td>
      <td><input type="submit" style="width:100px" value="Supprimer" onClick="if(confirm('Etes vous sur ? Cela va supprimer le membre ainsi que ses mandats!'))window.location.href = 'index.php?supprimer=<?php echo $donnees['id']; ?>';"/></td>
    </tr>
    <?php
		}?>
  </tbody>
</table>
<br /> <br />
<center><input type="button" align="center" style="width:200px;height:50px "  value="Nouveau Membre" onClick="window.location.href = 'ajout.php'"/></center>
</body>
