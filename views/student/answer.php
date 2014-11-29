<?php
use app\models\Student;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\Student */
$_SESSION = Yii::$app->session;
?>
<script type="text/javascript" src="js/interfaceIE.js"></script>
<link rel="stylesheet" type="text/css" href="css/new.css">

<div class="contents">
<?php $form = ActiveForm::begin(['options' => ['name' => 'info']]); ?>
<div class="column column-half">
<?php print(ucfirst($_SESSION['first_name']));?>
<p>Exercice No
<!--<?php //echo ($_SESSION["totalExo"]-$nbExo+1); ?>-->
</p>

<p>
<?php
$text = "Maurice a 15 vaches. Il se marie avec Jacquotte, qui vit dans la ferme voisine. Ils decident de faire paitre leurs vaches dans le meme pre. Maintenant, il y a 24 vaches qui paissent dans le pre. Combien de vaches Jacquotte a apportee en dot ?";//$problem['statement'];
$idpbm = 1;//$problem['id'];
$id = 0;
for($piece = strtok($text, " "), $i=1 ; $piece != "" ; $piece = strtok(" "))
{
	$id++;
	$piece1 = $piece;
	$piece = str_replace("\\","",$piece);
	if($piece1==".") $i=0;
	print("<a href=\"javascript:;\" id=\"".$id."\"
		onClick=\"insererSas('".trim($piece1)." "."','".$i."');
		\" class=\"enonce\">".$piece."</a>"." ");
	$i++;
}
print("<Br>");
?>
</p>

<hr />
<p>
<strong>Pour &eacute;crire, tu peux cliquer sur les mots de l'&eacute;nonc&eacute;</strong>
</p>
<p>
<input name="T1" type="text" class="wide" <?php if (isset($precedent)) echo('value="'.$sas.'"'); else echo('value=""');?> class="champText" id="sas" onFocus="monTour(5);colorFocus('sas');" onBlur="colorBlur('sas');">
</p>
<p>
<input name="efface5" type="button" class="bouton"  onClick="document.info.T1.value='';document.info.T1.focus();" value="Effacer tout">
<input type="button" class="bouton" name="annuler2" value="Annuler" onClick="annulerSas();">
<input name="button2" type="button" class="bouton"  onClick="inserer(document.info.T1.value);" value="Ecrire dans la feuille">
</p>
<hr />


<?php
// ==============================================
// CALCULATOR
// ==============================================
?>
<table <?php //echo (($audio ? 'left' : 'center')); ?>>
<tr valign="middle">
<td colspan="4" align="center">
<p><strong>Tu peux &eacute;crire tes calculs ici :<strong></p>
</td>
</tr>
<tr valign="middle">
<td colspan="4" align="center"><input name="egale2" type="button" class="Boutegal" onClick="if (tester == 5) {calculSas();} else {resultat();}" value=" = "></td>
</tr>
<tr>
<td width="35" align="center" valign="middle"><input name="un" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('1');} else {afficher(1);}" value="1"></td>
<td width="27" align="center" valign="middle"><input name="deux" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('2');} else {afficher(2);}" value="2"></td>
<td width="27" align="center" valign="middle"><input name="trois" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('3');} else {afficher(3);}" value="3"></td>
<td width="35" align="center" valign="middle">			
<input name="plus" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas(' + ');} else if (tester == 1){afficher(' + ');};" value=" + "></td>
</tr>
<tr>
<td align="center" valign="middle"><input name="quatre" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('4');} else {afficher(4);}" value="4"></td>
<td align="center" valign="middle"><input name="cinq" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('5');} else {afficher(5);}" value="5"></td>
<td align="center" valign="middle"><input name="six" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('6');} else {afficher(6);}" value="6"></td>
<td align="center" valign="middle"><input name="moin" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas(' - ');} else if (tester == 1){afficher(' - ');};" value=" - "></td>
</tr>
<tr>
<td align="center" valign="middle"><input name="sept" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('7');} else {afficher(7);}" value="7"></td>
<td align="center" valign="middle"><input name="huit" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('8');} else {afficher(8);}" value="8"></td>
<td align="center" valign="middle"><input name="neuf" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('9');} else {afficher(9);}" value="9"></td>
<td align="center" valign="middle"><input name="div" type="button" class="Boutcal"  id="div" onClick="if (tester == 5) {insererSas(' : ');} else if (tester == 1){afficher(' : ');};" value=" : "></td>
</tr>
<tr>
<td align="center" valign="middle"><input name="zero" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas('0');} else {afficher(0);}" value="0"></td>
<td align="center" valign="middle"><input name="paro" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas(' ( ');} else if (tester == 1){afficher(' ( ');};" value=" ( "></td>
<td align="center" valign="middle"><input name="parf" type="button" class="Boutcal" onClick="if (tester == 5) {insererSas(' ) ');} else if (tester == 1){afficher(' ) ');};" value=" ) "></td>
<td align="center" valign="middle"><input name="mult" type="button" class="Boutcal" id="mult" onClick="if (tester == 5) {insererSas(' x ');} else if (tester == 1){afficher(' x ');};" value=" x "></td>
</tr>
</table>
<?php
// ==============================================
// CALCULATOR - END
// ==============================================
?>
<?php //PHP AUDIO ICI ?>
</div>

<div class="column column-half">
<hr />
<p><strong>&Eacute;cris tes calculs et ta r&eacute;ponse dans cette feuille :</strong></p>
<p>
<input name="effacer" type="button" class="bouton" id="effacer2"
onClick="document.info.zonetexte.value='';document.info.zonetexte.focus();" value="Effacer toute la feuille">        
<input name="retour" type="button" class="bouton" onClick="inserer('\n');document.info.zonetexte.focus();" value="Passer &agrave; la ligne">
<input name="annuler" type="button" class="bouton" id="annuler" onClick="if (feuille.isContentEditable==true) annulerAction();" value="Annuler">
</p>
<?= $form->field($model, 'answer'/*, ['labelOptions' => ['label' => '']]*/)->textarea(['class' => 'wide', 'rows' => 10, 'id' => 'feuille', 'onFocus' => 'colorFocus("feuille");', 'onBlur' => 'colorBlur("feuille");']) ?>
<?= Html::submitButton('Exercice termin&eacute;', ['class' => 'btn btn-primary', 'name' => 'answer-button']) ?>
<hr />

<?php //PHP pour le nombre d'exos restants ici. ?>
    <input  name="Trace" type="hidden" id="formulaire">
    <input name="oper1" type="hidden">
    <input name="oper2" type="hidden">
    <input name="nbExo"  value="<?php //echo($nbExo);?>" type="hidden">
    <input name="numExo"  value="<?php //echo($numExo);?>" type="hidden">
<?php //CODE JAVASCRIPT ICI ?>

</div><!-- student-answer -->
<?php ActiveForm::end(); ?>

