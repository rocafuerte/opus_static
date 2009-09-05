<?php include "header_inc.php" ?>

<div id="centerDiv">
<div class="newsBg">

<?php
	if(isset($_GET['category'])&&Helper::isInt($_GET['category'])){
	$category = new Query("vimmel_categories");
 	$category->whereQuery("*","rowid",$_GET['category'],"date","DESC",1);
	echo '<span class="boldWhite">'.$category->getResultRow("title").'</span><br />';
	echo'<span class="smallWhite">'. nl2br($category->getResultRow("description")).'</span>';
	
	
		if(Helper::isInt($_GET['id']) && Helper::hasValue($_GET['id']) && Helper::givesResult("vimmel_images","rowid",$_GET['id'])){ 
			$query=new Query("vimmel_images");
			$query->whereLeftJoinImageQuery("*","rowid",$_GET['id'],"rowid","ASC");
			$image= new ShowImages($query);
			?>
	  <div class="showImg">
      <br />
		<table border="0" cellpadding="0" cellspacing="0">
		  <tr>
			<td><?php 
			echo $image->showImage(350);  
			?>
            
			</td>
		  </tr>
		  <tr>
			<td align="right" class="smallGrey2"><?php 
			if($query->getResultRow("photo")!=""){
				echo 'Foto: '.$query->getResultRow("photo").'</span>';
			}
			?>
			</td>
		  </tr>
		</table>
	
		<div class="thumbnailDesc"><span class="smallWhite"><?php echo Helper::text($query->getResultRow("description")); ?></span><br /><br />
		</div>
	  </div>
	  <?php
		}
		?>
	  <br />
	  <br />  
		  <div class="thumbnailContainer">
			<?php 
			if(Helper::isInt($_GET['category'])){
				$query = new Query("vimmel_images");
				$query->whereLeftJoinImageQuery("*","category",$_GET['category'],"date","DESC");  
				// Dont forget the Javascript (effect.js)!!!
				$images = new ShowImages($query); 
				$images->closeupVimmelThumbs($query,50);	
			}
			?>
		  </div>
		  
	  <?php
  }// if(isset($_GET['category']) end

  $categories = new Query("vimmel_categories");
  $categories->makeQuery("*","date","DESC",10000);
  echo '<span class="boldPink">Bildgalleri</span><span class="smallWhite"></span><br /><br />';
  while($row = mysql_fetch_object($categories->getResult())){
  		echo '<span class="boldWhite"><a href="?category='.$row->rowid.'">'.$row->title.'</a></span><br /><br />';
  }  
  ?>
  </div>
  </div>
<?php include "footer.php"; ?>