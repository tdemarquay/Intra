<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Procès Verbal</h2>
<div align='center'>
  <form id="formPV" method="post" action="PV/REFETUDE-PV.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majPV()">
      <br />
      <label>Numéro du PV</label>
      <input placeholder="Numéro du PV" name="numero_pv" tooltipText="S'il s'agit du premier Procès-Verbal de la mission, ça sera 1 et ainsi de suite." type="number" step="1" min="1"  max="99" value="<?php if (isset($_SESSION['numero_pv'])) echo $_SESSION['numero_pv']; ?>" required onblur="majPV()"/>
    </fieldset>
    <fieldset>
      <legend>Type</legend>
      <label>Lot/recette</label>
      <input name="lot_recette" value="lot" required onclick="majPV()" type="radio" style="width:20px" <?php if (isset($_SESSION['lot_recette']) &&  $_SESSION['lot_recette']=="lot") echo "checked"; ?> />
      Lot &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="lot_recette" type="radio" value="recette" onclick="majPV()" style="width:20px"<?php if (isset($_SESSION['lot_recette']) &&  $_SESSION['lot_recette']=="recette") echo "checked"; ?> />
      Recette
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature</label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_pv" id="date_pv_id" type="text" value="<?php if (isset($_SESSION['date_pv'])) echo $_SESSION['date_pv']; else echo "";?>" onclick="new calendar(this)" onblur="majPV()"/>
    </fieldset>
    <fieldset>
      <legend>CdP</legend>
      <label>Nom Prénom CdP</label>
      <input  placeholder="Nom Prénom Chef de Projet" id="nom_idPV" required name="nom_cdp" type="text" value="<?php if (isset($_SESSION['nom_cdp'])) echo $_SESSION['nom_cdp']; ?>" onblur="majPV()"/>
      <br>
      <label>Mail CdP</label>
      <input  placeholder="Mail du CdP" name="mail_cdp" id="mail_idPV" required type="email" value="<?php if (isset($_SESSION['mail_cdp'])) echo $_SESSION['mail_cdp']; ?>" onblur="majPV()"/>
      <br>
      <label>Téléphone CdP</label>
      <input placeholder="Téléphone du CdP" name="tel_cdp" id="tel_idPV" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_cdp'])) echo $_SESSION['tel_cdp']; ?>" onblur="majPV()"/>
    </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_cc" size="1" onchange="majPV()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelPV">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majPV()"/>
      <br>
      <label id="adresseClientLabelPV">Adresse du client</label>
      <input placeholder="Adresse du client"  required="required"  name="adresse_client" type="text" value="<?php if (isset($_SESSION['adresse_client'])) echo $_SESSION['adresse_client']; ?>" onblur="majPV()"/>
      <br>
      <label id="cpClientLabelPV">Code Postal Client</label>
      <input placeholder="Code Postal Cient"  required="required"  name="cp_client" id="cp_pv"  type="text" value="<?php if (isset($_SESSION['cp_client'])) echo $_SESSION['cp_client']; ?>" onblur="majPV()"/>
      <br>
      <label id="villeClientLabelPV">Ville Client</label>
      <input placeholder="Ville du client"  required="required"  name="ville_client" id="ville_pv" type="text" value="<?php if (isset($_SESSION['ville_client'])) echo $_SESSION['ville_client']; ?>" onblur="majPV()"/>
      <div id="nomContactDivPV"><br>
        <label id="nomContactLabelPV">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majPV()"/>
      </div>
      <br>
      <label id="mailClientLabelPV">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majPV()"/>
      <br>
      <label id="telClientLabelPV">Téléphone Client</label>
      <input placeholder="Téléphone du client" name="tel_contact" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_contact'])) echo $_SESSION['tel_contact']; ?>" size="25" onblur="majPV()"/>
      <div id="qualiteContactDivPV"><br>
        <label>Qualité Contact de la Société</label>
        <input  placeholder="Qualité du contact"   tooltipText="Quel est le poste du contact dans l'entreprise cliente ?"  name="qualite_contact" type="text" value="<?php if (isset($_SESSION['qualite_contact'])) echo $_SESSION['qualite_contact']; ?>" onblur="majPV()"/>
      </div>
    </fieldset>
    <div id="lotDiv" >
    <fieldset>
      <legend>Lot</legend>
      <label>Phases du lot (Le client accepte la livraison...)</label>
      <textarea name="nom_phase" required  type="text" rows="4" placeholder="Phases du lot" tooltipText="A quelles phases correspond ce PV ? Quelles sont les phases rendues au client pour cette livraison intermédiaire ?"><?php if (isset($_SESSION['nom_phase'])) echo $_SESSION['nom_phase']; ?>
</textarea></div>
    </fieldset>
    <input type="submit" name="btn_go" value="Générer" style="width:800px;height:60px"/>
    <br />
    <br />
  </form>
</div>
<script type="text/javascript">
var tooltipObj = new DHTMLgoodies_formTooltip();
tooltipObj.setTooltipPosition('right');
tooltipObj.setPageBgColor('#EEE');
tooltipObj.setCloseMessage('Exit');
tooltipObj.initFormFieldTooltip();
</script> 