<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Questionnaire Satisfaction Intervenant</h2>
<div align='center'>
  <form id="formSAT_INT" method="post" action="SAT_INT/REFETUDE-NOMPRE-SAT_INT.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majSAT_INT()">
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature </label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_sat_int" id="date_sat_int_id" type="text" value="<?php if (isset($_SESSION['date_sat_int'])) echo $_SESSION['date_sat_int']; else echo "";?>" onclick="new calendar(this)" onblur="majSAT_INT()"/>
      <br />
      <label>Date Fin Mission </label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_fin_mission" id="date_fin_mission_id" type="text" value="<?php if (isset($_SESSION['date_fin_mission'])) echo $_SESSION['date_fin_mission']; else echo "";?>" onclick="new calendar(this)" onblur="majSAT_INT()"/>
    </fieldset>
    <fieldset>
      <legend>Intervenant</legend>
      <label >Nom intervenant</label>
      <input name="nom_intervenant" type="text" id="nom_idSAT_INT" value="<?php if (isset($_SESSION['nom_intervenant'])) echo $_SESSION['nom_intervenant']; ?>" required placeholder="Nom de l'intervenant" onblur="majSAT_INT()"/>
      <br />
      <label>Prénom intervenant</Label>
      <input name="prenom_intervenant" type="text" id="prenom_idSAT_INT" required placeholder="Prénom de l'intervenant" value="<?php if (isset($_SESSION['prenom_intervenant'])) echo $_SESSION['prenom_intervenant']; ?>"  onblur="majSAT_INT()"/>
      <br />
      <label>Adresse intervenant</label>
      <input name="adresse_intervenant" required id="adresse_idSAT_INT" placeholder="Adresse de l'intervenant" type="text" value="<?php if (isset($_SESSION['adresse_intervenant'])) echo $_SESSION['adresse_intervenant']; ?>" onblur="majSAT_INT()"/>
      <br />
      <label>Code Postal Etudiant</label>
      <input name="cp_intervenant"  required="required" class="cp_idSAT_INT" placeholder="Code Postal de l'Etudiant" id="cp_sat_int" type="text" value="<?php if (isset($_SESSION['cp_intervenant'])) echo $_SESSION['cp_intervenant']; ?>" onblur="majSAT_INT()"/>
      <br />
      <label>Ville intervenant</label>
      <input name="ville_intervenant" id="ville_sat_int" class="ville_idSAT_INT" type="text" value="<?php if (isset($_SESSION['ville_intervenant'])) echo $_SESSION['ville_intervenant']; ?>" required placeholder="Ville de l'intervenant" onblur="majSAT_INT()"/>
      <br />
      <label>Référence Convention Etudiante</label>
      <input name="ref_ce_intervenant" type="text" id="ref_ce_idSAT_INT" placeholder="Référence Convention Etudiante" value="<?php if (isset($_SESSION['ref_ce_intervenant'])) echo $_SESSION['ref_ce_intervenant']; ?>" onblur="majSAT_INT()" />
      <br />
      <label>Promotion (ING?)</label>
      <input name="promotion_intervenant" id="promo_idSAT_INT" placeholder="Promotion" min="1" max="6" required  step = "1" type="number" value="<?php if (isset($_SESSION['promotion_intervenant'])) echo $_SESSION['promotion_intervenant']; ?>"/>
    </fieldset>
    <fieldset>
      <legend> CdP </legend>
      <label>Nom Prénom CdP</label>
      <input name="nom_cdp" required placeholder="Nom CdP" type="text" value="<?php if (isset($_SESSION['nom_cdp'])) echo $_SESSION['nom_cdp']; ?>"/>
    </fieldset>
    <fieldset>
      <legend> Chargé Qualité </legend>
      <label>Nom Prénom Chargé Qualité</label>
      <input name="nom_cq" required placeholder="Nom Chargé Qualité" type="text" value="<?php if (isset($_SESSION['nom_cq'])) echo $_SESSION['nom_cq']; ?>"/>
    </fieldset>
    <tr>
      <td colspan="3"><input type="submit" name="btn_go" value="Générer" style="width:800px;height:60px"/></td>
    </tr>
    </table>
  </form>
</div>
