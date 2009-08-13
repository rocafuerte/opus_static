  <img src="graphics/news_bar_bottom.gif" />
  </div>    
<div id="rightBannerDiv">
<!--<img src="graphics/annonspil.gif" alt="Annonser"/><br />-->
<?php
$rightBannerQ = new Query("banners");
$rightBannerQ->whereLeftJoinImageQuery("*","category","right","order_no","ASC",1);
while($row = mysql_fetch_assoc($rightBannerQ->getResult())){
	?>
    <a href="<?php echo $row['link'] ?>" target="<?php echo $row['target'];?>">
    <img src="<?php echo Settings::getUploadedImages().'/'.$row['file']; ?>" width="250" class="rightBanners"/>
    </a>
	<?php
}
?>
</div>
</div>
<div id="footer"><img src="graphics/footer.gif" border="0" alt=" P.O. Box 4411 SE-102 69 Stockholm   Sweden |  + 46-8 462 02 14|  mail@closeupmagazine.net | Rocafuerte design"  usemap="#Map" />
<map name="Map" id="Map"><area shape="rect" coords="664,-9,775,25" href="http://www.rocafuerte.se/" target="_blank" />
</map></div>
<br /><br />
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