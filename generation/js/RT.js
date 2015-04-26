function majRT()
{
		//Société/particulier
	var form=document.getElementById("formRT");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("nomContactDivRT").style.display="inline";
	document.getElementById("nomClientLabelRT").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelRT").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelRT").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelRT").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelRT").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelRT").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	}
	else
	{
	document.getElementById("nomContactDivRT").style.display="none";
	document.getElementById("nomClientLabelRT").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelRT").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelRT").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelRT").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelRT").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelRT").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	}  
}