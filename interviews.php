<?php include "header_inc.php";?>

<div id="centerDivTrans">
<span class="boldPink">Intervjuer</span><br/><br/>
<?php

$tv = new Query("interviews");
$tv->makeQuery("*","date","ASC",200);
$tvPaging = new Paging($tv,6);
$tvPaging->makePagingQuery();

while($row = mysql_fetch_assoc($tvPaging->pagingResult)){
	echo '<span class="smallWhite">'.$row['name'].'</span><br />';
	echo $row['code']."<br/><br/>";
}

$tvPaging->displayLinks("se","smallPink","smallGrey");

?>


</div>
<?php

include "footer3.php" ?>