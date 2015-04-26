
			$(function ()
			{
				$("#nom_idRM").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idRM')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
													$('#nom_idRM').val(item.nom);
													$('#prenom_idRM').val(item.prenom);
													$('#adresse_idRM').val(item.adresse);
													$('.cp_idRM').val(item.cp);
													$('.ville_idRM').val(item.ville);
													$('#mail_idRM').val(item.mail);
													$('#tel_idRM').val(item.tel);
													$('#ref_ce_idRM').val(item.ref_ce);
													
													return item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
			
			$(function ()
			{
				$("#nom_idCC").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idCC')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
													$('#nom_idCC').val(item.prenom+" "+item.nom);
													$('#mail_idCC').val(item.mail);
													$('#tel_idCC').val(item.tel);
													
													return item.prenom+" "+item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
						$(function ()
			{
				$("#nom_idD").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idD')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
													$('#nom_idD').val(item.prenom+" "+item.nom);
													$('#tel_idD').val(item.tel);
													$('#mail_idD').val(item.mail);
													
													return item.prenom+" "+item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
			
					$(function ()
			{
				$("#nom_idPL").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idPL')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
													$('#nom_idPL').val(item.prenom+" "+item.nom);
													$('#tel_idPL').val(item.tel);
													$('#mail_idPL').val(item.mail);
													
													return item.prenom+" "+item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
						$(function ()
			{
				$("#nom_idAC").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idAC')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
													$('#nom_idAC').val(item.prenom+" "+item.nom);
													$('#mail_idAC').val(item.mail);
													$('#tel_idAC').val(item.tel);
													
													return item.prenom+" "+item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
			
			
			
			$(function ()
			{
				$("#nom_idARM").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idARM')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
													$('#nom_idARM').val(item.nom);
													$('#prenom_idARM').val(item.prenom);
													$('#adresse_idARM').val(item.adresse);
													$('.cp_idARM').val(item.cp);
													$('.ville_idARM').val(item.ville);
													$('#mail_idARM').val(item.mail);
													$('#tel_idARM').val(item.tel);
													$('#ref_ce_idARM').val(item.ref_ce);
													
													return item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
						$(function ()
			{
				$("#nom_idRP").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idRP')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
												var now = new Date();
												var annee   = now.getFullYear();
												var mois    = now.getMonth() + 1;
													$('#nom_idRP').val(item.nom);
													$('#prenom_idRP').val(item.prenom);
													$('#adresse_idRP').val(item.adresse);
													$('.cp_idRP').val(item.cp);
													$('.ville_idRP').val(item.ville);
													$('#mail_idRP').val(item.mail);
													$('#tel_idRP').val(item.tel);
													$('#ref_ce_idRP').val(item.ref_ce);
													var promo="";

													if(item.promo==annee || (item.promo==annee+1 && mois>6))
														promo=5;
													else if(item.promo==(annee+1) || (item.promo==(annee+2) && mois>6))
														promo=4;
													else if(item.promo==(annee+2) || (item.promo==(annee+3) && mois>6))
														promo=3;
													else if(item.promo==(annee+3) || (item.promo==(annee+4) && mois>6))
														promo=2;
													else if(item.promo==(annee+4) || (item.promo==(annee+5) && mois>6))
														promo=1;
													$('#promo_idRP').val(promo);
													
													return item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
									$(function ()
			{
				$("#nom_idPV").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idPV')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
													$('#nom_idPV').val(item.prenom+" "+item.nom);
													$('#mail_idPV').val(item.mail);
													$('#tel_idPV').val(item.tel);
													
													return item.prenom+" "+item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
			
			
			
			
									$(function ()
			{
				$("#nom_idSAT_INT").autocomplete({
					source: function (request, response)
					{


							var objData = {};
							if ($(this.element).attr('id') == 'nom_idSAT_INT')
							{
								objData = { nom: request.term, maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletionMembre.php",
								dataType: "json",
								data: objData,
								type: 'GET',
								success: function (data)
								{
									response($.map(data, function (item)
									{

										return {
											label: item.prenom + " " + item.nom,
											value: function ()
											{
												var now = new Date();
												var annee   = now.getFullYear();
												var mois    = now.getMonth() + 1;
													$('#nom_idSAT_INT').val(item.nom);
													$('#prenom_idSAT_INT').val(item.prenom);
													$('#adresse_idSAT_INT').val(item.adresse);
													$('.cp_idSAT_INT').val(item.cp);
													$('.ville_idSAT_INT').val(item.ville);
													$('#mail_idSAT_INT').val(item.mail);
													$('#tel_idSAT_INT').val(item.tel);
													$('#ref_ce_idSAT_INT').val(item.ref_ce);
													var promo="";

													if(item.promo==annee || (item.promo==annee+1 && mois>6))
														promo=5;
													else if(item.promo==(annee+1) || (item.promo==(annee+2) && mois>6))
														promo=4;
													else if(item.promo==(annee+2) || (item.promo==(annee+3) && mois>6))
														promo=3;
													else if(item.promo==(annee+3) || (item.promo==(annee+4) && mois>6))
														promo=2;
													else if(item.promo==(annee+4) || (item.promo==(annee+5) && mois>6))
														promo=1;
													$('#promo_idSAT_INT').val(promo);
													
													return item.nom;
											}
										}
									}));
								}
							});
						
					},
					minLength: 2,
					delay: 600
				});
			});// JavaScript Document
			
			
			/*      $(function() {
                   $('#nom_idRM').val("");

                    $("#nom_idRM").autocomplete({
                        source: "./php/AutoCompletionMembre.php",
                        minLength: 1,
                        select: function(event, ui) {
                            $('#nom_idRM').val(ui.item.nom);
                            $('#prenom_idRM').val(ui.item.prenom);

                        }
                    });
                });
			*/