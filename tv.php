<?php include "header_inc.php";?>

<div id="centerDiv">
<div class="newsBg">
<?php

$tv = new Query("youtube");
$tv->makeQuery("*","date","DESC",200);
$tvPaging = new Paging($tv,6);
$tvPaging->makePagingQuery();
?>
<table width="100%"><tr><td align="left">&nbsp;
</td><td align="right" valign="bottom">
<?php 
$tvPaging->displayLinks("se","smallPink","smallGrey");
?>
</td></tr></table>
<br />
<hr class="hr2"/><br />
<?php

while($row = mysql_fetch_assoc($tvPaging->pagingResult)){
	echo '<span class="rightCenterDivTitle">'.$row['name'].'</span><br />';
	echo $row['code']."<br/><br/>";
}

$tvPaging->displayLinks("se","smallPink","smallGrey");

?>


</div>
</div>
<?php

include "footer.php" ?>
