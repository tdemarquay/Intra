<?php

function verifCE($date,$nom, $prenom, $adresse, $cp, $ville, $id)
{
	include("../php/connexion.php");
	$return="";
	$reponse = $bdd->query('SELECT * FROM rh WHERE  AND id='.$id);
	//$reponse->execute();
	$prenom="";
	$nom="";
	while ($donnees = $reponse->fetch())
	{
		$prenom = $donnees["prenom"];
		$nom = $donnees["nom"];
	}
	
	if(count($donnees)==0)
	return "";
	else {
		
		return $prenom." ".$nom;
	}
	
	
}


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

if(isset($_GET['president']) && isset ($_GET['annee']))
	echo json_encode(president(str_replace(".", "/", $_GET['annee'])));


if(isset($_GET['tresorier']) && isset ($_GET['annee']))
	echo json_encode(tresorier(str_replace(".", "/", $_GET['annee'])));
?>