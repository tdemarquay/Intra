<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Avenant au Récapitulatif de Mission</h2>
<div align='center'>
  <form id="formARM" method="post" action="ARM/REFETUDE-NOMPRE-ARM.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majARM()">
      <br />
      <label>Numéro de l'avenant</label>
      <input name="numero_arm" placeholder="Numéro de l'avenant" tooltipText="S'il s'agit du premier Prêt de Licence de la mission, ça sera 1 et ainsi de suite." type="number" required  step="1" min="1"  max="99" value="<?php if (isset($_SESSION['numero_arm'])) echo $_SESSION['numero_arm']; ?>" />
    </fieldset>
    <fieldset>
      <legend>Type</legend>
      <label>CdP/Intervenant</label>
      <input name="cdp_intervenant" value="cdp" required onclick="majARM()" type="radio" style="width:20px" <?php if (isset($_SESSION['cdp_intervenant']) &&  $_SESSION['cdp_intervenant']=="cdp") echo "checked"; ?> />
      CdP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="cdp_intervenant" type="radio" value="intervenant" onclick="majARM()" style="width:20px"<?php if (isset($_SESSION['cdp_intervenant']) &&  $_SESSION['cdp_intervenant']=="intervenant") echo "checked"; ?> />
      Intervenant
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature</label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_arm" id="date_arm_id" type="text" value="<?php if (isset($_SESSION['date_arm'])) echo $_SESSION['date_arm']; else echo "";?>" onclick="new calendar(this)" onblur="majARM('date_arm')"/>
    </fieldset>
    <fieldset>
      <legend> Client</legend>
      <label>Nom de la Société (ou particulier)</label>
      <input placeholder="Nom de la société (ou du particulier)"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majARM()"/>
    </fieldset>
    <fieldset>
      <legend> Client</legend>
      <label>Nom de la Société</label>
      <input placeholder="Nom de la société (ou du particulier)"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majARM()"/>
    </fieldset>
    <fieldset>
      <legend>Etudiant</legend>
      <label >Nom étudiant</label>
      <input name="nom_etudiant" type="text" id="nom_idARM" value="<?php if (isset($_SESSION['nom_etudiant'])) echo $_SESSION['nom_etudiant']; ?>" required placeholder="Nom de l'étudiant" onblur="majARM()"/>
      <br />
      <label>Prénom étudiant</Label>
      <input name="prenom_etudiant" type="text" id="prenom_idARM" required placeholder="Prénom de l'étudiant" value="<?php if (isset($_SESSION['prenom_etudiant'])) echo $_SESSION['prenom_etudiant']; ?>"  onblur="majARM()"/>
      <br />
      <label>Adresse étudiant</label>
      <input name="adresse_etudiant" required id="adresse_idARM"  placeholder="Adresse de l'étudiant" type="text" value="<?php if (isset($_SESSION['adresse_etudiant'])) echo $_SESSION['adresse_etudiant']; ?>" onblur="majARM()"/>
      <br />
      <label>Code Postal Etudiant</label>
      <input name="cp_etudiant"  required="required" class="cp_idARM" placeholder="Code Postal de l'Etudiant" id="cp_arm" type="text" value="<?php if (isset($_SESSION['cp_etudiant'])) echo $_SESSION['cp_etudiant']; ?>" onblur="majARM()"/>
      <br />
      <label>Ville étudiant</label>
      <input name="ville_etudiant" id="ville_arm" class="ville_idARM"  type="text" value="<?php if (isset($_SESSION['ville_etudiant'])) echo $_SESSION['ville_etudiant']; ?>" required placeholder="Ville de l'étudiant" onblur="majARM()"/>
      <br />
      <label>Mail du étudiant</label>
      <input required name="mail_etudiant" id="mail_idARM" placeholder="Mail de l'étudiant" type="email" value="<?php if (isset($_SESSION['mail_etudiant'])) echo $_SESSION['mail_etudiant']; ?>"  onblur="majARM()"/>
      <br />
      <label>Téléphone du étudiant</label>
      <input name="tel_etudiant" required id="tel_idARM" placeholder="Téléphone Etudiant" type="tel" value="<?php if (isset($_SESSION['tel_etudiant'])) echo $_SESSION['tel_etudiant']; ?>" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" onblur="majARM()"/>
      <br />
      <label>Référence Convention Etudiante</label>
      <input name="ref_ce_etudiant" type="text" id="ref_ce_idARM" placeholder="Référence Convention Etudiante" value="<?php if (isset($_SESSION['ref_ce_etudiant'])) echo $_SESSION['ref_ce_etudiant']; ?>" onblur="majARM()" />
    </fieldset>
    <fieldset>
      <legend>Etude</legend>
      <label>Description (La mission consiste en ....)</label>
      <textarea rows="4"  name="description_etude_en" required placeholder="Description (La mission consiste en ....)" tooltipText="En quoi consiste la mission ?" onblur="majARM()"><?php if (isset($_SESSION['description_etude_en'])) echo $_SESSION['description_etude_en']; ?>
