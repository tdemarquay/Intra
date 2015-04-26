<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>


<h2> Avenant Client</h2>
<div align='center'>
  <form id="formAC" method="post" action="AC/REFETUDE-ACxx.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majAC()">
      <br />
      <label>Numéro du AC</label>
      <input placeholder="Numéro de l'avenant" name="numero_ac" tooltipText="S'il s'agit du premier Avenant de la mission, ça sera 1 et ainsi de suite." type="number" step="1" min="1"  max="99" value="<?php if (isset($_SESSION['numero_ac'])) echo $_SESSION['numero_ac']; ?>" required onblur="majAC()"/>
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature</label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_ac" id="date_ac_id" type="text" value="<?php if (isset($_SESSION['date_ac'])) echo $_SESSION['date_ac']; else echo "";?>" onclick="new calendar(this)" onblur='majAC("date_ac")'/>
      <br />
      <label>Date Signature CC</label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_cc" id="date_cc_id" type="text" value="<?php if (isset($_SESSION['date_cc'])) echo $_SESSION['date_cc']; else echo "";?>" onclick="new calendar(this)" onblur="majAC()"/>
    </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_AC" size="1" onchange="majAC()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelAC">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majAC()"/>
      <br>
      <label id="adresseClientLabelAC">Adresse du client</label>
      <input placeholder="Adresse du client"  required="required"  name="adresse_client" type="text" value="<?php if (isset($_SESSION['adresse_client'])) echo $_SESSION['adresse_client']; ?>" onblur="majAC()"/>
      <br>
      <label id="cpClientLabelAC">Code Postal Client</label>
      <input placeholder="Code Postal Cient"  required="required"  name="cp_client" id="cp_ac"  type="text" value="<?php if (isset($_SESSION['cp_client'])) echo $_SESSION['cp_client']; ?>" onblur="majAC()"/>
      <br>
      <label id="villeClientLabelAC">Ville Client</label>
      <input placeholder="Ville du client"  required="required"  name="ville_client" id="ville_ac" type="text" value="<?php if (isset($_SESSION['ville_client'])) echo $_SESSION['ville_client']; ?>" onblur="majAC()"/>
      <div id="nomContactDivAC"><br>
        <label id="nomContactLabelAC">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majAC()"/>
      </div>
      <br>
      <label id="mailClientLabelAC">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majAC()"/>
      <br>
      <label id="telClientLabelAC">Téléphone Client</label>
      <input placeholder="Téléphone du client" name="tel_contact" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_contact'])) echo $_SESSION['tel_contact']; ?>"  onblur="majAC()"/>
      <div id="qualiteContactDivAC"><br>
        <label>Qualité Contact de la Société</label>
        <input  placeholder="Qualité du contact"   tooltipText="Quel est le poste du contact dans l'entreprise cliente ?"  name="qualite_contact" type="text" value="<?php if (isset($_SESSION['qualite_contact'])) echo $_SESSION['qualite_contact']; ?>" onblur="majAC()"/>
      </div>
    </fieldset>
    <fieldset>
      <legend>CdP</legend>
      <label>Nom Prénom CdP</label>
      <input  placeholder="Nom Prénom Chef de Projet" id="nom_idAC" required name="nom_cdp" type="text" value="<?php if (isset($_SESSION['nom_cdp'])) echo $_SESSION['nom_cdp']; ?>" onblur="majAC()"/>
      <br>
      <label>Mail CdP</label>
      <input  placeholder="Mail du CdP" name="mail_cdp" id="mail_idAC" required type="email" value="<?php if (isset($_SESSION['mail_cdp'])) echo $_SESSION['mail_cdp']; ?>" onblur="majAC()"/>
      <br>
      <label>Téléphone CdP</label>
      <input placeholder="Téléphone du CdP" name="tel_cdp" id="tel_idAC" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_cdp'])) echo $_SESSION['tel_cdp']; ?>" onblur="majAC()"/>
    </fieldset>
    <fieldset>
      <legend>Avenant</legend>
      <label>Motif de l'avenant (En raison de... par exemple)</label>
      <input name="objet_avenant" placeholder="Motif de l'avenant" onblur="majAC()" required type="text" value="<?php if (isset($_SESSION['objet_avenant'])) echo $_SESSION['objet_avenant']; ?>" tooltipText="Pourquoi doit-on faire cet avenant ?"/>
      <br />
      <label>Délai modifié</label>
      <input name="modification_delai" id="modification_delai" onchange="majAC()" value="1" type="checkbox" <?php if (isset($_SESSION['modification_delai']) && $_SESSION['modification_delai']=="1") echo "CHECKED"; ?> />
      <div id="delaiModifieDiv"><br />
      <label>Nouvelle date de fin</label>
      <input style="cursor: pointer" required name="date_fin_theorique_ac" type="text" value="<?php if (isset($_SESSION['date_fin_theorique_ac'])) echo $_SESSION['date_fin_theorique_ac']; else echo "";?>" pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  "  onclick="new calendar(this);" placeholder="JJ/MM/AAAA" onblur="majAC()"/></div>
      <br />
      <label>Budget modifié</label>
      <input name="modification_budget" id="modification_budget" onchange="majAC()" value="1" type="checkbox" <?php if (isset($_SESSION['modification_budget']) && $_SESSION['modification_budget']=="1") echo "CHECKED"; ?>/>
      <div id="budgetModifieDiv"><br />
      <label>Nouveau montant HT</label>
      <input name="ht_ac" min="0"  step="0.01" type="number" value="<?php if (isset($_SESSION['ht_ac'])) echo $_SESSION['ht_ac']; ?>" required placeholder="Nouveau montant HT" onblur="majAC()"/>
      <br />
      <label>Nouveau nombre de JEH</label>
      <input name="nombre_jeh_ac" min="0" type="number" step="1" value="<?php if (isset($_SESSION['nombre_jeh_ac'])) echo $_SESSION['nombre_jeh_ac']; ?>" required placeholder="Nouveau nombre de JEH" onblur="majAC()"/>
      <br />
      <label>Numéro du devis</label>
      <input name="numero_devis_ac" type="number" required placeholder="Numéro du devis" step="1" min="1"  max="99" value="<?php if (isset($_SESSION['numero_devis_ac'])) echo $_SESSION['numero_devis_ac']; ?>" tooltipText="Comme le montant de l'étude est modifié, un nouveau devis a du être réalisé. Ce numéro correspond au numéro du devis, s'il s'agit du deuxième devis de l'étude, ça sera 2" onblur="majAC()"/></div>
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