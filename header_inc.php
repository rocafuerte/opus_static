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
<title>UPUS Press</title>
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


</head>
<body>
<div id="pageCellShadowTop"></div>
<div id="pageCellShadow">
<div id="pageCell"> 


<div id="topDiv">
<div id="slogan"><img src="graphics/slogan.png" width="506" height="10" /></div>
 <img src="graphics/exempel/topbanner.png" width="980" height="120" class="topBanner"/>
<img src="graphics/logo.png" class="logo"/>
  
</div>

<div id="menuBar">
 <a href="#"> <img src="graphics/menuItems/senaste.png" border="0" class="menuItem" /></a>
 <a href="events.php"><img src="graphics/menuItems/musik.png" border="0"class="menuItem" /></a>
 <a href="/blog"><img src="graphics/menuItems/om.png" border="0" class="menuItem" /></a>
 <a href="/forum"><img src="graphics/menuItems/shop.png" border="0" class="menuItem" /></a>
 <a href="/forum/viewforum.php?f=3"><img src="graphics/menuItems/tavlingar.png" border="0" class="menuItem"/></a>
 <a href="vimmel.php"><img src="graphics/menuItems/prenumeration.png" border="0" class="menuItem"/></a>
 <a href="prenumeration.php"><img src="graphics/menuItems/koncertkalendern.png" border="0" class="menuItem" /></a>
 <a href="number.php"><img src="graphics/menuItems/annonsera.png" border="0" class="menuItem" /></a>

  <div id="showDate"><span class="smallWhite">Lördag 22 Augusti 2009</span></div>
 <div id="radio"><a href="#" onclick="MM_openBrWindow('radio.php','Radio','width=300,height=400,resizable=no')"><img src="graphics/menuItems/radio.png" width="80" height="30" border="0" /></a></div>
  </div>
<div id="leftDiv">
 <div id="monthlyMag">
  <a href="number.php?id=0">
 <img src="graphics/exempel/monthly_mag.jpg" width="154" height="185" border="0" />
   </a>
  </div>
 <div id="shop">
    <div class="shopBg"></div>
    <div class="shopCenter"><span class="smallGreen">H&auml;r finns en online shop d&auml;r du kan hitta lite sm&aring;tt och gott</span><span class="boldWhite"></span></div>
  </div>
 <div class="leftBox2">
   <div class="leftBox2Middle"><span class="smallWhite">
 <a href="#"> Artikelregister</a><br />
  <a href="#">Nyhetsregister</a><br />
  <a href="#">Recensioner</a><br />
  <a href="#">Korsord</a><br />
  <a href="#">Tävlingsvinnare/Svar</a><br />
  <a href="#">Topp 40: 1991-2009 </a><br />
  </span>

  <img src="graphics/left_box_stripe.png" width="125" class="leftBox2Stripe" />
  
  <img src="graphics/redaktionen.png" class="leftBox2Title"/><br />
  
  <span class="smallWhite">
 <a href="#"> Artikelregister</a><br />
  <a href="#">Nyhetsregister</a><br />
  <a href="#">Recensioner</a><br />
  <a href="#">Korsord</a><br />
  <a href="#">Tävlingsvinnare/Svar</a><br />
  <a href="#">Topp 40: 1991-2009 </a><br />
  </span>
  
  </div>


</div>
   



</div>



<div id="centerContainer">




