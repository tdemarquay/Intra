
function majAP()
{
	//Société/particulier
	var form=document.getElementById("formAP");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("qualiteContactDivAP").style.display="inline";
	document.getElementById("nomContactDivAP").style.display="inline";
	document.getElementById("nomClientLabelAP").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelAP").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelAP").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelAP").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelAP").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelAP").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	form.qualite_contact.required = true;
	}
	else
	{
			document.getElementById("qualiteContactDivAP").style.display="none";
	document.getElementById("nomContactDivAP").style.display="none";
	document.getElementById("nomClientLabelAP").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelAP").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelAP").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelAP").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelAP").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelAP").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	form.qualite_contact.required = false;
	}  
}