</textarea>
    </fieldset>
    <fieldset>
      <legend>Avenant</legend>
      <label>Changement de définition de la mission</label>
      <input name="definition_mission_arm" id="definition_mission_arm_id" value="1" type="checkbox" <?php if (isset($_SESSION['definition_mission_arm']) && $_SESSION['definition_mission_arm']=="1") echo "CHECKED"; ?> onchange="majARM()"/>
      <div id="definitionMissionDiv"> <br />
        <label>Description phases (S'engage à réaliser...)</label>
        <textarea name="description_phase_arm" required type="text" rows="4" placeholder="Description phases" value="" onblur="majARM()"><?php if (isset($_SESSION['description_phase_arm'])) echo $_SESSION['description_phase_arm']; ?>
</textarea>
      </div>
      <br />
      <label>Changement de délai de la mission</label>
      <input name="delai_mission_arm" id="delai_mission_arm_id" onchange="majARM()" value="1" type="checkbox" <?php if (isset($_SESSION['delai_mission_arm']) && $_SESSION['delai_mission_arm']=="1") echo "CHECKED"; ?> />
      <div id="delaiMissionDiv"> <br />
        <label>Nouvelle date de fin</label>
        <input style="cursor: pointer" placeholder="JJ/MM/AAAA" name="nouvelle_date_fin" type="text" value="<?php if (isset($_SESSION['nouvelle_date_fin'])) echo $_SESSION['nouvelle_date_fin']; else echo "";?>" onblur="majARM()" onclick="new calendar(this);"/>
      </div>
      <br />
      <label>Changement indemnisation</label>
      <input name="indemnisation_arm" id="indemnisation_arm_id" onchange="majARM()" value="1" type="checkbox" <?php if (isset($_SESSION['indemnisation_arm']) && $_SESSION['indemnisation_arm']=="1") echo "CHECKED"; ?> =/>
      <div id="indemnisationDiv"> <br />
        <label>Nouvelle indémnisation</label>
        <input name="nouvelle_indemnisation_arm" placeholder="Nouvelle indémnisation" type="number" min="0" step="0.01" onblur="majARM()" tooltipText="Nouvelle indémnisation" value="<?php if (isset($_SESSION['nouvelle_indemnisation_arm'])) echo $_SESSION['nouvelle_indemnisation_arm']; ?>" />
        <br />
        <label>Nouveau nombre JEH étudiant</label>
        <input name="jeh_arm" placeholder="Nouveau nombre de JEH" tooltipText="Combien de JEH sont attribués à cet étudiant ?" type="number" min="0" step="1" onblur="majARM()" value="<?php if (isset($_SESSION['jeh_arm'])) echo $_SESSION['jeh_arm']; ?>" />
      </div>
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