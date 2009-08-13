<?php

class ShowDemos {
	private $q;
	
	public function __construct(Query $query){
		$this->q = $query;	  
	} 
	
	public function listDemos(Paging $paging){
		 while($row = mysql_fetch_assoc($paging->pagingResult)){
		 	if($row['rowid']==$_GET['demo_id']) continue;
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
					<td width="80" class="noPadding" rowspan="2"><img src="image_crop.php?source=<?php echo Settings::getUploadedImages().'/'.$file_name ?>&dest=&thumb_size=80" class="flowPic" /></td>
					<?php
                }	
				?>	
				<td width="270" class="tdPadding" colspan="2"><span class="boldGrey"><?php echo $row['name']; ?></span></td>
			  </tr>
			  <tr>
				<td class="tdVertBottom"><span class="smallPink"><a href="?demo_id=<?php echo $row['rowid']; ?>">L&auml;s mer</a></span></td>
				<td align="right" class="tdVertBottom"><span class="smallGrey"><?php echo date("Y-m-d",strtotime($row['date'])); ?></span></td>
			  </tr>
			</table>
			<?		 
		 }
	}
}

?>
