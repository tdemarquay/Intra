function majARM(date)
 {
	 	var form=document.getElementById("formARM");
				if(!form.date_arm.validity.patternMismatch && !form.date_arm.validity.valueMissing && date=="date_arm")
			{
				jeh_haut = parseInt(get_parametre(form.date_arm.value,"jeh_haut"));
				taux = parseInt(get_parametre(form.date_arm.value,"taux_renumeration_rm")*100);	
			}
			else if(date=="date_arm")
			{
				jeh_haut = "(Saisir date avant)";
taux = "(Saisir date avant)";
			}
			
				form.nouvelle_indemnisation_arm.setAttribute("tooltipText","Rénumération brute de l'étudiant. C'est la somme du montant de tous les JEH de l'étudiant multiplié par "+ taux+"%.");
				
				
				
						var dateArm = new Date( form.date_arm.value[6]+form.date_arm.value[7]+form.date_arm.value[8]+form.date_arm.value[9],  parseInt(form.date_arm.value[3]+form.date_arm.value[4])-1, form.date_arm.value[0]+form.date_arm.value[1]);
	var dateFinEtude = new Date( form.nouvelle_date_fin.value[6]+form.nouvelle_date_fin.value[7]+form.nouvelle_date_fin.value[8]+form.nouvelle_date_fin.value[9],   parseInt(form.nouvelle_date_fin.value[3]+form.nouvelle_date_fin.value[4])-1, form.nouvelle_date_fin.value[0]+form.nouvelle_date_fin.value[1]);
	
	if(dateArm > dateFinEtude)
		   {
			   form.nouvelle_date_fin.setCustomValidity("La date de fin d'étude ne peut être avant la date de signature");
		   }
		    else
			{
							   	form.nouvelle_date_fin.setCustomValidity("");
			}
			
			
				if(form.definition_mission_arm.checked==false && form.delai_mission_arm.checked==false && form.indemnisation_arm.checked==false)
	{
		form.definition_mission_arm.setCustomValidity("L'avenant doit forcément changer la définition et/ou le délai et/ou la rénumération");
	}
	else
	{
		form.definition_mission_arm.setCustomValidity("");
	}
	
		if(form.definition_mission_arm.checked==true)
	{
		document.getElementById("definitionMissionDiv").style.display="inline";
		form.description_phase_arm=true;
	}
	else
	{
		document.getElementById("definitionMissionDiv").style.display="none";
		form.description_phase_arm.required=false;
	}
	
		if(form.delai_mission_arm.checked==true)
	{
		document.getElementById("delaiMissionDiv").style.display="inline";
		form.nouvelle_date_fin.required=true;
	}
	else
	{
		document.getElementById("delaiMissionDiv").style.display="none";
		form.nouvelle_date_fin.required=false;
	}
	
		if(form.indemnisation_arm.checked==true)
	{
		document.getElementById("indemnisationDiv").style.display="inline";
		form.jeh_arm.required=true;
		form.nouvelle_indemnisation_arm.required=true;
	}
	else
	{
		document.getElementById("indemnisationDiv").style.display="none";
		form.jeh_arm.required=false;
		form.nouvelle_indemnisation_arm.required=false;
	}
	
	
				if(form.nouvelle_indemnisation_arm.valueAsNumber>(form.jeh_arm.valueAsNumber*jeh_haut))
	form.nouvelle_indemnisation_arm.setCustomValidity("Pour "+form.jeh_arm.valueAsNumber+" JEH, la rénumération ne peut pas être de " + form.nouvelle_indemnisation_arm.valueAsNumber+"€. Le max pour un JEH (à cette date) est de "+jeh_haut+"€.");
	else
	form.nouvelle_indemnisation_arm.setCustomValidity("");
 }