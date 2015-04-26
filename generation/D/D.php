<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Devis</h2>
<div align='center'>
  <form id="formD" method="post" action="D/REFETUDE-D.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majD()">
            <br />
      <label>Numéro du Devis</label>
      <input placeholder="Numéro du devis" name="numero_d" tooltipText="S'il s'agit du premier Devis de la mission, ça sera 1 et ainsi de suite." type="number" step="1" min="1"  max="99" value="<?php if (isset($_SESSION['numero_d'])) echo $_SESSION['numero_d']; ?>" required onblur="majD()"/>
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Edition </label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_d" id="date_d_id" type="text" value="<?php if (isset($_SESSION['date_d'])) echo $_SESSION['date_d']; else echo "";?>" onclick="new calendar(this)" onblur="majD()"/>
    </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_cc" size="1" onchange="majD()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelD">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majD()"/>
      <div id="nomContactDivD"><br>
        <label id="nomContactLabelD">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majD()"/>
      </div><br>
		<label id="mailClientLabelD">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majCC()"/>
      
    </fieldset>
    <fieldset>
      <legend>CdP</legend>
      <label>Nom Prénom CdP</label>
      <input  placeholder="Nom Prénom Chef de Projet" id="nom_idD" required name="nom_cdp" type="text" value="<?php if (isset($_SESSION['nom_cdp'])) echo $_SESSION['nom_cdp']; ?>" onblur="majD()"/>
      <br>
      <label>Téléphone CdP</label>
      <input placeholder="Téléphone du CdP" name="tel_cdp" id="tel_idD" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_cdp'])) echo $_SESSION['tel_cdp']; ?>" onblur="majD()"/>
      <br>
      <label>Mail CdP</label>
      <input  placeholder="Mail du CdP" name="mail_cdp" id="mail_idD" required type="email" value="<?php if (isset($_SESSION['mail_cdp'])) echo $_SESSION['mail_cdp']; ?>" onblur="majCC()"/>
      
    </fieldset>
    <input type="submit" name="btn_go" value="Générer" style="width:800px;height:60px"/><br><br>
  </form>
</div>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEE');
tooltipObj.setCloseMessage('Exit');
tooltipObj.initFormFieldTooltip();
</script> 