			var cache = {};
			$(function ()
			{
				$("#cp_cc, #ville_cc").autocomplete({
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
										if ($(this).attr('id') == 'cp_cc')
										{
											$('#ville_cc').val(item.Ville);
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
						//Sinon -> Requete Ajax
						else
						{
							var objData = {};
							if ($(this.element).attr('id') == 'cp_cc')
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
												if ($(this).attr('id') == 'cp_cc')
												{
													$('#ville_cc').val(item.Ville);
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
			
			//Pour l'AP
			$(function ()
			{
				$("#cp_ap, #ville_ap").autocomplete({
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
										if ($(this).attr('id') == 'cp_ap')
										{
											$('#ville_ap').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_ap').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_ap')
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
												if ($(this).attr('id') == 'cp_ap')
												{
													$('#ville_ap').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_ap').val(item.CodePostal);
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
			
			
						//Pour le PL
			$(function ()
			{
				$("#cp_pl, #ville_pl").autocomplete({
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
										if ($(this).attr('id') == 'cp_pl')
										{
											$('#ville_pl').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_pl').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_pl')
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
												if ($(this).attr('id') == 'cp_pl')
												{
													$('#ville_pl').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_pl').val(item.CodePostal);
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
			
									//Pour le RMCDP
			$(function ()
			{
				$("#cp_rmcdp, #ville_rmcdp").autocomplete({
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
										if ($(this).attr('id') == 'cp_rmcdp')
										{
											$('#ville_rmcdp').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_rmcdp').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_rmcdp')
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
												if ($(this).attr('id') == 'cp_rmcdp')
												{
													$('#ville_rmcdp').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_rmcdp').val(item.CodePostal);
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
			
									//Pour le AC
			$(function ()
			{
				$("#cp_ac, #ville_ac").autocomplete({
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
										if ($(this).attr('id') == 'cp_ac')
										{
											$('#ville_ac').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_ac').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_ac')
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
												if ($(this).attr('id') == 'cp_ac')
												{
													$('#ville_ac').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_ac').val(item.CodePostal);
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
			
									//Pour le RP
			$(function ()
			{
				$("#cp_rp, #ville_rp").autocomplete({
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
										if ($(this).attr('id') == 'cp_rp')
										{
											$('#ville_rp').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_rp').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_rp')
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
												if ($(this).attr('id') == 'cp_rp')
												{
													$('#ville_rp').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_rp').val(item.CodePostal);
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
			
			
									//Pour le  RP 2
			$(function ()
			{
				$("#cp_rp2, #ville_rp2").autocomplete({
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
										if ($(this).attr('id') == 'cp_rp2')
										{
											$('#ville_rp2').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_rp2').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_rp2')
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
												if ($(this).attr('id') == 'cp_rp2')
												{
													$('#ville_rp2').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_rp2').val(item.CodePostal);
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
			
			
									//Pour le  RT
			$(function ()
			{
				$("#cp_rt, #ville_rt").autocomplete({
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
										if ($(this).attr('id') == 'cp_rt')
										{
											$('#ville_rt').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_rt').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_rt')
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
												if ($(this).attr('id') == 'cp_rt')
												{
													$('#ville_rt').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_rt').val(item.CodePostal);
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
			
									//Pour le  sat_cli
			$(function ()
			{
				$("#cp_sat_cli, #ville_sat_cli").autocomplete({
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
										if ($(this).attr('id') == 'cp_sat_cli')
										{
											$('#ville_sat_cli').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_sat_cli').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_sat_cli')
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
												if ($(this).attr('id') == 'cp_sat_cli')
												{
													$('#ville_sat_cli').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_sat_cli').val(item.CodePostal);
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
		
									//Pour le  sat_int
			$(function ()
			{
				$("#cp_sat_int, #ville_sat_int").autocomplete({
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
										if ($(this).attr('id') == 'cp_sat_int')
										{
											$('#ville_sat_int').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_sat_int').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_sat_int')
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
												if ($(this).attr('id') == 'cp_sat_int')
												{
													$('#ville_sat_int').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_sat_int').val(item.CodePostal);
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
			
			
												//Pour le  PV
			$(function ()
			{
				$("#cp_pv, #ville_pv").autocomplete({
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
										if ($(this).attr('id') == 'cp_pv')
										{
											$('#ville_pv').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_pv').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_pv')
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
												if ($(this).attr('id') == 'cp_pv')
												{
													$('#ville_pv').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_pv').val(item.CodePostal);
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
			
			
			

												//Pour le  PV
			$(function ()
			{
				$("#cp_arm, #ville_arm").autocomplete({
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
										if ($(this).attr('id') == 'cp_arm')
										{
											$('#ville_arm').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_arm').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_arm')
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
												if ($(this).attr('id') == 'cp_arm')
												{
													$('#ville_arm').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_arm').val(item.CodePostal);
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
			
															//Pour le  PV
			$(function ()
			{
				$("#cp_d, #ville_d").autocomplete({
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
										if ($(this).attr('id') == 'cp_d')
										{
											$('#ville_d').val(item.Ville);
											return item.CodePostal;
										}
										else
										{
											$('#cp_d').val(item.CodePostal);
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
							if ($(this.element).attr('id') == 'cp_d')
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
												if ($(this).attr('id') == 'cp_d')
												{
													$('#ville_d').val(item.Ville);
													return item.CodePostal;
												}
												else
												{
													$('#cp_d').val(item.CodePostal);
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