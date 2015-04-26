<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Convention Client</h2>
<div align='center'>
  <form id="formCC" method="post" action="CC/REFETUDE-CC.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majCC()">
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature </label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_cc" id="date_cc_id" type="text" value="<?php if (isset($_SESSION['date_cc'])) echo $_SESSION['date_cc']; else echo "";?>" onclick="new calendar(this);" onblur="majCC('date_cc')"/>
    </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_cc" size="1" onchange="majCC()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelCC">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majCC()"/>
      <br>
      <label id="adresseClientLabelCC">Adresse du client</label>
      <input placeholder="Adresse du client"  required="required"  name="adresse_client" type="text" value="<?php if (isset($_SESSION['adresse_client'])) echo $_SESSION['adresse_client']; ?>" onblur="majCC()"/>
      <br>
      <label id="cpClientLabelCC">Code Postal Client</label>
      <input placeholder="Code Postal Cient"  required="required"  name="cp_client" id="cp_cc"  type="text" value="<?php if (isset($_SESSION['cp_client'])) echo $_SESSION['cp_client']; ?>" onblur="majCC()"/>
      <br>
      <label id="villeClientLabelCC">Ville Client</label>
      <input placeholder="Ville du client"  required="required"  name="ville_client" id="ville_cc" type="text" value="<?php if (isset($_SESSION['ville_client'])) echo $_SESSION['ville_client']; ?>" onblur="majCC()"/>
      <div id="nomContactDivCC"><br>
        <label id="nomContactLabelCC">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majCC()"/>
      </div>
      <br>
      <label id="mailClientLabelCC">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majCC()"/>
      <br>
      <label id="telClientLabelCC">Téléphone Client</label>
      <input placeholder="Téléphone du client" name="tel_contact" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_contact'])) echo $_SESSION['tel_contact']; ?>" size="25" onblur="majCC()"/>
      <div id="qualiteContactDivCC"><br>
        <label>Qualité Contact de la Société</label>
        <input  placeholder="Qualité du contact"   tooltipText="Quel est le poste du contact dans l'entreprise cliente ?"  name="qualite_contact" type="text" value="<?php if (isset($_SESSION['qualite_contact'])) echo $_SESSION['qualite_contact']; ?>" onblur="majCC()"/>
      </div>
      <br>
      <label>Droit Communication</label>
      <input  tooltipText="Le client accepte-t-il que JEECE cite le nom de la société, le domaine de l'étude ainsi que donner un lien vers le rendu final et ceci à titre d'exemple de compétences ?" name="droit_communication" value="1" type="checkbox" <?php if (isset($_SESSION['droit_communication']) && $_SESSION['droit_communication']=="1") echo "CHECKED"; ?> size="25"/>
    </fieldset>
    <fieldset>
      <legend>CdP</legend>
      <label>Nom Prénom CdP</label>
      <input  placeholder="Nom Prénom Chef de Projet" id="nom_idCC" required name="nom_cdp" type="text" value="<?php if (isset($_SESSION['nom_cdp'])) echo $_SESSION['nom_cdp']; ?>" onblur="majCC()"/>
      <br>
      <label>Mail CdP</label>
      <input  placeholder="Mail du CdP" name="mail_cdp" id="mail_idCC" required type="email" value="<?php if (isset($_SESSION['mail_cdp'])) echo $_SESSION['mail_cdp']; ?>" onblur="majCC()"/>
      <br>
      <label>Téléphone CdP</label>
      <input placeholder="Téléphone du CdP" name="tel_cdp" id="tel_idCC" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_cdp'])) echo $_SESSION['tel_cdp']; ?>" onblur="majCC()"/>
    </fieldset>
    <fieldset>
      <legend>Etude</legend>
      <label>Description (JEECE réalisera pour NomClient ....)</label>
      <textarea  placeholder="Description Etude" name="description_etude" required type="text" onblur="majCC()"><?php if (isset($_SESSION['description_etude'])) echo $_SESSION['description_etude']; ?>
