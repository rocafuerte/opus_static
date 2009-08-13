<?php
session_start();
ob_start();
function __autoload($class){
	require_once("php_classes/$class.class.php");
}
$DB = new DB();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Close-Up Magazine</title>
<link href="css_config/styles2.css" rel="stylesheet" type="text/css" />
<script  language="javascript" src="javascript/fixHeight.js"></script>
<script  language="javascript" src="javascript/effect.js"></script>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function setLeftDivHeight(){
	var DivHeight = document.getElementById('centerDiv').clientHeight;
	document.getElementById('leftDiv').style.height = DivHeight+'px';
}

//-->
</script>
<style>
object {
}
#centerDivTrans embed {
	width:360px;
	height:300px;
	margin:0px;
	padding:0px;
}
.rightCenterDivFlow embed {
	width:200px;
	height:200px;
}
</style>
</head>
<body onload="div.init()">
<div id="pageCell">
<div id="topDiv">
  <a href="/" target="_self"><img src="graphics/CU-logo-black-background.gif" border="0"  align="left" /></a>
  <?php
$topBannerQ = new Query("banners");
$topBannerQ->whereLeftJoinImageQuery("*","category","top","date","ASC",1);
while($row = mysql_fetch_assoc($topBannerQ->getResult())){
	?>
<table border="0" cellpadding="0" cellspacing="0" align="right" width="100">
<tr>
<td class="tdVertTop"><!--<img src="graphics/annonspilVertical.gif" />-->&nbsp;</td>
<td class="tdVertTop"><a href="<?php echo $row['link'];?>" target="<?php echo $row['target'];?>"><a href="<?php echo $row['link'];?>" target="<?php echo $row['target'];?>"><img src="<?php echo Settings::getUploadedImages().'/'.$row['file']; ?>" width="760" class="topBanners"/></a></a></td>
</tr>
</table>
  
  <?php
}
?>
  <div id="menuBar">
  <img src="graphics/menuItems/news.gif" border="0" /></a><a href="events.php"><img src="graphics/menuItems/concertcal.gif" border="0" /></a><a href="/blog"><img src="graphics/menuItems/blog.gif" border="0" /></a><a href="/forum"><img src="graphics/menuItems/forum.gif" border="0" /></a><a href="/forum/viewforum.php?f=3"><img src="graphics/menuItems/buyandsell.gif" border="0" /></a><a href="vimmel.php"><img src="graphics/menuItems/images.gif" border="0" /></a></a><a href="prenumeration.php"><img src="graphics/menuItems/subscribe.gif" border="0" /></a></a><a href="number.php"><img src="graphics/menuItems/oldnumbers.gif" border="0" /></a>

<a href="http://www.facebook.com/group.php?sid=408ce80e08fdf3a06b1b5add19df0414&gid=5357798623"><img src="graphics/menuItems/facebook.gif" width="53" height="15" border="0" class="facebook"/></a>
<a href="http://www.myspace.com/closeupmyspace"> <img src="graphics/menuitems/myspace.gif" width="70" height="15" border="0" class="myspace"/></a>

  <!-- <ul>
      
      <li><a href="events.php" target="_blank">Konsertkalender</a></li>
      <li><a href="/blog" target="_blank">Blogg</a></li>
      <li><a href="/forum" target="_blank">Forum</a></li>
      <li><a href="/forum/viewforum.php?f=3">K&ouml;p &amp; s&auml;lj</a></li>
      <li><a href="vimmel.php">Vimmelbilder</a></li>
      <li><a href="http://www.myspace.com/closeupmyspace" target="_blank">Close-Up MySpace</a></li>
      <li><a href="prenumeration.php">Prenumerera</a></li>
      <li><a href="number.php">Gamla nummer</a></li>
    </ul>-->
    <div id="showDate"><span class="smallWhite"><?php echo Helper::sweDay(date("w")).' '.date("j").' '.Helper::sweMonth(date("n")).' '.date("Y") ?></span></div>
  </div>
