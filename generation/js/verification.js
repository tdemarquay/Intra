		var jeh_bas = "(Saisir date avant)";
				var jeh_haut = "(Saisir date avant)";
								var min_frais = "(Saisir date avant)";
	var max_frais = "(Saisir date avant)";
	var frais = "(Saisir date avant)";
	var acompte = "(Saisir date avant)";
	var taux = "(Saisir date avant)";

function maj(date)
{
	if(date)
	{
		majCC("date_cc");
		majAC("date_ac");
		majRM("date_rm");
	majARM("date_arm");
	majD("date_d");
	}
	
	else
	{
		majCC();
		majAC();
		majRM();
	majARM();
	majD();
	}
		majAP();
	majPL();
	
	
majRT();
majPV();
majRP();
majSAT_CLI();


}

function surligne(champ, erreur)
{
   if(erreur)
      champ.style.backgroundColor = "#fba";
   else 
   {   //champ.style.backgroundColor = "#0c0";
   ok = true;
	 
	  if(champ.name=="nombre_jeh_cc" && (!verifJEH(champ,false,false) || !verifJEHCC(champ,false,false))){ok=false;}
	  if(champ.name=="ht_sans_frais_cc" && (!verifMontant(champ,false,false) || !verifJEHCC(champ,false,false) || !verifAcompte(false,false))){ok=false;}
	  if(champ.name=="ht_frais_cc" && (!verifMontant(champ,false,false) || !verifAcompte(false,false)) ){ok=false;}
	  if(champ.name=="ht_acompte_cc" && (!verifMontant(champ,false,false) || !verifAcompte(false,false))){ok=false;}
	  for (i = 1; i < 5; i++) {
		if(champ.name=="jeh_lot_"+i && (!verifJEH(champ,false,false) || !verifJEHCC_lot(champ,false,false))){ok=false;}
		if(champ.name=="ht_lot_"+i && (!verifMontant(champ,false,false) || !verifJEHCC_lot(champ,false,false))){ok=false;}
	  }
	  
	  if (ok) champ.style.backgroundColor = "";
	  }
}

function verifRefetude(champ)
{

   if(champ.value.length < 5 || champ.value.length > 7 )
   {
      surligne(champ, true);
      return false;
   }
    else if( champ.value.length == 5 && (!isInt(champ.value.charAt(3)) || !isInt(champ.value.charAt(4))))
   {
      surligne(champ, true);
      return false;
   }
       else if( champ.value.length == 6 && (!isInt(champ.value.charAt(4)) || !isInt(champ.value.charAt(5))))
   {
      surligne(champ, true);
      return false;
   }
       else if( champ.value.length == 7 && (!isInt(champ.value.charAt(5)) || !isInt(champ.value.charAt(6))))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }

}

function isInt(value) {
   return !isNaN(value) && parseInt(Number(value)) == value;
}

function verifDate(champ)
{
   if(champ.value.length !=10 || !isInt(champ.value.charAt(0)) || !isInt(champ.value.charAt(1)) || champ.value.charAt(2)!='/' || !isInt(champ.value.charAt(3)) || !isInt(champ.value.charAt(4)) || champ.value.charAt(5)!='/' || !isInt(champ.value.charAt(6)) || !isInt(champ.value.charAt(7)) || !isInt(champ.value.charAt(8)) || !isInt(champ.value.charAt(9)))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }

}

function verifChamp(champ)
{
//Exceptions
	if (champ.name=="qualite_contact")  
	{    
		surligne(champ, false);
		return true;
	}
	else if(champ.value.length < 1)
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }

}

function verifCP(champ)
{
	if(champ.value.length !=5 )
   {
      surligne(champ, true);
      return false;
   }
   else if (!isInt(champ.value))
   {
		surligne(champ, true);
		return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }

}

function verifTel(champ)
{
	if(champ.value.length < 5 )
   {
     surligne(champ, true);
      return false;
   }
   /*else if (!isInt(champ.value))
   {
		if(surlignee)surligne(champ, true);
		return false;
   }*/
   else
   {
      surligne(champ, false);
      return true;
   }

}

function verifJEH(champ)
{
	if(champ.value<1)
   {
      surligne(champ, true);
      return false;
   }
   else if(champ.value>99)
   {
      surligne(champ, true);
      return false;
   }
   else if(!isInt(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }

}

function verifMontant(champ)
{
	if(champ.value<0)
   {
      surligne(champ, true);
      return false;
   }
   else if(!isInt(parseFloat(champ.value)*100))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}

function verifMail(champ)
{
   var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
   if(!regex.test(champ.value))
   {
      surligne(champ, true);
      return false;
   }
   else
   {
      surligne(champ, false);
      return true;
   }
}


function get_parametre(date,type)
{

date=date.charAt(6)+date.charAt(7)+date.charAt(8)+date.charAt(9)+"-"+date.charAt(3)+date.charAt(4)+"-"+date.charAt(0)+date.charAt(1);
	var returne;
	$.ajax({type:"GET",
			url:"php/get_parametre.php",
			data:{date: date, type: type},
			async:false,
			dataType:"json",
			success:function(data){
				returne=data;
			}
	});
	return returne;
}
