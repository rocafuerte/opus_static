<?php
include "header_inc2.php";
function pageLinks($totalpages, $currentpage, $pagesize,$parameter, $date, $place, $city, $artist) {

   // Start at page one
   $page = 1;

   // Start at record zero
   $recordstart = 0;

   // Initialize $pageLinks
   $pageLinks = "";

   while ($page <= $totalpages) {
      // Link the page if it isn't the current one
      if ($page != $currentpage) {
         $pageLinks .= "<a href=\"".$_SERVER['PHP_SELF']."?$parameter=$recordstart&date=$date&place=$place&city=$city&artist=$artist\">$page</a> ";
      // If the current page, just list the number
      } else {
         $pageLinks .= "$page ";
      }
         // Move to the next record delimiter
         $recordstart += $pagesize;
         $page++;
   }
   return $pageLinks;
}


$rad=0; //altaernerar f&auml;rg

$date = (isset($_GET['date']) && $_GET['date'] && Helper::isText($_GET['date'])) ? $_GET['date'] : "%";
$city = (isset($_GET['city']) && $_GET['city'] != "" && Helper::isText($_GET['city'])) ? $_GET['city'] : "%";
$place = (isset($_GET['place']) && $_GET['place'] != "" && Helper::isText($_GET['place'])) ? $_GET['place'] : "%";
$artist = (isset($_GET['artist']) && $_GET['artist'] != "" && Helper::isText($_GET['artist'])) ? $_GET['artist'] : "%";

$pagesize = 80;
$recordstart = (int) $_GET['recordstart'];
$recordstart = (isset($_GET['recordstart'])) ? $_GET['recordstart'] : 0;

$query="select * from spelningar WHERE stad LiKE '".$city."' AND artist LIKE '".$artist."' AND lokal LIKE '".$place."' AND datum LIKE '".$date."' AND datum >= NOW() ORDER BY `datum`  ";
//ASC LIMIT ".$recordstart." , ".$pagesize."
$result=mysql_query($query);

?>

<div id="centerDivBig">

<?php

if(isset($_GET['id'])&& Helper::IsInt($_GET['id'])){
	$query = new Query("spelningar");
	$query->whereLeftJoinImageQuery("*","rowid",$_GET['id'],"rowid","ASC",1);
	
	$day = Helper::sweDay(date("w",strtotime($query->getResultRow("datum"))));
	$day_no = date("j",strtotime($query->getResultRow("datum")));
	$month = Helper::sweMonth(date("n",strtotime($query->getResultRow("datum"))));
	$year = date("Y",strtotime($query->getResultRow("datum")));
	
	//Helper::sweDay($day).' '.date("d").' '.Helper::sweMonth(date("n")).' '.date("Y")
	echo '<span class="boldGrey">'.$query->getResultRow("artist").'</span><br /><br />'; 
	
	if($query->getResultRow("image_id")>0){
		?>
		<table><tr><td>
		<?php 
		echo Image::displayImage($query->getResultRow("file"),542,"",$query->getResultRow("name"));		
		?>
		</td>
		</tr>
		<tr>
		<td align="right" class="smallGrey2">
		<?php
		if($query->getResultRow("photo")!=""){
			echo '<span class="smallGrey">Foto: '.$query->getResultRow("photo").'</span>';
		}
		?>
		</td>
		</tr>
		</table>
		<?php 
	}
	echo '<b>Datum: </b>'.$day.' '.$day_no.' '.$month.' '.$year.'<br />';	
	echo '<b>Artist: </b>'.$query->getResultRow("artist").'<br />';
	echo '<b>Stad:</b> '.$query->getResultRow("stad").'<br />';
	echo '<b>Lokal:</b> '.$query->getResultRow("lokal").'<br /><br />';
	echo Helper::text($query->getResultRow("description"));
	echo '<br /><br />';

}

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="search">
  <table cellpadding="0" cellspacing="0" border="0"  style="width:540px">
    <th align="left">Datum</th>
      <th align="left">Artist</th>
      <th align="left">Stad</th>
      <th align="left">Lokal</th>
      <th colspan="2"></th>
    <tr>
      <td><select name="date" >
          <option value="%">Allt</option>
          <?php
	  	$query_form="select * from spelningar WHERE datum >= NOW() AND datum > '' GROUP BY `datum` ASC ORDER BY `datum` ASC ";
		$result_form=mysql_query($query_form);		
	    while($row = mysql_fetch_assoc($result_form))
			{
			$selected = ($_GET['date']==$row['datum']) ? "selected" : "";			
			echo '<option value="'.$row['datum'].'" '.$selected.'>'.$row['datum'].'</option>';
			 } 
		 	  ?>
        </select></td>
        
          <td><select name="artist" >
          <option value="%">Allt</option>
          <?php
	  	$query_form="select * from spelningar WHERE datum >= NOW() AND artist > '' GROUP BY `artist` ASC ORDER BY `artist` ASC ";
		$result_form=mysql_query($query_form);	  
	  	while($row = mysql_fetch_assoc($result_form))
			{
			$selected = ($_GET['artist']==$row['artist']) ? "selected" : "";
		
			echo '<option value="'.$row['artist'].'" '.$selected.'>';
			echo (strlen($row['artist'])>11)?substr($row['artist'],0,10)."...":$row['artist'];
			echo '</option>';
			}
	  ?>
        </select></td>
      <td><select name="city" >
          <option value="%">Allt</option>
          <?php
	  	$query_form="select * from spelningar WHERE datum >= NOW() AND stad > '' GROUP BY `stad` ASC ORDER BY `stad` ASC ";
		$result_form=mysql_query($query_form);
	  	while($row = mysql_fetch_assoc($result_form))
			{
			$selected = ($_GET['city']==$row['stad']) ? "selected" : "";
			echo '<option value="'.$row['stad'].'" '.$selected.'>';
			echo (strlen($row['stad'])>11)?substr($row['stad'],0,10)."...":$row['stad'];
			echo '</option>';
			}
	  ?>
        </select></td>
      <td><select name="place"  >
          <option value="%">Allt</option>
          <?php
	  	$query_form="select * from spelningar  WHERE  lokal > '' AND  datum >= NOW()  GROUP BY `lokal` ASC ORDER BY `lokal` ASC ";
		$result_form=mysql_query($query_form);	  
	    while($row = mysql_fetch_assoc($result_form))
			{
			$selected = ($_GET['place']==$row['lokal']) ? "selected" : "";	
			$place;
			
			echo '<option value="'.$row['lokal'].'" '.$selected.'>';
			echo (strlen($row['lokal'])>11)?substr($row['lokal'],0,10)."...":$row['lokal'];
			echo '</option>';
			}
	  ?>
        </select></td>
    
        
        <td><input name="Submit" type="submit" value="Sortera" /></td>
    </tr>
    
    
    <?php
