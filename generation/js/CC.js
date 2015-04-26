jQuery(function(){
	console.log($( ".date_cc_id" ).html());
$( ".date_cc_id" ).change(function() {
  alert( "Handler for .change() called." );
});
});
function majCC(date)
{
	//Société/particulier
	var form=document.getElementById("formCC");
	if(form.societe_particulier.value=="societe")
	{
	document.getElementById("qualiteContactDivCC").style.display="inline";
	document.getElementById("nomContactDivCC").style.display="inline";
	document.getElementById("nomClientLabelCC").innerHTML = "Nom de la Société";
	document.getElementById("adresseClientLabelCC").innerHTML = "Adresse de la Société";
	document.getElementById("cpClientLabelCC").innerHTML = "Code-Postal de la Société";
	document.getElementById("villeClientLabelCC").innerHTML = "Ville de la Société";
	document.getElementById("mailClientLabelCC").innerHTML = "Mail du contact de la Société";
	document.getElementById("telClientLabelCC").innerHTML = "Téléphone du contact de la Société";
	form.nom_contact.required = true;
	form.qualite_contact.required = true;
	}
	else
	{
			document.getElementById("qualiteContactDivCC").style.display="none";
	document.getElementById("nomContactDivCC").style.display="none";
	document.getElementById("nomClientLabelCC").innerHTML = "Nom Prénom du Client";
	document.getElementById("adresseClientLabelCC").innerHTML = "Adresse du Client";
	document.getElementById("cpClientLabelCC").innerHTML = "Code-Postal du Client";
	document.getElementById("villeClientLabelCC").innerHTML = "Ville du Client";
	document.getElementById("mailClientLabelCC").innerHTML = "Mail du Client";
	document.getElementById("telClientLabelCC").innerHTML = "Téléphone du Client";
		form.nom_contact.required = false;
	form.qualite_contact.required = false;
	}  
	
					if(!form.date_cc.validity.patternMismatch && !form.date_cc.validity.valueMissing && date=="date_cc")
			{
				 jeh_bas = parseInt(get_parametre(form.date_cc.value,"jeh_bas"));
				 jeh_haut = parseInt(get_parametre(form.date_cc.value,"jeh_haut"));
								 min_frais = parseInt(get_parametre(form.date_cc.value,"min_frais_structure"));
	max_frais = parseInt(get_parametre(form.date_cc.value,"max_frais_structure"));
	 frais = parseInt(parseFloat(get_parametre(form.date_cc.value,"frais_structure"))*100);
	 acompte = parseInt(parseFloat(get_parametre(form.date_cc.value,"taux_acompte"))*100);
			}
			else if(date=="date_cc")
			{
				 jeh_bas = "(Saisir date avant)";
				 jeh_haut = "(Saisir date avant)";
							 min_frais = "(Saisir date avant)";
	max_frais = "(Saisir date avant)";
	frais = "(Saisir date avant)";
	 acompte = "(Saisir date avant)";
			}
	
	
	//Partie acompte
	if(form.presence_acompte.checked==true)
	{
		document.getElementById("acompteDivCC").style.display="inline";
		form.ht_acompte_cc.required=true;
		
		//Vérification
		if(form.ht_acompte_cc.valueAsNumber>(form.ht_frais_cc.valueAsNumber+form.ht_sans_frais_cc.valueAsNumber))
			form.ht_acompte_cc.setCustomValidity("Le montant de l'acompte ne peut être supérieur au montant total de la mission");
		else
		form.ht_acompte_cc.setCustomValidity("");
	}
	else
	{
		document.getElementById("acompteDivCC").style.display="none";
		form.ht_acompte_cc.required=false;
	}
	
	//On vérifie le nombre de JEH et le montant de la mission
	
	if(form.ht_sans_frais_cc.valueAsNumber>(form.nombre_jeh_cc.valueAsNumber*jeh_haut))
	form.ht_sans_frais_cc.setCustomValidity("Pour "+form.nombre_jeh_cc.valueAsNumber+" JEH, le montant HT (sans les frais) ne peut pas être de " + form.ht_sans_frais_cc.valueAsNumber+"€. Le max pour un JEH (à cette date) est de "+jeh_haut+"€.");
	else if(form.ht_sans_frais_cc.valueAsNumber<(form.nombre_jeh_cc.valueAsNumber*jeh_bas))
	form.ht_sans_frais_cc.setCustomValidity("Pour "+form.nombre_jeh_cc.valueAsNumber+" JEH, le montant HT (sans les frais) ne peut pas être de " + form.ht_sans_frais_cc.valueAsNumber+"€. Le min pour un JEH (à cette date) est de "+jeh_bas+"€.");
	else
	form.ht_sans_frais_cc.setCustomValidity("");
	
	
	//Partie Phase intermédiaires
	var nombre_phase_intermediaire=parseInt(form.nombre_livrable_intermediaire.value);
	
	//Partie Affichage
		for (i = 0; i < 4; i++) 
	{
		var ht=document.getElementById("ht_lot_"+String(i+1)+"_id");
		var jeh=document.getElementById("jeh_lot_"+String(i+1)+"_id");
		
		if(i<parseInt(nombre_phase_intermediaire))
		{
			document.getElementById("lot"+String(i+1)+"DivCC").style.display="inline";
			jeh.required=true;
			ht.required=true;
		}
		else
		{
			document.getElementById("lot"+String(i+1)+"DivCC").style.display="none";
						jeh.required=false;
			ht.required=false;
		}
	}
	
	//Vérification
	if(form.presence_acompte.checked==true)
	var montantTotal = form.ht_acompte_cc.valueAsNumber;
	else
	var montantTotal = 0;
	var jehTotal=0;
	
	
			for (i = 1; i < (nombre_phase_intermediaire+1); i++) 
		{
	
			var ht=document.getElementById("ht_lot_"+i+"_id");
			var jeh=document.getElementById("jeh_lot_"+i+"_id");
			
			montantTotal = montantTotal+ht.valueAsNumber;
			jehTotal = jehTotal + jeh.valueAsNumber;
			
			if(parseFloat(ht.value)>parseFloat(jeh.value)*jeh_haut)
		   {
			   	ht.setCustomValidity("Pour "+jeh.valueAsNumber+" JEH, le montant HT du lot "+i+" ne peut pas être de " + ht.valueAsNumber+"€. Le max pour un JEH (à cette date) est de "+jeh_haut+"€.");
		   }
		   	else if(parseFloat(ht.value)+form.ht_acompte_cc.valueAsNumber<parseFloat(jeh.value)*jeh_bas)
		   {
			   			   	ht.setCustomValidity("Pour "+jeh.valueAsNumber+" JEH, le montant HT du lot "+i+" ne peut pas être de " + ht.valueAsNumber+"€. Le min pour un JEH (à cette date) est de "+jeh_bas+"€.");
		   }
		   else if(i==nombre_phase_intermediaire && form.nombre_jeh_cc.valueAsNumber<jehTotal)
		   {
			   	jeh.setCustomValidity("Nombre de JEH dans les lots supérieur au nombre total de JEH de la mission");
		   }
		   		   else if(i==nombre_phase_intermediaire && (form.ht_frais_cc.valueAsNumber+form.ht_sans_frais_cc.valueAsNumber)<montantTotal)
		   {
			   ht.setCustomValidity("La somme des lots et de l'acompte est supérieure au montant total de la mission");
		   }
		    else
			{
							   	ht.setCustomValidity("");
								 	jeh.setCustomValidity("");
			}
		}
		
		
		//Vérification sur le délai et le nombre de JEH
		if(form.jour_semaine.value=="1" && form.nombre_jeh_cc.valueAsNumber>form.delai_etude.valueAsNumber)
		   {
			   form.delai_etude.setCustomValidity("Il ne peut pas y avoir plus de JEH que de jour d'étude");
		   }
		   		else if(form.jour_semaine.value=="2" && form.nombre_jeh_cc.valueAsNumber>(form.delai_etude.valueAsNumber*7))
		   {
			   form.delai_etude.setCustomValidity("Il ne peut pas y avoir plus de JEH que de jour d'étude");
		   }
		    else
			{
							   	form.delai_etude.setCustomValidity("");
			}
			
			
			//Tooltip des frais

	form.ht_frais_cc.setAttribute("tooltipText","Montant des frais, sauf cas particulier les frais sont à "+frais+"% du montant total HT de la mission. Plafond min : "+min_frais+"€ et plafond max : "+max_frais+"€");
	
			//Tooltip acompte
	
	form.ht_acompte_cc.setAttribute("tooltipText","Montant que le client va payer à la signature de la mission. Taux normal : "+acompte+"%");
}

