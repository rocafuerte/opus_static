  <?php include "header_inc.php" ?>
 
  <div id="centerDiv">
  
  
<div class="newsHeaderActual"> <span class="newsHeaderSmaller"><p>K�p och s�lj p� Close-up!</p></span></div>


<span class="smallPink"><a href="#">S�ljes</a> | <a href="#">K�pes</a> | <a href="#">Bytes</a> | <a href="#">Annonsera!</a></span><br />
<br />
<hr /><br />

<?php
$category = Helper::safeSql($_GET['category']);
if(Helper::hasValue($category) && Helper::givesResult($category)){

?>
 <table width="200" border="0" cellpadding="0" cellspacing="0">
  
  <tr>
    <td><strong>Email</strong> </td>
    <td><label></label></td>
  </tr>
  <tr>
    <td><input name="textfield" type="text" class="field" size="24" /><br />
<br />
</td>
  </tr>
  <tr>
    <td><strong>Annonstext</strong><span class="smallGrey"> (max 1000 tecken)</span></td>
  </tr>
  <tr>
    <td colspan="2"><textarea name="textfield2" cols="21" rows="5" class="field" ></textarea><br /><br />

</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Annonskategori</strong></td>
  </tr>
  <tr>
    <td colspan="2"><form id="form1" name="form1" method="post" action="">
      <label>
        <select name="select" id="select" class="field">
          <option>S&auml;ljes</option>
          <option>K&ouml;pes</option>
          <option>Bytes</option>
        </select>
        </label>
    </form>   <br />
<br />
</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Verifieringskod</strong></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>Skriv in koden</strong></td>
  </tr>
  <tr>
    <td colspan="2"><input name="textfield3" type="text" class="field" size="24" /><br />
<br />
</td>
  </tr>
  <tr>
    <td colspan="2"><input name="action" type="submit" class="button" id="submit" value="Annonsera" /></td>
  </tr>
</table>
<?php

?>


<p><hr /></p>
<br />
<br />

<div class="marketActual">

<div class="newsHeaderActual"> <span class="boldPink">J�ttefin t-tr�ja!</span></div>
<p>Massor med grymma DVD:er och skivor, nu priss�nkt. ----------- http://www.tradera.com/auktioner/BoxRea ----------- S�ljer �ven Arkiv X s�song 1, 4 och 7 samt "V - The Complete Series"�, alla Region 1, utanf�r Tradera (d� de har en v�ldigt skum regel g�llande region 1-DVD:er). �r ni intresserad av n�gon av dem s� h�r g�rna av er. Lycka till med budgivningen!</p>
<p><span class="smallPink"><a href="mailto:box_rea@hotmail.com">box_rea@hotmail.com</a></span></p>


</div>
<hr />
<br />
<br />

<table border="0" cellpadding="0" cellspacing="0" class="demoTable">
  <tr>

    <td class="tdPadding" colspan="2"><span class="boldGreyLighter">J�ttefin t-tr�ja!</span><span class="smallGrey"> -s�ljes</span></td>
   </tr>
  
  <tr>
  <td width="126" class="tdVertBottom"><span class="smallPink"><a href="#">L&auml;s mer</a></span></td>
  <td width="164" align="right"><span class="smallGrey">2008-12-03</span></td>
  </tr>
  
</table>



<table border="0" cellpadding="0" cellspacing="0" class="demoTable">
  <tr>

    <td class="tdPadding" colspan="2"><span class="boldGreyLighter">En bra cd skiva</span><span class="smallGrey"> -k�pes</span></td>
   </tr>
  
  <tr>
  <td width="126" class="tdVertBottom"><span class="smallPink"><a href="#">L&auml;s mer</a></span></td>
  <td width="164" align="right"><span class="smallGrey">2008-12-03</span></td>
  </tr>
  
</table><br />

<table border="0" cellpadding="0" cellspacing="0" class="demoTable">
  <tr>

    <td class="tdPadding" colspan="2"><span class="boldGreyLighter">Hummer s&auml;ljes</span><span class="smallGrey"> -bytes</span></td>
   </tr>
  
  <tr>
  <td width="126" class="tdVertBottom"><span class="smallPink"><a href="#">L&auml;s mer</a></span></td>
  <td width="164" align="right"><span class="smallGrey">2008-12-03</span></td>
  </tr>
  
</table>

      <br />

</div>
<?php include "footer.php" ?>