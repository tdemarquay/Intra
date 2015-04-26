<?php
if(session_id() == "") session_start();
if(!isset($_SESSION['id']))
header("location: ../../index.php?error=2");
?>
<h2> Rapport Pédagogique</h2>
<div align='center'>
  <form id="formRP" method="post" action="RP/REFETUDE-RP.php" align='center'>
    <fieldset>
      <legend>Référence</legend>
      <label>Référence Etude</label>
      <input placeholder="Référence Etude" required pattern="[A-Z]{3,5}[0-9]{2}" title="test" tooltipText="Sous la forme REFETXX. REFET correspond aux 5 premières lettres du nom de la société. XX vaudra 01 si c'est la première mission pour ce client. " name="refetude" type="text" value="<?php if (isset($_SESSION['refetude'])) echo $_SESSION['refetude']; ?>" onblur="majRP()">
    </fieldset>
    <fieldset>
      <legend>Date</legend>
      <label>Date Signature </label>
      <input placeholder="JJ/MM/AAAA"  required="required"  pattern="^(((((0[1-9])|(1\d)|(2[0-8]))\/((0[1-9])|(1[0-2])))|((31\/((0[13578])|(1[02])))|((29|30)\/((0[1,3-9])|(1[0-2])))))\/((20[0-9][0-9])|(19[0-9][0-9])))|((29\/02\/(19|20)(([02468][048])|([13579][26]))))$  " style="cursor: pointer" name="date_rp" id="date_rp_id" type="text" value="<?php if (isset($_SESSION['date_rp'])) echo $_SESSION['date_rp']; else echo "";?>" onclick="new calendar(this)" onblur="majRP('date_rp')"/>
    </fieldset>
    <fieldset>
      <legend>Client</legend>
      <label>Société/Particulier</label>
      <select class="formulaire" name="societe_particulier" id="menu_societe_particulier_cc" size="1" onchange="majRP()" >
        <OPTION value="societe" <?php if((isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="societe") || !isset($_SESSION['societe_particulier'])) echo"selected" ?>>Société
        <OPTION value="particulier" <?php if(isset($_SESSION['societe_particulier']) && $_SESSION['societe_particulier']=="particulier") echo "selected"; ?>>Particulier
      </select>
      <br>
      <label id="nomClientLabelRP">Nom de la Société</label>
      <input placeholder="Nom du client"  required="required"  name="nom_societe" type="text" value="<?php if (isset($_SESSION['nom_societe'])) echo $_SESSION['nom_societe']; ?>" onblur="majRP()"/>
      <br>
      <label id="adresseClientLabelRP">Adresse du client</label>
      <input placeholder="Adresse du client"  required="required"  name="adresse_client" type="text" value="<?php if (isset($_SESSION['adresse_client'])) echo $_SESSION['adresse_client']; ?>" onblur="majRP()"/>
      <br>
      <label id="cpClientLabelRP">Code Postal Client</label>
      <input placeholder="Code Postal Cient"  required="required"  name="cp_client" id="cp_rp"  type="text" value="<?php if (isset($_SESSION['cp_client'])) echo $_SESSION['cp_client']; ?>" onblur="majRP()"/>
      <br>
      <label id="villeClientLabelRP">Ville Client</label>
      <input placeholder="Ville du client"  required="required"  name="ville_client" id="ville_rp" type="text" value="<?php if (isset($_SESSION['ville_client'])) echo $_SESSION['ville_client']; ?>" onblur="majRP()"/>
      <div id="nomContactDivRP"><br>
        <label id="nomContactLabelRP">Nom Contact Société</label>
        <input placeholder="Nom du contact" name="nom_contact" type="text" value="<?php if (isset($_SESSION['nom_contact'])) echo $_SESSION['nom_contact']; ?>" onblur="majRP()"/>
      </div>
      <br>
      <label id="mailClientLabelRP">Mail Client</label>
      <input  placeholder="Mail du client"  required="required"  name="mail_contact" type="email" value="<?php if (isset($_SESSION['mail_contact'])) echo $_SESSION['mail_contact']; ?>" onblur="majRP()"/>
      <br>
      <label id="telClientLabelRP">Téléphone Client</label>
      <input placeholder="Téléphone du client" name="tel_contact" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" required type="tel" value="<?php if (isset($_SESSION['tel_contact'])) echo $_SESSION['tel_contact']; ?>"  onblur="majRP()"/>
    </fieldset>
    <fieldset>
      <legend>Etudiant</legend>
      <label >Nom étudiant</label>
      <input name="nom_etudiant" type="text" id="nom_idRP" value="<?php if (isset($_SESSION['nom_etudiant'])) echo $_SESSION['nom_etudiant']; ?>" required placeholder="Nom de l'étudiant" onblur="majRP()"/>
      <br />
      <label>Prénom étudiant</Label>
      <input name="prenom_etudiant" type="text" id="prenom_idRP" required placeholder="Prénom de l'étudiant" value="<?php if (isset($_SESSION['prenom_etudiant'])) echo $_SESSION['prenom_etudiant']; ?>"  onblur="majRP()"/>
      <br />
      <label>Adresse étudiant</label>
      <input name="adresse_etudiant" required id="adresse_idRP" placeholder="Adresse de l'étudiant" type="text" value="<?php if (isset($_SESSION['adresse_etudiant'])) echo $_SESSION['adresse_etudiant']; ?>" onblur="majRP()"/>
      <br />
      <label>Code Postal Etudiant</label>
      <input name="cp_etudiant"  required="required" class="cp_idRP" placeholder="Code Postal de l'Etudiant" id="cp_rp" type="text" value="<?php if (isset($_SESSION['cp_etudiant'])) echo $_SESSION['cp_etudiant']; ?>" onblur="majRP()"/>
      <br />
      <label>Ville étudiant</label>
      <input name="ville_etudiant" id="ville_rp" class="ville_idRP"  type="text" value="<?php if (isset($_SESSION['ville_etudiant'])) echo $_SESSION['ville_etudiant']; ?>" required placeholder="Ville de l'étudiant" onblur="majRP()"/>
      <br />
      <label>Mail du étudiant</label>
      <input required name="mail_etudiant" id="mail_idRP" placeholder="Mail de l'étudiant" type="email" value="<?php if (isset($_SESSION['mail_etudiant'])) echo $_SESSION['mail_etudiant']; ?>"  onblur="majRP()"/>
      <br />
      <label>Téléphone du étudiant</label>
      <input name="tel_etudiant" required id="tel_idRP" placeholder="Téléphone Etudiant" type="tel" value="<?php if (isset($_SESSION['tel_etudiant'])) echo $_SESSION['tel_etudiant']; ?>" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$" onblur="majRP()"/>
      <br />
      <label>Référence Convention Etudiante</label>
      <input name="ref_ce_etudiant" type="text" id="ref_ce_idRP" placeholder="Référence Convention Etudiante" value="<?php if (isset($_SESSION['ref_ce_etudiant'])) echo $_SESSION['ref_ce_etudiant']; ?>" onblur="majRP()" />
      <br />
      <label>Promotion (ING?)</label>
      <input name="promotion_intervenant" id="promo_idRP" placeholder="Promotion" min="1" max="6" required  step = "1" type="number" value="<?php if (isset($_SESSION['promotion_intervenant'])) echo $_SESSION['promotion_intervenant']; ?>"/>
    </fieldset>
    <fieldset>
      <legend>Etude</legend>
      <label>Description du contexte et des enjeux (objectifs) de l'étude</label>
      <textarea placeholder="Description du contexte et des enjeux (objectifs) de l'étude" name="contexte_enjeux" onblur="majRP()" required  rows="4"><?php if (isset($_SESSION['contexte_enjeux'])) echo $_SESSION['contexte_enjeux']; ?>
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
