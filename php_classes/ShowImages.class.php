<?php
class ShowImages{
	private $q;

	public function __construct(Query $query){
		$this->q = $query;
	
	}
	
	# Cretes an imge table with paging
	# Params $paging: the pagination object, int $cols column per row, int $width: width of the image
	
	public function closeupPaging(Paging $paging, $width){
		while($row = mysql_fetch_object($paging->pagingResult)){
			?>	
			<div class="thumbnail" > 
          <?php
          	echo '<a href="?id='.$row->rowid.'">';       
			echo '<img src="image_crop.php?source='.Settings::getUploadedImages().'/'.$row->file.'&dest=&thumb_size='.$width.'" alt="'.$row->name.'" />';		
			?>
          </a>    
          </div>
		  <?php		
		}
	}
	
	public function closeupVimmelThumbs(Query $query, $width){
		while($row = mysql_fetch_object($query->getResult())){
			?>	
			<div class="thumbnail"> 
          <?php
          	echo '<a href="?id='.$row->rowid.'&category='.$_GET['category'].'">';       
			echo '<img src="image_crop.php?source='.Settings::getUploadedImages().'/'.$row->file.'&dest=&thumb_size='.$width.'" alt="'.$row->name.'" />';		
			?>
          </a>    
          </div>
		  <?php		
		}
	}
	
	public function showImage($width){
		return '<img src="image_thumb.php?source='.Settings::getUploadedImages().'/'.$this->q->getResultRow("file").'&width='.$width.'" alt="'.$this->q->getResultRow("name").'"/>';
	}
}
?>