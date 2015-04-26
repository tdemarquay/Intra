<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Prêt de Licence</h2>
<div align='center'>
  <form id="formPL" method="post" action="PL/REFETUDE-PL.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majPL()">
      <br />
      <label>Numéro du PL</label>
      <input placeholder="Numéro du PL" name="numero_pl" tooltipText="S'il s'agit du premier Prêt de Licence de la mission, ça sera 1 et ainsi de suite." type="number" step="1" min="1"  max="99" value="<?php if (isset($_SESSION['numero_pl'])) echo $_SESSION['numero_pl']; ?>" required onblur="majPL()"/>
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature</label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_pl" id="date_pl_id" type="text" value="<?php if (isset($_SESSION['date_pl'])) echo $_SESSION['date_pl']; else echo "";?>" onclick="new calendar(this)" onblur="majPL()"/>
    </fieldset>
    <fieldset>
      <legend>CdP</legend>
      <label>Nom Prénom CdP</label>
      <input  placeholder="Nom Prénom Chef de Projet" id="nom_idPL" required name="nom_cdp" type="text" value="<?php if (isset($_SESSION['nom_cdp'])) echo $_SESSION['nom_cdp']; ?>" onblur="majPL()"/>
      <br>
      <label>Téléphone CdP</label>
      <input placeholder="Téléphone du CdP" name="tel_cdp" id="tel_idPL" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_cdp'])) echo $_SESSION['tel_cdp']; ?>" onblur="majPL()"/>
      <br>
	  <label>Mail CdP</label>
      <input  placeholder="Mail du CdP"  required="required" id="mail_idPL" name="mail_cdp" type="email" value="<?php if (isset($_SESSION['mail_cdp'])) echo $_SESSION['mail_cdp']; ?>" onblur="majPL()"/>
      <br>
   </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_pl" size="1" onchange="majPL()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelPL">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majPL()"/>
      <br>
      <label id="adresseClientLabelPL">Adresse du client</label>
      <input placeholder="Adresse du client"  required="required"  name="adresse_client" type="text" value="<?php if (isset($_SESSION['adresse_client'])) echo $_SESSION['adresse_client']; ?>" onblur="majPL()"/>
      <br>
      <label id="cpClientLabelPL">Code Postal Client</label>
      <input placeholder="Code Postal Cient"  required="required"  name="cp_client" id="cp_pl"  type="text" value="<?php if (isset($_SESSION['cp_client'])) echo $_SESSION['cp_client']; ?>" onblur="majPL()"/>
      <br>
      <label id="villeClientLabelPL">Ville Client</label>
      <input placeholder="Ville du client"  required="required"  name="ville_client" id="ville_pl" type="text" value="<?php if (isset($_SESSION['ville_client'])) echo $_SESSION['ville_client']; ?>" onblur="majPL()"/>
      <div id="nomContactDivPL"><br>
        <label id="nomContactLabelPL">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majPL()"/>
      </div>
      <br>
      <label id="mailClientLabelPL">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majPL()"/>
      <br>
      <label id="telClientLabelPL">Téléphone Client</label>
      <input placeholder="Téléphone du client" name="tel_contact" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_contact'])) echo $_SESSION['tel_contact']; ?>"  onblur="majPL()"/>
      <div id="qualiteContactDivPL"><br>
        <label>Qualité Contact de la Société</label>
        <input  placeholder="Qualité du contact"   tooltipText="Quel est le poste du contact dans l'entreprise cliente ?"  name="qualite_contact" type="text" value="<?php if (isset($_SESSION['qualite_contact'])) echo $_SESSION['qualite_contact']; ?>" onblur="majPL()"/>
      </div>
    </fieldset>
    <fieldset>
      <legend> Prêt de Licence</legend>
      <label>Nom du logiciel</label>
      <input placeholder="Nom du logiciel" name="nom_logiciel" required type="text" value="<?php if (isset($_SESSION['nom_logiciel'])) echo $_SESSION['nom_logiciel']; ?>"/>
      <br />
      <label>Numéro de licence</label>
      <input placeholder="Numéro de Licence" name="numero_licence" type="text" required value="<?php if (isset($_SESSION['numero_licence'])) echo $_SESSION['numero_licence']; ?>"/>
      </td>
      <br />
      <label>Fin du prêt de licence</label>
      <input style="cursor: pointer" placeholder="JJ/MM/AAAA" pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " name="date_fin_pl" type="text" required value="<?php if (isset($_SESSION['date_fin_pl'])) echo $_SESSION['date_fin_pl']; else echo "";?>" onclick="new calendar(this);"/>
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