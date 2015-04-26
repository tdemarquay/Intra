<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>

<h2> Avant-Projet</h2>
<div align='center'>
  <form id="formAP" method="post" action="AP/REFETUDE-AP.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majAP()">
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature</label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_ap" id="date_cc_id" type="text" value="<?php if (isset($_SESSION['date_ap'])) echo $_SESSION['date_ap']; else echo "";?>" onclick="new calendar(this)" onblur="majAP()"/>
    </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_cc" size="1" onchange="majAP()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelAP">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majAP()"/>
      <br>
      <label id="adresseClientLabelAP">Adresse du client</label>
      <input placeholder="Adresse du client"  required="required"  name="adresse_client" type="text" value="<?php if (isset($_SESSION['adresse_client'])) echo $_SESSION['adresse_client']; ?>" onblur="majAP()"/>
      <br>
      <label id="cpClientLabelAP">Code Postal Client</label>
      <input placeholder="Code Postal Cient"  required="required"  name="cp_client" id="cp_ap"  type="text" value="<?php if (isset($_SESSION['cp_client'])) echo $_SESSION['cp_client']; ?>" onblur="majAP()"/>
      <br>
      <label id="villeClientLabelAP">Ville Client</label>
      <input placeholder="Ville du client"  required="required"  name="ville_client" id="ville_ap" type="text" value="<?php if (isset($_SESSION['ville_client'])) echo $_SESSION['ville_client']; ?>" onblur="majAP()"/>
      <div id="nomContactDivAP"><br>
        <label id="nomContactLabelAP">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majAP()"/>
      </div>
      <br>
      <label id="mailClientLabelAP">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majAP()"/>
      <br>
      <label id="telClientLabelAP">Téléphone Client</label>
      <input placeholder="Téléphone du client" name="tel_contact" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_contact'])) echo $_SESSION['tel_contact']; ?>"  onblur="majAP()"/>
      <div id="qualiteContactDivAP"><br>
        <label>Qualité Contact de la Société</label>
        <input  placeholder="Qualité du contact"   tooltipText="Quel est le poste du contact dans l'entreprise cliente ?"  name="qualite_contact" type="text" value="<?php if (isset($_SESSION['qualite_contact'])) echo $_SESSION['qualite_contact']; ?>" onblur="majAP()"/>
      </div>
      <br>
      <label>Droit Communication</label>
      <input  tooltipText="Le client accepte-t-il que JEECE cite le nom de la société, le domaine de l'étude ainsi que donner un lien vers le rendu final et ceci à titre d'exemple de compétences ?" name="droit_communication" value="1" type="checkbox" <?php if (isset($_SESSION['droit_communication']) && $_SESSION['droit_communication']=="1") echo "CHECKED"; ?> />
    </fieldset>
    <fieldset>
    <legend>Etude</legend>
    <label>Présentation Entreprise (Particulier) client</label>
    <textarea placeholder="Présentation Entreprise (Particulier) client" name="presentation_societe" rows="4"  required="required"  onblur="majAP()"><?php if (isset($_SESSION['presentation_societe'])) echo $_SESSION['presentation_societe']; ?>
</textarea>
    <br><label>Description du contexte et des enjeux (objectifs) de l'étude</label>
    <textarea placeholder="Description du contexte et des enjeux (objectifs) de l'étude" name="contexte_enjeux" onblur="majAP()" required  rows="4"><?php if (isset($_SESSION['contexte_enjeux'])) echo $_SESSION['contexte_enjeux']; ?>
</textarea>
 
    <br>
    <label>Délai</label>
    <input placeholder="Délai"  name="delai_etude" min="1" step="1" required  style="width:100px" type="number" value="<?php if (isset($_SESSION['delai_etude'])) echo $_SESSION['delai_etude']; ?>"  onblur="majAP()"/>
    <select class="formulaire" name="jour_semaine" size="1" style="width:100px"  onchange="majAP()">
      <OPTION value="1" <?php if((isset($_SESSION['jour_semaine']) && $_SESSION['jour_semaine']=="1") || !isset($_SESSION['jour_semaine'])) echo "selected";?>>jour(s)
      <OPTION value="2" <?php if(isset($_SESSION['jour_semaine']) && $_SESSION['jour_semaine']=="2" ) {?> selected <?php } ?>>semaines(s)
    </SELECT>
    </fieldset>
    <fieldset>
    	<legend>Qualité</legend>
          <label>Nom Prénom Chargé Qualité</label>
      <input name="nom_cq" required placeholder="Nom Chargé Qualité" type="text" value="<?php if (isset($_SESSION['nom_cq'])) echo $_SESSION['nom_cq']; ?>"/>
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