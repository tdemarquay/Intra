<?php
if(session_id() == "")session_start();
if(!isset($_SESSION['id']))
header("location: ../index.php?error=2");

include("php/connexion.php");
$reponse = $bdd->query('SELECT * FROM rh WHERE id='.$_SESSION['id']);

$resultat = $reponse->fetch();

if(!$resultat) echo "Erreur, Membre introuvable";
else
{
	if($resultat["email_jeece"]=="")
	$mail = $resultat["email"];
	else $mail = $resultat["email_jeece"];
	
	
	
	if(date("m") <6)
			$reponse2 = $bdd->query('SELECT * FROM rh_annee WHERE membre='.$_SESSION['id'].' AND annee=\''.(date("Y")-1).'/'.(date("Y")).'\'');
			else
			$reponse2 = $bdd->query('SELECT * FROM rh_annee WHERE membre='.$_SESSION['id'].' AND annee=\''.date("Y").'/'.(date("Y")+1).'\'');
			
			$resultat2 = $reponse2->fetch();
			
			if(!$resultat2)
			{
				$poste="";
			}
			else
			{
				$poste=$resultat2["poste"];
			}


		

			
			


?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Signature JEECE</title>
</head>

<body>
<a href="../">
<h3 align="left"> Retour Accueil</h3>
</a>
Pour utiliser cette signature, il vous suffit de la copier dans l'espace dédié sur votre compte Mail.
<br /><br /><br />
 <!-- Frame of the signature -->
    <table align="left" bgcolor="#F5F5F5" border="" cellpadding="0" cellspacing="0" frame="void" rules="none" width="495px" style="float:left; background-color:#F5F5F5; width:495px; text-overflow: ellipsis; padding-top:0; padding-right:0; padding-bottom:0; padding-left:0; border-spacing:0; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:0; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:transparent; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent; box-shadow: 0px 3px 10px 0px #BDBDBC; -moz-box-shadow: 0px 3px 10px 0px #BDBDBC; -webkit-box-shadow: 0px 3px 10px 0px #BDBDBC;">
    
        <!-- Logo + personnal infos -->
        <tr align="center" bgcolor="transparent" valign="baseline" style="float:center; background:inherit; vertical-align:baseline;">
        
            <td align="center" bgcolor="transparent" height="100%" valign="baseline" width="100%" style="float:none; background-color:inherit; height:auto; text-align:center; vertical-align:baseline; white-space:inherit; width:100%; padding-top:0; padding-right:0; padding-bottom:5px; padding-left:0; border-spacing:0; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:0; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:transparent; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent;">
            
  
                <!-- Second frame -->
                <table align="center" bgcolor="#F5F5F5" border="" cellpadding="0" cellspacing="0" frame="void" rules="none" width="100%" style="float:center; background-color:#F5F5F5; width:100%; padding-top:0; padding-right:0; padding-bottom:0; padding-left:0; border-spacing:0; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:0; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:transparent; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent;">
                
                    <tr align="center" bgcolor="transparent" valign="baseline" style="float:center; background:inherit; vertical-align:baseline;">
                    
                        <!-- Logo -->
                        <td align="center" bgcolor="transparent" height="85px" valign="baseline" width="85px" style="float:none; background-color:inherit; height:85px; text-align:center; vertical-align:baseline; white-space:inherit; width:85px; padding-top:12px; padding-right:0; padding-bottom:0; padding-left:15px; border-spacing:0; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:0; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:transparent; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent;">

                            <img align="middle" alt="JEECE" border="0" height="85" width="85" hspace="0" src="http://campus.jeece.fr/images/Logos/JEECE/Logo_feuille_JEECE_inner_shadowed_170x150.png" title="Aller sur www.jeece.fr"    />

                        </td>
                        
                        <!-- Personnal infos -->
                        <td align="left" bgcolor="transparent" height="100%" valign="top" width="100%" style="float:none; background-color:inherit; height:85px; text-align:left; vertical-align:top; white-space:inherit; width:100%; padding-top:10px; padding-right:0; padding-bottom:0; padding-left:15px; border-spacing:0; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:0; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:transparent; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent;">

                            <span style="color:black; direction:ltr; font-family:verdana, sans-serif; font-style:normal; font-size:10.5pt; font-variant:normal; font-weight:normal; letter-spacing:normal; line-height:normal; text-decoration:none; text-indent:0; text-transform:none; vertical-align:inherit; white-space:normal; word-spacing:normal;">
                                <span style="font-size:12pt; font-weight:bold; color:#138E00"><?php echo $resultat["prenom"] .' '.$resultat["nom"]  ?></span><br />
                                <span style="font-size:10pt;"><?php echo $poste; ?></span><br />
                                Junior-Entreprise de l'ECE Paris<br />
                                <img align="top" alt="" src="http://campus.jeece.fr/images/Ressources/SignatureElectronique/Enveloppe.png"  width="17"  />&nbsp;
                                <a href="mailto:<?php echo $mail; ?>? &subject=[JEECE]%20Objet%20de%20votre%20mail. &body=Votre%20message." rel="nofollow" target="_blank" title="Envoyez-moi un mail !" style="color:blue; font-size:10.5pt;"><?php echo $mail; ?></a><br />
                                <img align="top" alt="" border="0" height="15px" hspace="0" src="http://campus.jeece.fr/images/Ressources/SignatureElectronique/Telephone.png" vspace="0" width="17px" style="float:none; height:15px; text-align:center; vertical-align:middle; width:17px; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:0; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:transparent; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent;" />&nbsp;
                                <?php echo wordwrap($resultat["tel"],2," ",1); ?><br />
                            </span>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <!-- General infos -->
        <tr align="center" bgcolor="transparent" valign="baseline" style="float:center; background:inherit; vertical-align:baseline;">
        
            <td align="left" bgcolor="transparent" height="100%" valign="baseline" width="100%" style="float:none; background-color:inherit; height:auto; text-align:left; vertical-align:baseline; white-space:inherit; width:100%; padding-top:3px; padding-right:0; padding-bottom:12px; padding-left:15px; border-spacing:0; border-top-style:none; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:0; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:transparent; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent;">
            
                <div style="clear:none; display:block; height:auto; float:none; position:static; text-align:left; width:465px; padding-top:5px; padding-right:0; padding-bottom:0; padding-left:0; border-top-style:solid; border-right-style:none; border-bottom-style:none; border-left-style:none; border-top-width:1px; border-right-width:0; border-bottom-width:0; border-left-width:0; border-top-color:color; border-right-color:transparent; border-bottom-color:transparent; border-left-color:transparent;"></div>

                <a href="https://www.facebook.com/JEECE.JE" rel="publisher" target="_blank" title="Rejoignez-nous sur Facebook !" style="color:transparent;"><img align="top" alt="F"  height="18"  src="http://campus.jeece.fr/images/ReseauxSociaux/Facebook.png" width="18"  /></a>&nbsp;
                <a href="https://twitter.com/JuniorJEECE" rel="publisher" target="_blank" title="Rejoignez-nous sur Twitter !" style="color:transparent;"><img align="top" alt="T" height="18"  src="http://campus.jeece.fr/images/ReseauxSociaux/Twitter.png" width="18" /></a>&nbsp;
                <a href="https://plus.google.com/106376338307875330368/posts" rel="publisher" target="_blank" title="Rejoignez-nous sur Google+ !" style="color:transparent;"><img align="top" alt="G+" height="18" src="http://campus.jeece.fr/images/ReseauxSociaux/Google.png" width="18"  /></a>&nbsp;
                <a href="http://www.linkedin.com/company/jeece" rel="publisher" target="_blank" title="Rejoignez-nous sur LinedIn !" style="color:transparent;"><img align="top" alt="L" height="18" src="http://campus.jeece.fr/images/ReseauxSociaux/LinkedIn.png" width="18"  /></a>&nbsp;
                <a href="http://fr.viadeo.com/fr/profile/junior.jeece" rel="publisher" target="_blank" title="Rejoignez-nous sur Viadeo !" style="color:transparent;"><img align="top" alt="V" height="18" src="http://campus.jeece.fr/images/ReseauxSociaux/Viadeo.png" width="18"/></a>&nbsp;
                <a href="http://www.youtube.com/user/JuniorJEECE" rel="publisher" target="_blank" title="Rejoignez-nous sur YouTube !" style="color:transparent;"><img align="top" alt="Y" height="18" src="http://campus.jeece.fr/images/ReseauxSociaux/YouTube.png" width="18" /></a>&nbsp;
            <span style="color:black; direction:ltr; font-family:arial, sans-serif; font-style:normal; font-size:10.5pt; font-variant:normal; font-weight:normal; letter-spacing:normal; line-height:normal; text-decoration:none; text-indent:0; text-transform:none; vertical-align:inherit; white-space:normal; word-spacing:normal;">
            <a href="mailto:contact@jeece.fr? &bcc=dsi@jeece.fr &subject=[JEECE]%20Objet%20de%20votre%20mail. &body=Votre%20message." rel="nofollow" target="_blank" title="Envoyez-nous un mail !" style="color:blue; font-size:10.5pt;">contact@jeece.fr</a> | 01 45 49 19 99 | <a href="http://www.jeece.fr" rel="start" target="_blank" title="Aller sur www.jeece.fr" style="color:blue;">www.jeece.fr</a></span>

            </td>
        </tr>
    </table><br /><br />
</body>
</html><?php } ?>