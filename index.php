<?php
session_start();
include("generation/php/connexion.php");




function genererMDP ($longueur = 8){
    // initialiser la variable $mdp
    $mdp = "";
 
    // Définir tout les caractères possibles dans le mot de passe, 
    // Il est possible de rajouter des voyelles ou bien des caractères spéciaux
    $possible = "2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
 
    // obtenir le nombre de caractères dans la chaîne précédente
    // cette valeur sera utilisé plus tard
    $longueurMax = strlen($possible);
 
    if ($longueur > $longueurMax) {
        $longueur = $longueurMax;
    }
 
    // initialiser le compteur
    $i = 0;
 
    // ajouter un caractère aléatoire à $mdp jusqu'à ce que $longueur soit atteint
    while ($i < $longueur) {
        // prendre un caractère aléatoire
        $caractere = substr($possible, mt_rand(0, $longueurMax-1), 1);
 
        // vérifier si le caractère est déjà utilisé dans $mdp
        if (!strstr($mdp, $caractere)) {
            // Si non, ajouter le caractère à $mdp et augmenter le compteur
            $mdp .= $caractere;
            $i++;
        }
    }
 
    // retourner le résultat final
    return $mdp;
}

if(isset($_GET['deconnexion']))
{
	unset($_SESSION['mail']);
unset($_SESSION['id']);
header("location: index.php");
}

else if(isset($_POST['mdp']))
{
			// Hachage du mot de passe
	$pass_hache = sha1($_POST['mdp']);

	
	if ( get_magic_quotes_gpc() ) $mail = stripslashes($_POST['mail']); 
else  $mail = $_POST['mail']; 
	
	
	
	// Vérification des identifiants
	$req = $bdd->prepare('SELECT id FROM rh WHERE (email = :mail OR (email_jeece = :mail AND email_jeece <> ""))  AND mdp = :mdp AND compte=1');
	$req->execute(array(
		'mail' => $mail,
		'mdp' => $pass_hache));
	
	
	$resultat = $req->fetch();
	
	if (!$resultat)
	{
		header("location: index.php?error=1");
	}
	else
	{
		$id = $resultat['id'];

			$req2 = $bdd->query('SELECT * FROM rh_annee WHERE membre='.$id.' AND (annee=\''.(date("Y")-1).'/'.(date("Y")).'\' OR annee=\''.(date("Y")).'/'.(date("Y")+1).'\')');

			
			
			
			$_SESSION['ca'] = 0;
			$_SESSION['bureau'] = 0;
			
			while($resultat2 = $req2->fetch())
			{
		if(!$resultat2)
		{
				

			header("location: index.php?error=2");	
				
			
		}
		else
		{
$_SESSION['id'] = $id;

			$_SESSION['mail'] = $mail;
			if($resultat2['ca']==1) $_SESSION['ca'] = $resultat2['ca'];
			if($resultat2['bureau']==1)$_SESSION['bureau'] = $resultat2['bureau'];
			
		}
			}
		header("location: index.php");	
	
	}
}


