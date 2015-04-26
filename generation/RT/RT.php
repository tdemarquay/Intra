<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Rapport Technique</h2>
<div align='center'>
  <form id="formRT" method="post" action="RT/REFETUDE-RT.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majRT()">
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature</label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_rt" id="date_rt_id" type="text" value="<?php if (isset($_SESSION['date_rt'])) echo $_SESSION['date_rt']; else echo "";?>" onclick="new calendar(this)" onblur="majRT()"/>
    </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_cc" size="1" onchange="majRT()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelRT">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majRT()"/>
      <br>
      <label id="adresseClientLabelRT">Adresse du client</label>
      <input placeholder="Adresse du client"  required="required"  name="adresse_client" type="text" value="<?php if (isset($_SESSION['adresse_client'])) echo $_SESSION['adresse_client']; ?>" onblur="majRT()"/>
      <br>
      <label id="cpClientLabelRT">Code Postal Client</label>
      <input placeholder="Code Postal Cient"  required="required"  name="cp_client" id="cp_rt"  type="text" value="<?php if (isset($_SESSION['cp_client'])) echo $_SESSION['cp_client']; ?>" onblur="majRT()"/>
      <br>
      <label id="villeClientLabelRT">Ville Client</label>
      <input placeholder="Ville du client"  required="required"  name="ville_client" id="ville_rt" type="text" value="<?php if (isset($_SESSION['ville_client'])) echo $_SESSION['ville_client']; ?>" onblur="majRT()"/>
      <div id="nomContactDivRT"><br>
        <label id="nomContactLabelRT">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majRT()"/>
      </div>
      <br>
      <label id="mailClientLabelRT">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majRT()"/>
      <br>
      <label id="telClientLabelRT">Téléphone Client</label>
      <input placeholder="Téléphone du client" name="tel_contact" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_contact'])) echo $_SESSION['tel_contact']; ?>"  onblur="majRT()"/>
    </fieldset>
    <fieldset>
      <legend>Etude</legend>
      <label>Description du contexte et des enjeux (objectifs) de l'étude</label>
      <textarea placeholder="Description du contexte et des enjeux (objectifs) de l'étude" name="contexte_enjeux" onblur="majRT()" required  rows="4"><?php if (isset($_SESSION['contexte_enjeux'])) echo $_SESSION['contexte_enjeux']; ?>
</textarea>
      <br />
      <label>Nom Prénom Chargé Qualité</label>
      <input name="nom_cq" required placeholder="Nom Chargé Qualité" type="text" value="<?php if (isset($_SESSION['nom_cq'])) echo $_SESSION['nom_cq']; ?>"/>
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