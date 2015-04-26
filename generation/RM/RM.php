<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Récapitulatif de Mission</h2>
<div align='center'>
  <form id="formRM" method="post" action="RM/REFETUDE-NOMPRE-RM.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majRM()">
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
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_rm" id="date_rm_id" type="text" value="<?php if (isset($_SESSION['date_rm'])) echo $_SESSION['date_rm']; else echo "";?>" onclick="new calendar(this)" onblur="majRM('date_rm')"/>
    </fieldset>
    <fieldset>
      <legend> Client</legend>
      <label>Nom de la Société (ou particulier)</label>
      <input placeholder="Nom de la société (ou du particulier)"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majRM()"/>
    </fieldset>
    <fieldset>
      <legend>Etudiant</legend>
      <label >Nom étudiant</label>
      <input name="nom_etudiant" type="text" class="nom_etu_class" id="nom_idRM" value="<?php if (isset($_SESSION['nom_etudiant'])) echo $_SESSION['nom_etudiant']; ?>" required placeholder="Nom de l'étudiant" onblur="majRM()"/>
      <br />
      <label>Prénom étudiant</Label>
      <input name="prenom_etudiant" type="text" id="prenom_idRM" required placeholder="Prénom de l'étudiant" value="<?php if (isset($_SESSION['prenom_etudiant'])) echo $_SESSION['prenom_etudiant']; ?>"  onblur="majRM()"/>
      <br />
      <label>Adresse étudiant</label>
      <input name="adresse_etudiant" required  id="adresse_idRM" placeholder="Adresse de l'étudiant" type="text" value="<?php if (isset($_SESSION['adresse_etudiant'])) echo $_SESSION['adresse_etudiant']; ?>" onblur="majRM()"/>
      <br />
      <label>Code Postal Etudiant</label>
      <input name="cp_etudiant"  required="required" class="cp_idRM" placeholder="Code Postal de l'Etudiant" id="cp_rmcdp" type="text" value="<?php if (isset($_SESSION['cp_etudiant'])) echo $_SESSION['cp_etudiant']; ?>" onblur="majRM()"/>
      <br />
      <label>Ville étudiant</label>
      <input name="ville_etudiant" id="ville_rmcdp" type="text" class="ville_idRM" value="<?php if (isset($_SESSION['ville_etudiant'])) echo $_SESSION['ville_etudiant']; ?>" required placeholder="Ville de l'étudiant" onblur="majRM()"/>
      <br />
      <label>Mail du étudiant</label>
      <input required name="mail_etudiant" id="mail_idRM" placeholder="Mail de l'étudiant" type="email" value="<?php if (isset($_SESSION['mail_etudiant'])) echo $_SESSION['mail_etudiant']; ?>"  onblur="majRM()"/>
      <br />
      <label>Téléphone du étudiant</label>
      <input name="tel_etudiant" required id="tel_idRM" placeholder="Téléphone Etudiant" type="tel" value="<?php if (isset($_SESSION['tel_etudiant'])) echo $_SESSION['tel_etudiant']; ?>" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" onblur="majRM()"/>
      <br />
      <label>Référence Convention Etudiante</label>
      <input name="ref_ce_etudiant" type="text" id="ref_ce_idRM" placeholder="Référence Convention Etudiante" value="<?php if (isset($_SESSION['ref_ce_etudiant'])) echo $_SESSION['ref_ce_etudiant']; ?>" onblur="majRM()" />
    </fieldset>
    <fieldset>
      <legend>Etude</legend>
      <label>Description (La mission consiste en ....)</label>
      <textarea rows="4"  name="description_etude_en" required placeholder="Description (La mission consiste en ....)" tooltipText="En quoi consiste la mission ?" onblur="majRM()"><?php if (isset($_SESSION['description_etude_en'])) echo $_SESSION['description_etude_en']; ?>
</textarea>
      <br/>
      <label>Date de fin d'étude</label>
      <input required style="cursor: pointer" placeholder="JJ/MM/AAAA" name="date_fin_theorique_etude"  onblur="majRM()" type="text"  value="<?php if (isset($_SESSION['date_fin_theorique_etude'])) echo $_SESSION['date_fin_theorique_etude']; else echo "";?>" onclick="new calendar(this);" pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  "/>
    </fieldset>
    <fieldset>
      <legend>Rénumération</legend>
      <label>Nombre de JEH</label>
      <input name="nombre_jeh_cdp" min="1"  onblur="majRM()" step = "1" type="number" value="<?php if (isset($_SESSION['nombre_jeh_cdp'])) echo $_SESSION['nombre_jeh_cdp']; ?>" required  placeholder="Nombre de JEH" tooltipText="Nombre de JEH pour cet étudiant"/>
      <br />
      <label>Rénumération Brute</label>
      <input name="renumeration_brute_cdp"  onblur="majRM()" min="0" placeholder="Rénumération brute de l'étudiant" step="0.01" tooltipText="Rénumération brute de l'étudiant. C'est la somme du montant de tous les JEH de l'étudiant multiplié par " type="number" value="<?php if (isset($_SESSION['renumeration_brute_cdp'])) echo $_SESSION['renumeration_brute_cdp']; ?>" required/>
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