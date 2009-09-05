<?php include "header_inc.php";?>

<div id="centerDiv">
<div class="newsBg">
<span class="newsHeaderSmaller">T&auml;vlingsvinnare</span><br><br>
<?php

setlocale(LC_ALL, 'sv_SE');
$query="SELECT * FROM competition_answers 
		LEFT JOIN competitions
		ON competition_answers.answerComp_id = competitions.rowid
		WHERE competition_answers.answerWinner='1'
		GROUP BY competitions.title
		ORDER BY competitions.date DESC
		LIMIT 0,25";
$result=mysql_query($query) or die(mysql_error());
while($row=mysql_fetch_object($result)){
	echo '<span class="boldPink">'.strtoupper($row->title).'</span><br/>';
	if (trim($row->answer)!="") echo '<span class="boldGrey">Svar: </span>'.Helper::text($row->answer).'<br />';
	echo '<span class="boldGrey">Vinnare </span><br/>';
	$query2="SELECT * FROM competition_answers WHERE answerWinner=1 AND answerComp_id='".$row->rowid."'";
	$result2=mysql_query($query2) or die(mysql_error());
	while($row2 = mysql_fetch_object($result2)){
		echo '<span class="">'.$row2->answerName.' - '.$row2->answerCity.'</span><br/>';
	}
	echo '<br/>';
}
?>
</div>
</div>
o

include "footer.php" ?>
