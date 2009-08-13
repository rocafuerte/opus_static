<!-- </div>centerDiv-->
<div class="centerDivFooterSmall"></div>
</div>

<div id="rightCenterDiv">

 <div id="searchDiv">
   
<form action="index.php" method="post">
<input name="search" type="text" class="searchField" height="15" size="22">
</form>
 </div><!-- searchDiv -->
<hr class="hr2" noshade="noshade" />
<br />
<?php
$tvQ = new Query("youtube");
$tvQ->makeQuery("*","date","DESC",1);
if($tvQ->getNumRows()>0){
	?>
    <div class="rightCenterDivFlow"><a href="tv.php"><img src="graphics/closeupTV.gif" alt="Close-Up TV" border="0" /></a><br />
    <?php echo $tvQ->getResultRow("code"); ?>
  
    <br />
    <span class="smallGrey"><a href="tv.php">Kolla in Close-Up TV! Massvis med videos fr&aring;n festivaler och spelningar!</a></span><br />
    <span class="smallOrange"><a href="tv.php">Close-Up TV</a></span> <br />
    <br />
    <hr class="hr2" noshade="noshade" />
  </div> <!-- rightCenterDivFlow -->
	
	<?php 
}


$compQ = new Query("competitions"); 
$compQ->whereAndLeftJoinImageQuery("*","active",1,"date","DESC",5);
if($compQ->getNumRows()>0){
	while($row=mysql_fetch_object($compQ->getResult())){
	?>
		<div class="rightCenterDivFlow"><span class="boldWhite"><a href="tavlingar.php?id=<?php echo $row->rowid;?>"><?php echo $row->title; ?></a></span> <!--<img src="graphics/tavling_right.gif" alt="" />--><br />
		 <?php 
		if(Helper::hasValue($row->image_id)){
			?>
			<a href="tavlingar.php?id=<?php echo $row->rowid;?>">
            <?php
			echo Image::displayImage($row->file,198,"imgWhiteBorder",$row->name);
			?>
			
			</a>
			<?php
		}
			?>
	  
		<br />
		<span class="smallGrey"><a href="tavlingar.php?id=<?php echo $row->rowid;?>"><?php echo $row->description; ?></a></span><br />
		<span class="smallOrange"><a href="tavlingar.php?id=<?php echo $row->rowid;?>">T&auml;vla!</a></span> <br />
		<br />
		<hr class="hr2" noshade="noshade" />
		</div><!-- rightCenterDivFlow -->
	<?php
	}
}


$radioQ = new Query("radio_songs");
$radioQ->makeQuery("*","rowid","ASC",1);
if($radioQ->getNumRows()>0){
	?>
	<div class="rightCenterDivFlow"><a href="#" onclick="MM_openBrWindow('radio.php','Radio','width=300,height=400,resizable=no')" ><img src="graphics/radio.gif" border="0" alt=""/></a></div>
	<hr class="hr2" noshade="noshade" /><br />
	<?php
}
$demoQ = new Query("demos"); 
$demoQ->whereLeftJoinImageQuery("*","week_demo",1,"date","DESC",1);
if($demoQ->getNumRows()>0){
?>
    <div class="rightCenterDivFlow"><a href="demorecensioner.php?demo_id=<?php echo $demoQ->getResultRow("rowid");?>"><img src="graphics/veckansDemoband_title.gif" alt="Veckans demoband" border="0" /></a><br />
     <?php 
	if(Helper::hasValue($demoQ->getResultRow("image_id"))){
		?>
        <a href="demorecensioner.php?demo_id=<?php echo $demoQ->getResultRow("rowid");?>">
        <?php
		echo Image::displayImage($demoQ->getResultRow("file"),198,"imgWhiteBorder",$demoQ->getResultRow("name"));
		?>
        </a>
      	<?php
	}
		?>
	<br />
    <span class="smallGrey"><a href="demorecensioner.php?demo_id=<?php echo $demoQ->getResultRow("rowid");?>"><?php echo $demoQ->getResultRow("description");?></a></span><br />
    <span class="smallOrange"><a href="demorecensioner.php?demo_id=<?php echo $demoQ->getResultRow("rowid");?>">L&auml;s mer</a></span> <br />
    <br />
    <hr class="hr2" noshade="noshade" />
    </div>
<?php
}
?>

  
    
</div><!--rightCenterDiv-->


<div id="rightBannerDiv">
<!--<img src="graphics/annonspil.gif" alt="Annonser"/><br />
-->	<?php
    $rightBannerQ = new Query("banners");
    $rightBannerQ->whereLeftJoinImageQuery("*","category","right","order_no","ASC",1);
    while($row = mysql_fetch_assoc($rightBannerQ->getResult())){
        ?>
        <a href="<?php echo $row['link'] ?>" target="<?php echo $row['target'];?>">
        <img src="<?php echo Settings::getUploadedImages().'/'.$row['file']; ?>" class="rightBanners" width="250" alt=""/>
        </a>
        <?php
    }
    ?>
</div><!--rightBannerDiv-->

</div>
<div id="footer"><img src="graphics/footer.gif" border="0" alt=" P.O. Box 4411 SE-102 69 Stockholm   Sweden |  + 46-8 462 02 14|  mail@closeupmagazine.net | Rocafuerte design"  usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="664,-9,775,25" href="http://www.rocafuerte.se/" target="_blank" />
</map>
</div><!-- footer -->
<br />
<br />
<br />
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
var pageTracker = _gat._getTracker("UA-3996201-3");
pageTracker._initData();
pageTracker._trackPageview();
</script></body>
</html>