function majD()
{
		//Société/particulier
	var form=document.getElementById("formD");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("nomContactDivD").style.display="inline";
	document.getElementById("nomClientLabelD").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelD").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelD").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelD").innerHTML = "Ville de la Société";
	form.nom_contact.required = true;
	}
	else
	{
	document.getElementById("nomContactDivD").style.display="none";
	document.getElementById("nomClientLabelD").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelD").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelD").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelD").innerHTML = "Ville du Client";
		form.nom_contact.required = false;
	}  
}