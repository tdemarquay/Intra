<?php
try
{
 // On se connecte à MySQL
   $bdd = new PDO('localhost', '', '');
 $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}
catch(Exception $e)
{
 // En cas d'erreur, on affiche un message et on arrête tout
 die('Erreur : '.$e->getMessage());
}

?>