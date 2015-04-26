			var cache = {};
			$(function ()
			{
				$("#cp_ce, #ville_ce").autocomplete({
					source: function (request, response)
					{
						//Si la réponse est dans le cache
						if (('FR' + '-' + request.term) in cache)
						{
							response($.map(cache['FR' + '-' + request.term], function (item)
							{

								return {
									label: item.CodePostal + ", " + item.Ville,
									value: function ()
									{
										if ($(this).attr('id') == 'cp_ce')
										{
											$('#ville_ce').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_ce').val(item.CodePostal);
											return item.Ville;
										}
									}
								}
							}));
						}
						//Sinon -> Requete Ajax
						else
						{
							var objData = {};
							if ($(this.element).attr('id') == 'cp_ce')
							{
								objData = { codePostal: request.term, pays: 'FR', maxRows: 10 };
							}
							else
							{
								objData = { ville: request.term, pays: 'FR', maxRows: 10 };
							}
							$.ajax({
								url: "./php/AutoCompletion.php",
								dataType: "json",
								data: objData,
								type: 'POST',
								success: function (data)
								{
									//Ajout de reponse dans le cache
									cache[('FR' + '-' + request.term)] = data;
									response($.map(data, function (item)
									{

										return {
											label: item.CodePostal + ", " + item.Ville,
											value: function ()
											{
												if ($(this).attr('id') == 'cp_ce')
												{
													$('#ville_ce').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_cc').val(item.CodePostal);
													return item.Ville;
												}
											}
										}
									}));
								}
							});
						}
					},
					minLength: 3,
					delay: 600
				});
			});
			
			