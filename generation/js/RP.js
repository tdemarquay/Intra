function majRP()
{
		//Société/particulier
	var form=document.getElementById("formRP");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("nomContactDivRP").style.display="inline";
	document.getElementById("nomClientLabelRP").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelRP").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelRP").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelRP").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelRP").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelRP").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	}
	else
	{
	document.getElementById("nomContactDivRP").style.display="none";
	document.getElementById("nomClientLabelRP").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelRP").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelRP").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelRP").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelRP").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelRP").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	}  
}