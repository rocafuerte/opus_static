<?php
include "header_inc.php";
echo '<div id="centerDiv">';
echo '<div class="newsBg">';
if(isset($_GET['id'])&&Helper::isInt($_GET['id'])&&Helper::givesResult("personal","rowid",$_GET['id'])){
	
	$personal = new Query("personal");
	$personal->whereQuery("*","rowid",$_GET['id'],"rowid","ASC",1);
	
	$topQ = new Query("top40");
	$topQ->whereQuery("*","top40Username",$personal->getResultRow("username"),"top40ID","ASC",40);
	
	
	echo '<div class="newsHeaderActual"><span class="newsHeaderSmaller">Topp 40 '.$personal->getResultRow("first_name").' '.$personal->getResultRow("last_name").'</span></div><br/><br/>';
	
	echo "<ol >";
	while($row = mysql_fetch_object($topQ->getResult())){
		echo '<li style="font-weight:bold">'.$row->top40Group.' - <span style="color:#000000;">'.$row->top40Album."</span></li>";
	}
	echo "</ol>";
	
	//echo Helper::text($personal->getResultRow("top40"));
	
}
echo '</div>';
echo '</div>';
include "footer.php";?>
