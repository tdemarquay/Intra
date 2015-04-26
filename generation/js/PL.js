
function majPL()
{
	//Société/particulier
	var form=document.getElementById("formPL");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("qualiteContactDivPL").style.display="inline";
	document.getElementById("nomContactDivPL").style.display="inline";
	document.getElementById("nomClientLabelPL").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelPL").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelPL").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelPL").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelPL").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelPL").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	form.qualite_contact.required = true;
	}
	else
	{
			document.getElementById("qualiteContactDivPL").style.display="none";
	document.getElementById("nomContactDivPL").style.display="none";
	document.getElementById("nomClientLabelPL").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelPL").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelPL").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelPL").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelPL").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelPL").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	form.qualite_contact.required = false;
	}  
	
	
	var datePl = new Date( form.date_pl.value[6]+form.date_pl.value[7]+form.date_pl.value[8]+form.date_pl.value[9],  parseInt(form.date_pl.value[3]+form.date_pl.value[4])-1, form.date_pl.value[0]+form.date_pl.value[1]);
	var dateFinPl = new Date( form.date_fin_pl.value[6]+form.date_fin_pl.value[7]+form.date_fin_pl.value[8]+form.date_fin_pl.value[9],   parseInt(form.date_fin_pl.value[3]+form.date_fin_pl.value[4])-1, form.date_fin_pl.value[0]+form.date_fin_pl.value[1]);
	
	if(datePl > dateFinPl)
		   {
			   form.date_fin_pl.setCustomValidity("La date de fin du prêt ne peut être avant la date de signature");
		   }
		    else
			{
							   	form.date_fin_pl.setCustomValidity("");
			}
}
