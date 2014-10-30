<?php

use app\models\Student;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Student */

$_SESSION = Yii::$app->session;
//$this->registerJs('js/interfaceIE.js', \yii\web\View::POS_READY);
?>

<SCRIPT type="text/javascript" src="js/interfaceIE.js"></script>
<link rel="stylesheet" type="text/css" href="css/interfaceIE.css">

<div class="student-answer">

<form action="diag_general.php" name="info" method="post" onsubmit="return verifForm()"> 
<table width="67%" align="center">
<tr><td colspan="2"><table width="100%"  border="0">
<tr>
<td width="25%">
</td>
<td width="52%" align="center">
<?php print(ucfirst($_SESSION['first_name']));
//$this->registerJs('js/interfaceIE.js', \yii\web\View::POS_END);
//."   ".strtoupper($_SESSION['nom']));?></td>
<td width="23%">&nbsp;</td>
</tr>
</table></td></tr>
<tr>
<td width="41%" rowspan="3" valign="top"> 
<table width="440" border="0" cellspacing="2">
<tr>
<td width="434" colspan="2" align="center">
<table width="97%" border="0" cellpadding="0" cellspacing="0">
<tr>
<td height="24" valign="top" class="aide">
&nbsp;&nbsp; Exercice No
<!--<?php //echo ($_SESSION["totalExo"]-$nbExo+1); ?>-->
</td>
</tr>
<tr>
<td>
<table width="100%" border="2" align="center" cellpadding="2" cellspacing="0">
<tr>
<td>

<?php // TRUCS EN PHP ICI
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

</td>
</tr>
</table>				</td>
</tr>
<tr>
<td height="27" valign="middle" class="aide">Pour &eacute;crire, tu peux cliquer sur les mots de l'&eacute;nonc&eacute;</td>
</tr>
</table>	      </td>
</tr>
<tr>
<td width="434"   align="center">             
<table width="100%"  border="0">
<tr>
<td align="center"><input name="T1" type="text" size="65" style="font-size:10pt;"  <?php if (isset($precedent)) echo('value="'.$sas.'"'); else echo('value=""');?> class="champText" id="sas"
onFocus="monTour(5);colorFocus('sas');" 
onBlur="colorBlur('sas');"></td>
</tr>
</table>          </td>
</tr>   
<tr>
<td height="45" colspan="2" align="center">
<table width="100%"  border="0">
<tr>
<td width="28%" align="left"><input name="efface5" type="button" class="bouton"  onClick="document.info.T1.value='';document.info.T1.focus();" value="Effacer tout" style="width:110"></td>
<td width="24%" align="center"><input type="button" class="bouton" name="annuler2" value="Annuler" onClick="annulerSas();" style="width:70">                </td>
<td width="48%" align="right"><input name="button2" type="button" class="bouton"  onClick="inserer(document.info.T1.value);" 
value="Ecrire dans la feuille" style="width:200"
></td>
</tr>
</table></td> 
</tr>
<tr>
<td colspan="2" align="center"> 

<table width="151" height="153" align="center<?php //echo (($audio ? 'left' : 'center')); ?>">
<tr valign="middle">
<td colspan="4" align="center">
<span class="aide">Tu peux &eacute;crire tes calculs ici </span>
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

<?php //PHP AUDIO ICI ?>

</td>
</tr>
</table></td>
<td width="59%" align="center" valign="top"><table width="100%"  border="0">
<tr>
<td height="22" colspan="3" class="aide">&Eacute;cris tes calculs et ta r&eacute;ponse dans cette feuille</td>
</tr>
<tr>
<td align="center"><input name="effacer" type="button" class="bouton" id="effacer2"
onClick="document.info.zonetexte.value='';document.info.zonetexte.focus();" value="Effacer toute la feuille" style="width:150">            </td>
<td align="center"><input name="retour" type="button" class="bouton" onClick="inserer('\n');document.info.zonetexte.focus();" value="Passer &agrave; la ligne" style="width:115"></td>
<td align="center"><input name="annuler" type="button" class="bouton" id="annuler" 
onClick="if (feuille.isContentEditable==true) annulerAction();" value="Annuler"></td>
</tr>
<tr align="center">
<td colspan="3" valign="middle"><textarea name="zonetexte" cols="45" rows="24" class="champText" id="feuille"
onFocus="colorFocus('feuille');" 
onBlur="colorBlur('feuille');"><?php if(isset($precedent)) echo($zoneTexte);?></textarea></td>
</tr>
</table></td>
</tr>
<tr>
<td align="center">
<p>
<input name="button" type="submit" class="bouton" 
style="width:240;" value="Exercice termin&eacute;">
</p>
</td>
</tr>
<tr>
<td align="center" class="aide">

<?php //PHP pour le nombre d'exos restants ici. ?>

<tr align="center">
    <td height="21" colspan="2" valign="top"><a href="javascript:;" onClick="abandonner();">Quitter </a></td>
    </table>
    <input  name="Trace" type="hidden" id="formulaire">
    <input name="oper1" type="hidden">
    <input name="oper2" type="hidden">
    <input name="nbExo"  value="<?php //echo($nbExo);?>" type="hidden">
    <input name="numExo"  value="<?php //echo($numExo);?>" type="hidden">

<?php //CODE JAVASCRIPT ICI ?>

</form>

</div><!-- student-answer -->

