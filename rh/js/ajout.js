function refCE()
{
	var form=document.getElementById("formMembre");
	
	if(form.date_ce.validity.patternMismatch || form.date_ce.value=="") alert("Veuillez saisir une date avant");
	else if(form.nom.validity.valueMissing)alert("Veuillez saisir un nom avant");
	else if(form.prenom.validity.valueMissing)alert("Veuillez saisir un prénom avant");
	else
	{
		var prenom;
		if(form.prenom.value.length>2) prenom=form.prenom.value.charAt(0)+form.prenom.value.charAt(1)+form.prenom.value.charAt(2);
		else if(form.prenom.value.length>1) prenom=form.prenom.value.charAt(0)+form.prenom.value.charAt(1);
		else  prenom=form.prenom.value.charAt(0);
		
				var nom;
		if(form.nom.value.length>2) nom=form.nom.value.charAt(0)+form.nom.value.charAt(1)+form.nom.value.charAt(2);
		else if(form.nom.value.length>1) nom=form.nom.value.charAt(0)+form.nom.value.charAt(1);
		else  nom=form.nom.value.charAt(0);
		
		var jour = form.date_ce.value.charAt(0)+form.date_ce.value.charAt(1);
		var mois = form.date_ce.value.charAt(3)+form.date_ce.value.charAt(4);
		var annee = form.date_ce.value.charAt(6)+form.date_ce.value.charAt(7)+form.date_ce.value.charAt(8)+form.date_ce.value.charAt(9);
		nom = nom.replace("é", "e");
		nom = nom.replace("ê", "e");
		nom = nom.replace("É", "E");
		nom = nom.replace("Ê", "E");
		prenom = prenom.replace("é", "e");
		prenom = prenom.replace("ê", "e");
		prenom = prenom.replace("É", "E");
		prenom = prenom.replace("Ê", "E");
		form.ref_ce.value=nom.toUpperCase()+prenom.toUpperCase()+annee+mois+jour;
	}
	
}

function mailJeece()
{
	var form=document.getElementById("formMembre");
	
	if(form.nom.validity.valueMissing)alert("Veuillez saisir un nom avant");
	else if(form.prenom.validity.valueMissing)alert("Veuillez saisir un prénom avant");
	else
	{

		form.mail_jeece.value=form.prenom.value.toLowerCase()+"."+form.nom.value.toLowerCase()+"@jeece.fr";
	}
	
}

function intervenantFunction(modif)
{
	var form=document.getElementById("formMembre");
	
	if(form.intervenant.checked==true)
	{
	document.getElementById("intervenantDiv").style.display="inline";
	if(!modif)form.poste.value="Intervenant";
	}
	else
	{
		form.poste.value="";
		form.android.checked=false;
		form.ios.checked=false;
		form.windows_phone.checked=false;
		form.vba.checked=false;
		form.java.checked=false;
		form.C.checked=false;
		form.site.checked=false;
		form.electronique.checked=false;
		form.traduction.checked=false;
	document.getElementById("intervenantDiv").style.display="none";
	}

		
}


function intervenantFunctionCompte()
{

		var form=document.getElementById("formCompte");
	
	if(form.intervenant.checked==true)
	{
	document.getElementById("intervenantDiv").style.display="inline";
	form.poste.value="Intervenant";
	}
	else
	{
		form.poste.value="";
		form.android.checked=false;
		form.ios.checked=false;
		form.windows_phone.checked=false;
		form.vba.checked=false;
		form.java.checked=false;
		form.C.checked=false;
		form.site.checked=false;
		form.electronique.checked=false;
		form.traduction.checked=false;
	document.getElementById("intervenantDiv").style.display="none";
	}
}

function compteFunction(etat)
{
	var form=document.getElementById("formMembre");
	
	if(form.compte.checked==true)
	{
	document.getElementById("compteDiv").style.display="inline";
	if(etat==0) form.mdp.required=true;
	else form.mdp.required=false;
	}
	else
	{
	document.getElementById("compteDiv").style.display="none";
	form.mail_compte.checked=false;
	form.mdp.required=false;
	}
}


function genererMdp()
{
	var form=document.getElementById("formMembre");
	var ok = 'azertyupqsdfghjkmwxcvbn23456789AZERTYUPQSDFGHJKMWXCVBN';
        var pass = '';
        longueur = 8;
        for(i=0;i<longueur;i++){
            var wpos = Math.round(Math.random()*ok.length);
            pass+=ok.substring(wpos,wpos+1);
        }
        form.mdp.value = pass;
}