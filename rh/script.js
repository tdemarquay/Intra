var table;
$(document).ready( function () {
     table = $('#example').DataTable( {
		stateSave: true,
		"order": [[ 0, "asc" ]],
		dom: 'CT<"clear">lfrtipR',
		     oTableTools: {
        sSwfPath: "swf/copy_csv_xls_pdf.swf"
    },
"aoColumnDefs": [
      { "bVisible": false, "aTargets": [ 3,4,5,7,9,14,15 ] }
    ],
    language: {
        processing:     "Traitement en cours...",
        search:         "Rechercher&nbsp;:",
        lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
        info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
        infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
        infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
        infoPostFix:    "",
        loadingRecords: "Chargement en cours...",
        zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
        emptyTable:     "Aucune donnée disponible dans le tableau",
        paginate: {
            first:      "Premier",
            previous:   "Pr&eacute;c&eacute;dent",
            next:       "Suivant",
            last:       "Dernier"
        },
        aria: {
            sortAscending:  ": activer pour trier la colonne par ordre croissant",
            sortDescending: ": activer pour trier la colonne par ordre décroissant"
        }
    }
} );


} );


	var _alphabetSearch = ' ';
	

$.fn.dataTable.ext.search.push( function ( settings, searchData ) {
    if ( ! _alphabetSearch ) {
        return true;
    }
 _alphabetSearch = document.getElementById("annee_id").value;
    if ( searchData[2].charAt(0) === _alphabetSearch.charAt(0) && searchData[2].charAt(1) === _alphabetSearch.charAt(1) && searchData[2].charAt(2) === _alphabetSearch.charAt(2) && searchData[2].charAt(3) === _alphabetSearch.charAt(3)) {
        return true;
    }
	if(_alphabetSearch === "toutes")
	return true;
 
    return false;
} );

function majAnnee ()

{
	
	table.draw();
}

function suppression()
{
	
	     
       $(function() {
    $( "#dialog" ).dialog();
  });
       
}//Fin fuction

function verifCE(date,nom, prenom, adresse, cp, ville, id)
{
if(date=="0000-00-00" || date=="")
{
	alert("Date de la Convention Etudiant incorrecte");
}
else if(nom == "")
{
	alert("Nom de l'étudiant incorrect");
}
else if(prenom == "")
{
	alert("Prénom de l'étudiant incorrect");
}
else if(adresse == "")
{
	alert("Adresse de l'étudiant incorrect");
}
else if(cp == "")
{
	alert("Code-Postal de l'étudiant incorrect");
}
else if(ville == "")
{
	alert("Ville de l'étudiant incorrect");
}
else
{
	
		window.location.href = '../generation/CE/NOMPREAAAAMMJJ.php?ce='+id;
	 
}
}