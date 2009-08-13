<?php
class Review{
	private $q;
	
	public function __construct(Query $query){
		$this->q = $query;	  
	} 
	
	public function listReviews(Paging $paging){
		 while($row = mysql_fetch_assoc($paging->pagingResult)){
		 	if($row['rowid']==$_GET['id'] && isset($_GET['id']) && $_GET['id']!="") continue;
			 // Got to make a new query beacuse of error in mysql_fetch_assoc 
			 $query = new Query($this->q->getTable());
			 $query->whereLeftJoinImageQuery("*","image_id",$row['image_id'],"rowid","ASC");
			 $image_id = $query->getResultRow("image_id");
			 $file_name=$query->getResultRow("file");
			 ?>
             
			<table border="0" cellpadding="0" cellspacing="0" class="demoTable">
			  <tr>
              <?php
				if(Helper::hasValue($image_id)){
				?>
				<td width="80" class="noPadding" rowspan="2">
							
					<?php echo '<a href="?id='.$row['rowid'].'"><img src="image_crop.php?source='.Settings::getUploadedImages().'/'. $file_name.'&dest=&thumb_size=80" alt="'.$row['name'].'" border="0"/></a>'; ?>
                    
				            
				</td>
                <?php
                }	
				?>	
				<td width="270" class="tdPadding" colspan="2"><a href="?id=<?php echo $row['rowid']; ?>"><span class="boldGreyLighter"><?php echo $row['title']; ?></span></a></td>
			  </tr>
			  <tr>
				<td class="tdVertBottom"><span class="smallPink"><a href="?id=<?php echo $row['rowid']; ?>">L&auml;s mer</a></span></td>
				<td class="tdVertBottom" align="right"><span class="smallGrey"><?php echo date("Y-m-d",strtotime($row['date'])); ?></span></td>
			  </tr>
			</table>
			<?		 
		 }
	}
	
	public function showReview(){
		if(Helper::hasValue($_GET['id'])){
			$query = new Query($this->q->getTable());
			$query->whereLeftJoinImageQuery("*","rowid",$_GET['id'],"date","ASC");
			?>
			<div class="newsHeader"><span class="smallGrey"><?php echo date("Y-m-d",strtotime($query->getResultRow("date")));?></span> <br />
			
			<span class="newsHeaderSmaller"><?php echo $query->getResultRow("title");?></span></div>
			  
			<div class="showImg">
			<?php 
			if(Helper::hasValue($query->getResultRow("image_id"))){
				?>
                 <table><tr><td>
                 <?php 
				 echo Image::displayImage($query->getResultRow("file"),340,"",$query->getResultRow("name"));	
				 
				
				?>
                </td>
                </tr>
                <tr>
                <td align="right" class="smallGrey2">
				<?php
				if($query->getResultRow("photo")!=""){
					echo '<span class="smallGrey">Foto: '.$query->getResultRow("photo").'</span>';
				}
				?>
                </td>
                </tr>
                </table>
                <?php 
			}
			?>
            
            
            
            
			</div>
            
			<div class="textContainer"><?php echo nl2br($query->getResultRow("text"));?>
			<br /><br />
		<!--	<a href="<?php echo $query->getResultRow("link_url");?>"><?php echo $query->getResultRow("link_url");?></a>
			<br /><br />-->
			 
			<span class="smallGrey">
			<?php 
			$personalInfo = new Query("personal");
			$personalInfo->whereQuery("*","username",$query->getResultRow("published_by"),"username","ASC",1);
			echo "Av: ".$personalInfo->getResultRow("first_name")." ".$personalInfo->getResultRow("last_name");
			?>
			</span> 
			</div>

<?php 
}
	
	} 
}

?>