else if(isset($_SESSION['id']) && isset($_SESSION['mail'])  && !empty($_SESSION['id']))
{ 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>[JEECE] Intranet</title>
	<link rel="Stylesheet" type="text/css" href="css/index.css" />
	</head>

<body style="" >
		<h1 align="center"><img src="jeece.png" width="400" height="76"  alt=""/></h1>
<a href="index.php?deconnexion=1"><h3 align="right"> Déconnexion</h3></a>
<a href="rh/compte.php?modifier=1"><h3 align="right"> Mon compte</h3></a>
		
        <fieldset style="background-color:rgba(255, 255, 255, 0.3);">
        <legend><b><h2 >Etudes</h2></b></legend>
		<label><a href="generation"><h3 align="center"> Génération de documents</h3></a></label>
		<?php if($_SESSION['ca']==1 || $_SESSION['bureau']==1) { ?><label><a href="generation/parametres_docs_types.php"><h3 align="center"> Paramètres Docs Types</h3></a></label>
		<label><a href="generation/gestion_docs_types.php"><h3 align="center"> Gestion Docs Types</h3></a></label><?php } ?>
        <label><a  target="_blank" href="https://docs.google.com/spreadsheet/ccc?key=0AiCwFFbWHKrJdGV4eXlOTDVrRWZHelhKNUNlZGFaV0E&usp=sharing#gid=6"><h3 align="center"> Gdoc Suivi d'études</h3></a></label>
        </fieldset>
        <br/>
        <fieldset style="background-color:rgba(255, 255, 255, 0.3);">
        <legend><b><h2>Ressources Humaines</h2></b></legend>
		<?php if($_SESSION['ca']==1 || $_SESSION['bureau']==1) { ?><label><a href="rh"><h3 align="center"> Gestion des membres</h3></a></label><?php } ?>
        <label><a href="rh/membres.php"><h3 align="center"> Liste des membres</h3></a></label>
        <label><a href="rh/intervenants.php"><h3 align="center"> Liste des intervenants</h3></a></label>
        <label><a  target="_blank" href="rh/signature.php"><h3 align="center"> Ma Signature JEECE</h3></a></label>
        </fieldset>
                <fieldset style="">
        <legend><b><h2>Ressources</h2></b></legend>
        <label><a  target="_blank" href="http://wiki.jeece.fr/"><h3 align="center"> Wiki JEECE</h3></a></label>
        <label><a  target="_blank" href="http://kiwi.junior-entreprises.com"><h3 align="center"> Kiwi (CNJE)</h3></a></label>
        <label><a  target="_blank" href="http://cloud.jeece.fr/"><h3 align="center"> Owncloud (Stockage Fichiers)</h3></a></label>
        </fieldset>
<fieldset style="background-color:rgba(255, 255, 255, 0.3);">
        <legend><b><h2>Réseaux sociaux</h2></b></legend>
		<label><a  target="_blank" href="https://www.facebook.com/JEECE.JE"><h3 align="center"> Page Facebook</h3></a></label>
        <label><a  target="_blank" href="https://www.facebook.com/groups/297067937061813/"><h3 align="center"> Groupe Facebook</h3></a></label>
        <label><a   target="_blank" href="https://plus.google.com/+JeeceFr/posts"><h3 align="center"> Page Google+</h3></a></label>
        <label><a  target="_blank" href="https://twitter.com/JuniorJEECE"><h3 align="center"> Twitter</h3></a></label>
                <label><a href="https://www.linkedin.com/company/jeece"><h3 align="center"> Page Linkedin</h3></a></label>
        <label><a  target="_blank" href="http://fr.viadeo.com/fr/profile/junior.jeece"><h3 align="center"> Viadeo</h3></a></label>
                <label><a target="_blank" href="https://www.youtube.com/user/JuniorJEECE"><h3 align="center"> Youtube</h3></a></label>
        <label><a target="_blank" href="http://talents.je/junior-entreprise/989/jeece"><h3 align="center"> Talents.je</h3></a></label>
        </fieldset>
		<br />
	</body>
</html>
<?php } 
else if(isset($_GET['oublie']))
{?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>[JEECE] Intranet</title>
	<link rel="Stylesheet" type="text/css" href="css/index.css" />
	</head>
    

    
        <center> 
        <h1 align="center"><img src="jeece.png" width="400" height="76"  alt=""/></h1>
    <h2>Mot de passe oublié</h2>
    <form action="index.php" method="post" >
    <table border="0" width="70%">
    <tr>
    <td><center>Adresse mail (JEECE ou perso) : </center></td>
    <td><center><input type="hidden" name="oublie"/>
    <input type="email" placeholder="prenom.nom@jeece.fr" name="mail" required/><center></td>
    </tr>
    </table>
    <br /><br /><input type="submit" value="Valider" />
    </form>
    </center>
<?php }
else if(!isset($_SESSION['id']) ||   $_SESSION['id']=="")
{ 

if(isset($_GET['error']) && $_GET['error']==1)
echo "<center><b> Erreur, email ou mot de passe incorrect</b></center>";
else if(isset($_GET['error']) && $_GET['error']==2)
echo "<center><b> Vous n'êtes pas connectés !</b></center>";


	if(isset($_POST['oublie']))
	{
			

	$reponse = $bdd->query('SELECT * FROM rh WHERE email=\''.$_POST['mail'].'\' OR email_jeece=\''.$_POST['mail'].'\'' );
		// On affiche chaque entrée une à une
		$mail = $_POST['mail'];
		$donnees = $reponse->fetch();
		$mdp = genererMDP();
if(!$donnees)echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4 align="center">  Email non trouvé</h4>';
else if ($donnees['compte']==0)
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4 align="center">  Compte inactif, envoyez un mail à dsi@jeece.fr</h4>';
else
{
						$reponse = $bdd->exec("UPDATE rh SET mdp='".sha1($mdp)."' WHERE id=".$donnees['id']);
	
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
echo '<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><h4 align="center">  Mot de passe envoyé par mail</h4>';
	}
	}
	

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>[JEECE] Intranet</title>
	<link rel="Stylesheet" type="text/css" href="css/index.css" />
	</head>
        <center> 
        <h1 align="center"><img src="jeece.png" width="400" height="76"  alt=""/></h1>
    <h2>Merci de vous authentifier</h2>
    <form action="index.php" method="post" >
    <table border="0" width="70%">
    <tr>
    <td><center>Adresse mail (JEECE ou perso) : </center></td>
    <td><center><input type="email" placeholder="prenom.nom@jeece.fr" name="mail" required/><center></td>
    </tr>
    <tr>
    <td><center>Mot de passe : </center></td>
    <td><center><input placeholder="Mot de Passe" type="password" required name="mdp"
    /></center></td>
    </tr>
    </table>
    <a href="index.php?oublie=1">Mot de passe  oublié</a>
    <br /><br /><input type="submit" value="Valider" />
    </form>
    </center>
<?php }?>