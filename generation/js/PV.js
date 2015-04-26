function majPV()
{
	
		//Société/particulier
	var form=document.getElementById("formPV");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("qualiteContactDivPV").style.display="inline";
	document.getElementById("nomContactDivPV").style.display="inline";
	document.getElementById("nomClientLabelPV").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelPV").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelPV").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelPV").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelPV").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelPV").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	form.qualite_contact.required = true;
	}
	else
	{
			document.getElementById("qualiteContactDivPV").style.display="none";
	document.getElementById("nomContactDivPV").style.display="none";
	document.getElementById("nomClientLabelPV").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelPV").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelPV").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelPV").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelPV").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelPV").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	form.qualite_contact.required = false;
	}  
	
			if(form.lot_recette.value=="lot")
	{
		document.getElementById("lotDiv").style.display="inline";
		form.nom_phase.required=true;
	}
	else
	{
		document.getElementById("lotDiv").style.display="none";
		form.nom_phase.required=false;
	}
}