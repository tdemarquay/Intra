
function majAC(date)
{
	var form=document.getElementById("formAC");
					if(!form.date_ac.validity.patternMismatch && !form.date_ac.validity.valueMissing && date=="date_ac")
			{
				 jeh_bas = parseInt(get_parametre(form.date_ac.value,"jeh_bas"));
				 jeh_haut = parseInt(get_parametre(form.date_ac.value,"jeh_haut"));

			}
			else if(date=="date_ac")
			{
				 jeh_bas = "(Saisir date avant)";
				jeh_haut = "(Saisir date avant)";

			}
	//Société/particulier
	
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("qualiteContactDivAC").style.display="inline";
	document.getElementById("nomContactDivAC").style.display="inline";
	document.getElementById("nomClientLabelAC").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelAC").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelAC").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelAC").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelAC").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelAC").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	form.qualite_contact.required = true;
	}
	else
	{
			document.getElementById("qualiteContactDivAC").style.display="none";
	document.getElementById("nomContactDivAC").style.display="none";
	document.getElementById("nomClientLabelAC").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelAC").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelAC").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelAC").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelAC").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelAC").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	form.qualite_contact.required = false;
	}  
	
	
	if(form.modification_budget.checked==true)
	{
		document.getElementById("budgetModifieDiv").style.display="inline";
		form.ht_ac.required=true;
		form.nombre_jeh_ac.required=true;
		form.numero_devis_ac.required=true;
	}
	else
	{
		document.getElementById("budgetModifieDiv").style.display="none";
		form.ht_ac.required=false;
		form.nombre_jeh_ac.required=false;
		form.numero_devis_ac.required=false;
	}
	
	if(form.modification_delai.checked==true)
	{
		document.getElementById("delaiModifieDiv").style.display="inline";
		form.date_fin_theorique_ac.required=true;
	}
	else
	{
		document.getElementById("delaiModifieDiv").style.display="none";
		form.date_fin_theorique_ac.required=false;
	}
	
	if(form.modification_delai.checked==false && form.modification_budget.checked==false)
	{
		form.modification_delai.setCustomValidity("L'avenant doit forcément changer le délai et/ou le budget");
	}
	else
	{
		form.modification_delai.setCustomValidity("");
	}
	
	
			var dateAc = new Date( form.date_ac.value[6]+form.date_ac.value[7]+form.date_ac.value[8]+form.date_ac.value[9],  parseInt(form.date_ac.value[3]+form.date_ac.value[4])-1, form.date_ac.value[0]+form.date_ac.value[1]);
	var dateFinEtude = new Date( form.date_fin_theorique_ac.value[6]+form.date_fin_theorique_ac.value[7]+form.date_fin_theorique_ac.value[8]+form.date_fin_theorique_ac.value[9],   parseInt(form.date_fin_theorique_ac.value[3]+form.date_fin_theorique_ac.value[4])-1, form.date_fin_theorique_ac.value[0]+form.date_fin_theorique_ac.value[1]);
	var dateCc = new Date( form.date_cc.value[6]+form.date_cc.value[7]+form.date_cc.value[8]+form.date_cc.value[9],  parseInt(form.date_cc.value[3]+form.date_cc.value[4])-1, form.date_cc.value[0]+form.date_cc.value[1]);
	
	if(dateCc > dateAc)
		   {
			   form.date_cc.setCustomValidity("La date de la CC ne peut-être après la date de signature");
		   }
		    else
			{
							   	form.date_cc.setCustomValidity("");
			}
				if(dateFinEtude < dateAc && form.modification_delai.checked==true)
		   {
			   form.date_fin_theorique_ac.setCustomValidity("La date de fin de mission ne peut être avant la date de signature");
		   }
		    else
			{
							   	form.date_fin_theorique_ac.setCustomValidity("");
			}
			
			
		if(form.ht_ac.valueAsNumber>(form.nombre_jeh_ac.valueAsNumber*jeh_haut) && form.modification_budget.checked==true)
	form.ht_ac.setCustomValidity("Pour "+form.nombre_jeh_ac.valueAsNumber+" JEH, le montant HT (sans les frais) ne peut pas être de " + form.ht_ac.valueAsNumber+"€. Le max pour un JEH (à cette date) est de "+jeh_haut+"€.");
	else if(form.ht_ac.valueAsNumber<(form.nombre_jeh_ac.valueAsNumber*jeh_bas) && form.modification_budget.checked==true)
	form.ht_ac.setCustomValidity("Pour "+form.nombre_jeh_ac.valueAsNumber+" JEH, le montant HT (sans les frais) ne peut pas être de " + form.ht_ac.valueAsNumber+"€. Le min pour un JEH (à cette date) est de "+jeh_bas+"€.");
	else
	form.ht_ac.setCustomValidity("");
}