</textarea>
      <br>
      <label>Délai</label>
            <input placeholder="Délai" name="delai_etude" min="1" step="1" required  style="width:100px" type="number" value="<?php if (isset($_SESSION['delai_etude'])) echo $_SESSION['delai_etude']; ?>"  onblur="majCC()"/>
      <select class="formulaire" name="jour_semaine" size="1" style="width:100px"  onchange="majCC()">
        <OPTION value="1" <?php if((isset($_SESSION['jour_semaine']) && $_SESSION['jour_semaine']=="1") || !isset($_SESSION['jour_semaine'])) echo "selected";?>>jour(s)
        <OPTION value="2" <?php if(isset($_SESSION['jour_semaine']) && $_SESSION['jour_semaine']=="2" ) {?> selected <?php } ?>>semaines(s)
      </SELECT>
    </fieldset>
    <fieldset>
      <legend>Budget</legend>
      <label>Nombre de JEH</label>
      <input name="nombre_jeh_cc"  id="nombre_jeh_cc_id" min="1" type="number" required value="<?php if (isset($_SESSION['nombre_jeh_cc'])) echo $_SESSION['nombre_jeh_cc']; ?>" placeholder="Nombre de JEH" onblur="majCC()"/>
      <br>
      <label>Montant HT (sans les frais)</label>
      <input name="ht_sans_frais_cc"   id="ht_sans_frais_cc_id" min="0.01" required step="0.01" type="number" value="<?php if (isset($_SESSION['ht_sans_frais_cc'])) echo $_SESSION['ht_sans_frais_cc']; ?>" placeholder = "Montant HT"onblur="majCC()" />
      <br>
      <label>Montant HT des frais</label>
      <input style="width:100px" name="ht_frais_cc" tooltipText="Frais" id="ht_frais_cc_id" min="0" step="0.01" required type="number" value="<?php if (isset($_SESSION['ht_frais_cc'])) echo $_SESSION['ht_frais_cc']; ?>" placeholder="Frais HT"  onblur="majCC()"/>   <input style="width:100px" type="button" style="width:100px" value="Calculer" onClick="calculFrais();majCC()"/>
      <br>
      <label>Présence d'un acompte</label>
      <input name="presence_acompte" id="presence_acompte_cc_id" value="1" type="checkbox" <?php if (isset($_SESSION['presence_acompte']) && $_SESSION['presence_acompte']=="1") echo "CHECKED"; ?> onchange="majCC()"/>
      <div id="acompteDivCC"><br>
        <label>Montant HT de l'acompte</label>
        <input style="width:100px" tooltipText="Acompte" name="ht_acompte_cc"  id="ht_acompte_id" min="0" step="0.01" type="number" value="<?php if (isset($_SESSION['ht_acompte_cc'])) echo $_SESSION['ht_acompte_cc']; ?>" onblur="majCC()"/>   <input style="width:100px" type="button" style="width:100px" style="width:100px" value="Calculer" onClick="calculAcompte();majCC()"/>
      </div>
      <br>
      <label>Nombre de livrables intermédiaires</label>
      <select class="formulaire" name="nombre_livrable_intermediaire"  onchange="majCC()"  id="nombre_livrable_intermediaire_cc_id" size="1">
        <OPTION value="0" <?php if((isset($_SESSION['nombre_livrable_intermediaire']) && $_SESSION['nombre_livrable_intermediaire']=="0") || !isset($_SESSION['nombre_livrable_intermediaire'])) {?> selected <?php } ?>>0
        <OPTION value="1" <?php if(isset($_SESSION['nombre_livrable_intermediaire']) && $_SESSION['nombre_livrable_intermediaire']=="1") {?> selected <?php } ?>>1
        <OPTION value="2" <?php if(isset($_SESSION['nombre_livrable_intermediaire']) && $_SESSION['nombre_livrable_intermediaire']=="2") {?> selected <?php } ?>>2
        <OPTION value="3" <?php if(isset($_SESSION['nombre_livrable_intermediaire']) && $_SESSION['nombre_livrable_intermediaire']=="3") {?> selected <?php } ?>>3
        <OPTION value="4" <?php if(isset($_SESSION['nombre_livrable_intermediaire']) && $_SESSION['nombre_livrable_intermediaire']=="4") {?> selected <?php } ?>>4
      </SELECT>
      <div id="lot1DivCC"><br>
      <label>Montant HT du lot 1</label>
      <input name="ht_lot_1" id="ht_lot_1_id" placeholder="Montant HT du lot 1" min="0" step="0.01" type="number" value="<?php if (isset($_SESSION['ht_lot_1'])) echo $_SESSION['ht_lot_1']; ?>"  onblur="majCC()"/>
      <br>
      <label>Nombre de JEH du lot 1</label>
      <input name="jeh_lot_1" id="jeh_lot_1_id" min="1" step="1" placeholder="Nombre de JEH du lot 1" type="number" value="<?php if (isset($_SESSION['jeh_lot_1'])) echo $_SESSION['jeh_lot_1']; ?>"  onblur="majCC()" /></div>
      <div id="lot2DivCC"><br>
      <label>Montant HT du lot 2</label>
      <input name="ht_lot_2" id="ht_lot_2_id"min="0" placeholder="Montant HT du lot 2" step="0.01" type="number" value="<?php if (isset($_SESSION['ht_lot_2'])) echo $_SESSION['ht_lot_2']; ?>" onblur="majCC()"/>
      <br>
      <label>Nombre de JEH du lot 2</label>
      <input name="jeh_lot_2" id="jeh_lot_2_id"min="1" step="1" type="number" placeholder="Nombre de JEH du lot 2" value="<?php if (isset($_SESSION['jeh_lot_2'])) echo $_SESSION['jeh_lot_2']; ?>"  onblur="majCC()" /></div>
      <div id="lot3DivCC"><br>
      <label>Montant HT du lot 3</label>
      <input name="ht_lot_3" id="ht_lot_3_id" min="0" step="0.01" placeholder="Montant HT du lot 3" type="number" value="<?php if (isset($_SESSION['ht_lot_3'])) echo $_SESSION['ht_lot_3']; ?>"  onblur="majCC()"/>
      <br>
      <label>Nombre de JEH du lot 3</label>
      <input name="jeh_lot_3" id="jeh_lot_3_id" min="1" step="1" type="number" placeholder="Nombre de JEH du lot 3" value="<?php if (isset($_SESSION['jeh_lot_3'])) echo $_SESSION['jeh_lot_3']; ?>"  onblur="majCC()" /></div>
      <div id="lot4DivCC"><br>
      <label>Montant HT du lot 4</label>
      <input name="ht_lot_4" id="ht_lot_4_id" min="0" step="0.01" type="number" placeholder="Montant HT du lot 4" value="<?php if (isset($_SESSION['ht_lot_4'])) echo $_SESSION['ht_lot_4']; ?>"  onblur="majCC()"/>
      <br>
      <label>Nombre de JEH du lot 4</label>
      <input name="jeh_lot_4" id="jeh_lot_4_id" min="1" step="1" type="number" placeholder="Nombre de JEH du lot 4" value="<?php if (isset($_SESSION['jeh_lot_4'])) echo $_SESSION['jeh_lot_4']; ?>"  onblur="majCC()" /></div>
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