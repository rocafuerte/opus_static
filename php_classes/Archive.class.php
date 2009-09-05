<?php
class Archive{
	private $table;
	private $name;
	
	
	public function __construct($table,$name){
		$this->table=$table;
		$this->name=$name;
	}
	
	public function showActive($id){
	
	}
	
	public function showMonth(){
		if(isset($_GET['year'])&&isset($_GET['month'])){
			if(Helper::isInt($_GET['year'])&&Helper::isInt($_GET['month'])){
				echo '<span class="newsHeaderSmaller">'.Helper::sweMonth($_GET['month']).' '.$_GET['year'].'</span><br /><br />';
				$query="SELECT *
						FROM ".$this->table."  
						WHERE active = '1' AND YEAR(date)='".$_GET['year']."' AND MONTH(date)='".$_GET['month']."'";
				$result=mysql_query($query) or die(mysql_error());
				while($row = mysql_fetch_object($result)){
					?>
                    <span class="smallGrey"><?php echo date("Y-m-d",strtotime($row->date)); ?></span><br />
                    <span class="boldPink"><a href="?id=<?php echo $row->rowid ?>"><?php echo $row->title ?></a></span><br />
               
<HR/><br />
                    <?php 
				}
			}else{
				echo "Felaktigt datum.";
			}
		}
	}
	
	public function showAll(){
		$query="SELECT YEAR(date) AS year 
				FROM ".$this->table." 
				WHERE active = '1' 
				GROUP BY year";
		$result=mysql_query($query) or die(mysql_error());
		echo '<span class="newsHeaderSmaller">'.$this->name.'</span><br /><br />';
		while($row1 = mysql_fetch_object($result)){
			echo '<span class="boldGrey">'.$row1->year.'</span><br />';
			$query2="SELECT MONTH(date) AS month 
					FROM ".$this->table."  
					WHERE active = '1' 
					GROUP BY month";
			$result2=mysql_query($query2) or die(mysql_error());
			while($row2 = mysql_fetch_object($result2)){
				echo '<span class="smallPink"><a href="?year='.$row1->year.'&month='.$row2->month.'">'.Helper::sweMonth($row2->month).'</a></span><br />';
			}
			echo "<br />";
		}
	}
	
	public function showActual(){
		$id = (int) $_GET['id'];
		if(Helper::givesResult($this->table ,"rowid",$id)){
			$q=new Query($this->table);
			$q->whereLeftJoinImageQuery("*","rowid",$id,"rowid","DESC");
			$personal = new Query("personal");
			$personal->whereQuery("*","username",$q->getResultRow("published_by"),"rowid","ASC","1");
			?>
			 
				  <div class="newsHeader"><span class="dateAuthor">
					<?php echo date("Y-m-d",strtotime($q->getResultRow("date"))).' '.$personal->getResultRow("first_name").' '.$personal->getResultRow("last_name"); ?>
					</span><br /><br />
					<span class="newsHeaderFont"><?php echo $q->getResultRow("title"); ?></span>
				  </div>
				  <div class="newsDescActual"><span class="boldGrey"><?php echo nl2br(strip_tags($q->getResultRow("description"),'<a><b><br><strong>')); ?></span></div>
				 <div class="newsPicActual">
				 <?php
				 
				 if($q->getResultRow("image_id")>0){
						?>
						<table><tr><td>
						<?php 			
						echo '<img src="image_thumb.php?source='.Settings::getUploadedImages().'/'. $q->getResultRow("file").'&width=340" alt="'. $q->getResultRow("name").'" />';
						?>
						</td>
						</tr>
						<tr>
						<td align="right" class="smallGrey2">
						<?php
						if($q->getResultRow("photo")!=""){
							echo '<span class="smallGrey">Foto: '.$q->getResultRow("photo").'</span>';
						}
						?>
						</td>
						</tr>
						</table>
						<?php 
					}	
				?>
				
				 </div>
				  <?php echo nl2br(strip_tags($q->getResultRow("text"),'<a><b><br><strong>')); ?>
					<br /><br />
			
			 <?php 
		 }
	}
		

}

?>