function verifFormCC(f)
{
	var refetudeOk = verifRefetude(f.refetude);
	var dateOk = verifDateCC(f.date_cc);
	var nom_societeOk = verifChamp(f.nom_societe);
	var adresse_clientOk = verifChamp(f.adresse_client);
	var cp_clientOk = verifCP(f.cp_client);
	var ville_clientOk = verifChamp(f.ville_client);
	if(f.menu_societe_particulier_cc=="societe") var nom_contactOk = verifChamp(f.nom_contact);
	else var nom_contactOk = true;
	var mail_contactOk = verifMail(f.mail_contact);
	var tel_contactOk = verifTel(f.tel_contact,true);
	if(f.menu_societe_particulier_cc=="societe") var qualite_contactOk = verifChamp(f.qualite_contact);
	else var qualite_contactOk = true;
	var nom_cdpOk = verifChamp(f.nom_cdp);
	var mail_cdpOk = verifMail(f.mail_cdp);
	var tel_cdpOk = verifTel(f.tel_cdp,true);
	var description_etudeOk = verifChamp(f.description_etude);
	var correspondance_ht_jehOk = verifJEHCC();
	var nombre_jehOk = verifJEH(f.nombre_jeh_cc);
	var ht_sans_fraisOk = verifMontant(f.ht_sans_frais_cc);
	var ht_fraisOk = verifMontant(f.ht_frais_cc);
	if(f.presence_acompte_cc_id.checked==true) 
	{
		var ht_acompteOk = verifMontant(f.ht_acompte_cc);
		var acompte_montantOk = verifAcompte();
	}
	else
	{
		var acompte_montantOk = true;
		var ht_acompteOk = true;
	}
	
	var nombre_phase_intermediaire=document.getElementById("nombre_livrable_intermediaire_cc_id").value;
	lot1Ok = lot2Ok = lot3Ok = lot4Ok = true;
	if(nombre_phase_intermediaire>0) var lot1Ok = verifJEHCC_lot(f.ht_lot_1) && verifJEH(f.jeh_lot_1) && verifMontant(f.ht_lot_1);
	if(nombre_phase_intermediaire>1) var lot2Ok = verifJEHCC_lot(f.ht_lot_2) && verifJEH(f.jeh_lot_2) && verifMontant(f.ht_lot_2);
	if(nombre_phase_intermediaire>2) var lot3Ok = verifJEHCC_lot(f.ht_lot_3) && verifJEH(f.jeh_lot_3) && verifMontant(f.ht_lot_3);
	if(nombre_phase_intermediaire>3) var lot4Ok = verifJEHCC_lot(f.ht_lot_4) && verifJEH(f.jeh_lot_4) && verifMontant(f.ht_lot_4);

	
   
   if(refetudeOk && dateOk && nom_societeOk && adresse_clientOk && cp_clientOk && ville_clientOk && nom_contactOk && mail_contactOk && tel_contactOk && qualite_contactOk && nom_cdpOk && mail_cdpOk && tel_cdpOk && description_etudeOk && nombre_jehOk && ht_sans_fraisOk && ht_fraisOk && ht_acompteOk && acompte_montantOk && lot1Ok && lot2Ok && lot3Ok && lot4Ok && correspondance_ht_jehOk)
      return true;
   else
   {
      alert("Veuillez remplir correctement tous les champs");
      return false;
   }
}

function calculFrais()
{
	var form=document.getElementById("formCC");
	if(form.date_cc.value=="")
	alert("Veuillez saisir une date avant");
	else
	{
	var min_frais = parseInt(get_parametre(form.date_cc.value,"min_frais_structure"));
	var max_frais = parseInt(get_parametre(form.date_cc.value,"max_frais_structure"));
	var frais = parseFloat(get_parametre(form.date_cc.value,"frais_structure"));
		var MontantFrais = Math.ceil(frais*form.ht_sans_frais_cc.valueAsNumber/10)*10;
		if(MontantFrais>max_frais)
			MontantFrais=max_frais;
					if(MontantFrais<min_frais)
			MontantFrais=min_frais;
		form.ht_frais_cc.value=MontantFrais;
	}
}

function calculAcompte()
{
	var form=document.getElementById("formCC");
	if(form.date_cc.value=="")
	alert("Veuillez saisir une date avant");
	else
	{
var acompte = parseFloat(get_parametre(form.date_cc.value,"taux_acompte"));
		var MontantAcompte = Math.round(acompte*(form.ht_sans_frais_cc.valueAsNumber+form.ht_frais_cc.valueAsNumber)*100)/100;

		form.ht_acompte_cc.value=MontantAcompte;
	}
}