</div>
<div id="leftDiv">
  <?php 
$magQ = new Query("monthly_magazine");
$magQ->whereLeftJoinImageQuery("*","active",1,"rowid","DESC",1);
if($magQ->getNumRows()>0 && Helper::hasValue($magQ->getResultRow("image_id"))){
 ?>
  <div id="monthlyMag">
  <a href="number.php?id=<?php echo $magQ->getResultRow("rowid"); ?>">
  <img src="image_thumb.php?source=<?php echo Settings::getUploadedImages().'/'.$magQ->getResultRow("file"); ?>&width=150" border="0"/>
  </a>
  </div>
  <?php 
}
?>
<div id="competition">
    <div class="veckansFragaBg"><span class="boldWhite"></span></div>
    <div align="center"><span class="boldWhite">L&auml;s den hetaste </span><span class="boldPink2"><a href="/blog">h&aring;rdrocksbloggen</a></span><span class="boldWhite"> eller regga dig f&ouml;r att </span><span class="boldPink2"> <a href="http://closeupmagazine.net/blogg/wp-login.php?action=register">b&ouml;rja blogga</a></span> <span class="boldWhite">sj&auml;lv!</span></div>
    <div class="leftBoxFooter"></div>
  </div>
  <?php 
 

$voteQ = new Query("vote_group");
$voteQ->whereQuery("*","active",1,"rowid","DESC",1);
if($voteQ->getNumRows()>0){
	while($row = mysql_fetch_assoc($voteQ->getResult())){
		$vote_itemsQ = new Query("vote_group_items");
		$vote_itemsQ->whereQuery("*","group_id",$row['rowid'],"rowid","ASC",3);
		$item1=mysql_result($vote_itemsQ->getResult(),0,"rowid");
		$item2=mysql_result($vote_itemsQ->getResult(),1,"rowid");
		$item3=mysql_result($vote_itemsQ->getResult(),2,"rowid");
		$group=$row['rowid'];
		?>
  <div id="vote">
    <div class="competitionBg"></div>
    <div class="leftTextMargin"> <span class="boldWhite"><?php echo $row['title']; ?></span> <br />
      <span class="boldWhite"><?php echo $row['description']; ?></span> <span class="lightGrey">
      <form action="" method="post" name="form1" id="form1">
        <table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="20%"><input name="radio" type="radio" id="radio" 
            onclick="MM_openBrWindow('vote_view_popup.php?group_item_id=<?php echo $item1?>&group_id=<?php echo $group?>','R&ouml;stning','width=300,height=200')"/>
            </td>
            <td width="80%"><?php echo mysql_result($vote_itemsQ->getResult(),0,"item_name"); ?></td>
          </tr>
          <tr>
            <td><input type="radio" name="radio" id="radio2" onclick="MM_openBrWindow('vote_view_popup.php?group_item_id=<?php echo $item2?>&group_id=<?php echo $group?>','R&ouml;stning','width=300,height=200')" /></td>
            <td><?php echo mysql_result($vote_itemsQ->getResult(),1,"item_name"); ?></td>
          </tr>
          <tr>
            <td><input type="radio" name="radio" id="radio3" onclick="MM_openBrWindow('vote_view_popup.php?group_item_id=<?php echo $item3?>&group_id=<?php echo $group?>','R&ouml;stning','width=300,height=200')" /></td>
            <td><?php echo mysql_result($vote_itemsQ->getResult(),2,"item_name"); ?></td>
          </tr>
        </table>
      </form>
      </span> <br />
      <span class="smallWhite" style="text-decoration:underline"><a href="#" onclick="MM_openBrWindow('vote_view_popup.php?group_id=<?php echo $group?>','R&ouml;stning','width=300,height=200')" />Se resultat</a></span><br />
    </div>
    <div class="leftBoxFooter"></div>
  </div>
  <?php
		
	}
}
?>
 <div class="leftCenterDivFlow">
  <a href="shop2.php"><img src="graphics/closeup_shop.gif" alt="Shop" border="0" /></a><br /><br />

   <a href="shop2.php"><img src="graphics/shop2.gif" alt="Shop" border="0"/></a><br />
   <br />
 <span class="smallGrey"><a href="shop2.php">Kolla in våran nya shop med massor av tuffa prylar!</a></span><br />
   <span class="smallOrange"><a href="shop2.php">Till shoppen</a></span>
   <br />
   <br />

 <hr class="hr2" noshade="noshade" />
