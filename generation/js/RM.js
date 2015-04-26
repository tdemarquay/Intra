function majRM(date)
{
	var form=document.getElementById("formRM");
				if(!form.date_rm.validity.patternMismatch && !form.date_rm.validity.valueMissing && date=="date_rm")
			{
				jeh_bas = parseInt(get_parametre(form.date_rm.value,"jeh_bas"));
				jeh_haut = parseInt(get_parametre(form.date_rm.value,"jeh_haut"));
				taux = parseInt(get_parametre(form.date_rm.value,"taux_renumeration_rm")*100);	
			}
			else if(date=="date_rm")
			{
				jeh_bas = "(Saisir date avant)";
				jeh_haut = "(Saisir date avant)";
taux = "(Saisir date avant)";
			}
	
	
	
	form.renumeration_brute_cdp.setAttribute("tooltipText","Rénumération brute de l'étudiant. C'est la somme du montant de tous les JEH de l'étudiant multiplié par "+ taux+"%.");
	
	
		var dateRm = new Date( form.date_rm.value[6]+form.date_rm.value[7]+form.date_rm.value[8]+form.date_rm.value[9],  parseInt(form.date_rm.value[3]+form.date_rm.value[4])-1, form.date_rm.value[0]+form.date_rm.value[1]);
	var dateFinEtude = new Date( form.date_fin_theorique_etude.value[6]+form.date_fin_theorique_etude.value[7]+form.date_fin_theorique_etude.value[8]+form.date_fin_theorique_etude.value[9],   parseInt(form.date_fin_theorique_etude.value[3]+form.date_fin_theorique_etude.value[4])-1, form.date_fin_theorique_etude.value[0]+form.date_fin_theorique_etude.value[1]);
	
	if(dateRm > dateFinEtude)
		   {
			   form.date_fin_theorique_etude.setCustomValidity("La date de fin d'étude ne peut être avant la date de signature");
		   }
		    else
			{
							   	form.date_fin_theorique_etude.setCustomValidity("");
			}
			

			
				//On vérifie le nombre de JEH et le montant de la mission
		
	
	if(form.renumeration_brute_cdp.valueAsNumber>(form.nombre_jeh_cdp.valueAsNumber*jeh_haut))
	form.renumeration_brute_cdp.setCustomValidity("Pour "+form.nombre_jeh_cdp.valueAsNumber+" JEH, la rénumération ne peut pas être de " + form.renumeration_brute_cdp.valueAsNumber+"€. Le max pour un JEH (à cette date) est de "+jeh_haut+"€.");
	else
	form.renumeration_brute_cdp.setCustomValidity("");
}// JavaScript Documen

