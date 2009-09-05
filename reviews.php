<?php include "header_inc.php"; ?>

<div id="centerDiv">
<div class="newsBg">
<?php



$review=new Query("recensioner");
$review->whereQuery("*","active",1,"date","DESC",10000);



$paging=new Paging($review,20);

$paging->where();

$reviewShow = new Review($review);

$reviewShow->showReview();

$reviewShow->listReviews($paging);

?>

    
<?php echo $paging->previousShow("se","smallPink").' '.$paging->nextShow("se","smallPink").'<br />'.$paging->linksShow2("se","smallGray","smallPink"); ?>


</div>
</div>

<?php include "footer.php"; ?>
