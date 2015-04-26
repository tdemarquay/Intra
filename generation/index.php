<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../index.php?error=2");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>[JEECE] Génération de documents</title>
<script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" src="js/calendar.js"></script>
<script type="text/javascript" src="js/docChange.js"></script>
<script type="text/javascript" src="js/cp_ville.js"></script>
<script type="text/javascript" src="js/verification.js"></script>
<script type="text/javascript" src="js/CC.js"></script>
<script type="text/javascript" src="js/PL.js"></script>
<script type="text/javascript" src="js/PV.js"></script>
<script type="text/javascript" src="js/RM.js"></script>
<script type="text/javascript" src="js/AP.js"></script>
<script type="text/javascript" src="js/AC.js"></script>
<script type="text/javascript" src="js/RP.js"></script>
<script type="text/javascript" src="js/Membre.js"></script>
<script type="text/javascript" src="js/RT.js"></script>
<script type="text/javascript" src="js/D.js"></script>
<script type="text/javascript" src="js/ARM.js"></script>
<script type="text/javascript" src="js/SAT_CLI.js"></script>
<script type="text/javascript" src="js/rounded-corners.js"></script>
<script type="text/javascript" src="js/form-field-tooltip.js"></script>
<link rel="Stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/themes/base/jquery-ui.css" />
<link rel="Stylesheet" type="text/css" href="css/calendar.css" />
<link rel="Stylesheet" type="text/css" href="css/style.css" />
<link rel="Stylesheet" type="text/css" href="css/form-field-tooltip.css" />
</head>

<body onload="maj(true)" >
<a href="../">
<h3 align="left"> Retour Accueil</h3>
</a>
<h1> Génération de documents</h1>
<SELECT name="doc" size="1" id="doc" onchange="docChange()" >
  <OPTION value="" selected>
  <OPTION value="d">Devis
  <OPTION value="cc">Convention Client
  <OPTION value="ap">Avant-Projet
  <OPTION value="pl">Prêt de Licence
  <OPTION value="rm">Récapitulatif de Mission
  <OPTION value="ac">Avenant Client
  <OPTION value="arm">Avenant au RM
  <OPTION value="rt">Rapport Technique
  <OPTION value="pv">Procès Verbal
  <OPTION value="rp">Rapport Pédagogique
  <OPTION value="sat_cli">Satisfaction Client
  <OPTION value="sat_int">Satisfaction Intervenant
</SELECT>
<div id="d" style="display: none">
  <?php include("D/D.php");?>
</div>
<div id="cc" style="display: none">
  <?php include("CC/CC.php");?>
</div>
<div id="ap" style="display: none">
  <?php include("AP/AP.php");?>
</div>
<div id="pl" style="display: none">
  <?php include("PL/PL.php");?>
</div>
<div id="rm" style="display: none">
  <?php include("RM/RM.php");?>
</div>
<div id="ac" style="display: none">
  <?php include("AC/AC.php");?>
</div>
<div id="arm" style="display: none">
  <?php include("ARM/ARM.php");?>
</div>
<div id="rp" style="display: none">
  <?php include("RP/RP.php");?>
</div>
<div id="rt" style="display: none">
  <?php include("RT/RT.php");?>
</div>
<div id="pv" style="display: none">
  <?php include("PV/PV.php");?>
</div>
<div id="sat_cli" style="display: none">
  <?php include("SAT_CLI/SAT_CLI.php");?>
</div>
<div id="sat_int" style="display: none">
  <?php include("SAT_INT/SAT_INT.php");?>
</div>
</body>
</html>