while($row = mysql_fetch_assoc($result))
{
if ($rad % 2)
{
 $color="#e7e7e7";
}else{
$color="#FFFFFF";
}

echo '<tr>
<td bgcolor="'.$color.'" class="smallPink" style="width:100px; padding-left:2px" valign="top"><a href="?id='.$row['rowid'].'" >'.$row['datum'].'</a></td>
<td bgcolor="'.$color.'" class="smallPink" style="width:100px; padding-left:2px" valign="top"><a href="?id='.$row['rowid'].'" >';
echo Helper::cutText($row['artist'],20);  
echo '</a></td>';
echo '<td bgcolor="'.$color.'"class="smallPink" style="width:100px; padding-bottom:3px;padding-top:3px; padding-left:2px" valign="top"><a href="?id='.$row['rowid'].'">';
echo Helper::cutText($row['stad'],20);  
echo '</a></td>';
echo '<td bgcolor="'.$color.'"class="smallPink" colspan="2" style="width:100px; padding-left:2px" valign="top"><a href="?id='.$row['rowid'].'">';
echo Helper::cutText($row['lokal'],25);  
echo '</a></td>';

echo '</tr>';
$rad++;

}


?>
  </table>
</form>
<br />
<?php 

/*
//alla aktuella
$query_all="select * from spelningar  WHERE stad LiKE '".$city."' AND artist LIKE '".$artist."' AND lokal LIKE '".$place."' AND datum LIKE '".$date."'";
$result_all=mysql_query($query_all) or die(mysql_error());
$totalrows = mysql_num_rows($result_all);

$totalpages = ceil($totalrows / $pagesize);
$currentpage = ($recordstart / $pagesize) + 1;

if($recordstart > 0) {
	$prev = $recordstart - $pagesize;
	$url = $_SERVER['PHP_SELF']."?recordstart=$prev&date=$date&city=$city&place=$place&artist=$artist";
	echo '<span class="smallPink"><a href="'.$url.'"> F&ouml;reg&aring;ende</a></span> ';
	}
	
if($totalrows > ($recordstart + $pagesize)) {
	$next = $recordstart + $pagesize;
	$url = $_SERVER['PHP_SELF']."?recordstart=$next&date=$date&city=$city&place=$place&artist=$artist";
	echo '<span class="smallPink"><a href="'.$url.'">N&auml;sta </a></span>';
	}
	//paging
echo '<p><span class="smallGrey">Sidor:</span> <span class="smallPink">'.pageLinks($totalpages, $currentpage, $pagesize, "recordstart", $date, $place, $city , $artist).'</span></p>';
*/
?>
</div><!-- centerDivBig -->
<?php 
include "footer2.php";
?>