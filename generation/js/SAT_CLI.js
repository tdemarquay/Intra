function majSAT_CLI()
{
		//Société/particulier
	var form=document.getElementById("formSAT_CLI");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("nomContactDivSAT_CLI").style.display="inline";
	document.getElementById("nomClientLabelSAT_CLI").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelSAT_CLI").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelSAT_CLI").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelSAT_CLI").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelSAT_CLI").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelSAT_CLI").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	}
	else
	{
	document.getElementById("nomContactDivSAT_CLI").style.display="none";
	document.getElementById("nomClientLabelSAT_CLI").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelSAT_CLI").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelSAT_CLI").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelSAT_CLI").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelSAT_CLI").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelSAT_CLI").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	}  
}