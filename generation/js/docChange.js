function docChange()
{
	document.getElementById("cc").style.display="none";
	document.getElementById("ap").style.display="none";
	document.getElementById("pl").style.display="none";
	document.getElementById("rm").style.display="none";
	document.getElementById("ac").style.display="none";
	document.getElementById("arm").style.display="none";
	document.getElementById("rp").style.display="none";
	document.getElementById("rt").style.display="none";
	document.getElementById("pv").style.display="none";
	document.getElementById("d").style.display="none";
	document.getElementById("sat_cli").style.display="none";
	document.getElementById("sat_int").style.display="none";

	if(document.getElementById("doc").value=="cc")
	{
		document.getElementById("cc").style.display="";
		majCC("date_cc");
	}
	else if(document.getElementById("doc").value=="ap")
	{
		document.getElementById("ap").style.display="";
		majAP();
	}
	else if(document.getElementById("doc").value=="pl")
	{
		document.getElementById("pl").style.display="";
		majPL();
	}
	else if(document.getElementById("doc").value=="rm")
	{
		document.getElementById("rm").style.display="";
		majRM("date_rm");
	}
	else if(document.getElementById("doc").value=="ac")
	{
		document.getElementById("ac").style.display="";
		majAC("date_ac");
	}
	else if(document.getElementById("doc").value=="rp")
	{
		document.getElementById("rp").style.display="";
	}
	else if(document.getElementById("doc").value=="rt")
	{
		document.getElementById("rt").style.display="";
	}
	else if(document.getElementById("doc").value=="pv")
	{
		document.getElementById("pv").style.display="";
	}
	else if(document.getElementById("doc").value=="sat_cli")
	{
		document.getElementById("sat_cli").style.display="";
	}
	else if(document.getElementById("doc").value=="sat_int")
	{
		document.getElementById("sat_int").style.display="";
	}
	else if(document.getElementById("doc").value=="arm")
	{
		document.getElementById("arm").style.display="";
		majARM("date_arm");
	}
	else if(document.getElementById("doc").value=="d")
	{
		document.getElementById("d").style.display="";
	}

}