</div>
  <div class="leftCenterDivFlow"> <img src="graphics/closeupArkiv.gif" /><br />
    <br />
    <span class="smallOrange"> <a href="article_archive.php">Artikelregister</a> <br />
    <a href="news_archive.php">Nyhetsregister</a><br />
    <a href="articles.php">Artiklar</a><br />
    <a href="reviews.php">Recensioner</a><br />
    <a href="crossword.php">Korsord</a><br />
    <a href="contestWinners.php">T&auml;vlingsvinnare/Svar</a><br />
    <a href="top40.php">Topp 40: 1991-<?php echo date("Y"); ?></a> </span> <br />
    <br />
    <hr class="hr2" noshade="noshade" /><br />
    <p> <a href="interviews.php"><img src="graphics/interviews.gif" alt="Intervjuer" border="0"/></a><br />
      <br />
      <span class="smallGrey"><a href="interviews.php">Kolla p&aring; filmade intervjuer med dom hetaste artisterna och fr&aring;n de senaste evenemangen</a></span> <span class="smallOrange"> <a href="interviews.php">h&auml;r!</a></span><br /><br />
    <p>
    <hr class="hr2" noshade="noshade" />
    </p>
    <br />
    <div class="leftCenterDivFlow">
      <p> <img src="graphics/redaktionen.gif" /></p>
      <span class="smallOrange"><a href="contact.php">Kontakt</a><br />
      <a href="skribenter.php">Skribenter</a><br />
      <a href="english.php">In English</a><br />
      <a href="announce.php">Annonsera i Close-Up</a></span> </div>
  </div>
</div>
<div id="centerContainer">
<?php

$newest = new Query("new");
$newest->whereAndLeftJoinImageQuery("*","active",1,"date","DESC");
if($newest->getNumRows()>0){

	?>
<div class="newestHeader"></div>
<div class="newest">
  <table border="0" cellpadding="0" cellspacing="0" class="noBorder">
    <tr>
      <td width="80" class="noPadding" rowspan="3"><a href="index.php?id=<?php echo $newest->getResultRow("rowid"); ?>"><img src="image_crop.php?source=<?php echo Settings::getUploadedImages().'/'.$newest->getResultRow("file");?>&dest=&thumb_size=100" class="imgWhiteBorder" /></a></td>
      <td width="270" class="tdPadding" colspan="2"><span class="boldWhite"><a href="index.php?id=<?php echo $newest->getResultRow("rowid"); ?>"><?php echo $newest->getResultRow("title"); ?></a></span></td>
    </tr>
    <tr>
      <td class="tdPadding" colspan="2"><span class="smallWhite"><a href="index.php?id=<?php echo $newest->getResultRow("rowid"); ?>"><?php 
	  if($newest->getResultRow("description")!=""){
			echo strip_tags(substr($newest->getResultRow("description"),0,120),'<b><br><strong>')."..."; 
		}else{
			echo strip_tags(substr($newest->getResultRow("text"),0,120),'<b><br><strong>')."..."; 
	  }
	  
	  ?>
      
      </a></span></td>
    </tr>
    <tr>
      <td class="tdVertBottom"><span class="smallOrange"><a href="index.php?id=<?php echo $newest->getResultRow("rowid"); ?>">L&auml;s mer</a></span></td>
      <td align="right" class="tdVertBottom"><span class="smallGrey"><?php echo date("Y-m-d",strtotime($newest->getResultRow("date"))); ?></span></td>
    </tr>
  </table>
</div>
<div class="newestFooter"></div>
<?php
 }
 ?>
