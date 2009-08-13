<?php
# Creates a newsflow Table or News. 
# Set DB table the field you want to show and the number of results per page

class NewsTable   {//implements INewsFlow
	private $q;

	public function __construct(Query $query){	
		$this->q = $query;
	}
	
	# Creates a new table
	
	public function createTable(){
		$this->q->getPagingArray();
	}
	
	# Creates a news flow
	
	public function createNews(Paging $paging){
		while($row = mysql_fetch_assoc($paging->pagingResult)){
			?>
			<h2><?php echo $row['title'];?></h2>
			<?php
            echo $row['date']."<br />";
			echo $row['image_id']."<br />";

			if(Helper::hasValue($row['image_id'])){			
				echo '<img src="phpThumb.php/100;'.Settings::getUploadedImages().'/'. $row['file'].'" alt="'. $row['name'].'" />';
			}		
		    echo "<br />".$row['description'];?><br />
			<?php
        }
	}
	
	# Newsflow created for http://closeupmagazine.net
	
	public function closeup_new($n_of_news, $n_of_present_news){
		$i = 0;
		while($row = mysql_fetch_assoc($this->q->result)){
			$i++;
			if($i<3){?>
		
            	<h2><?php echo $row['title']; ?></h2>
                <img src="closeup/phpThumb.php/100;<?php echo $row['file']; ?>" />
			<?php	
			}else{
			?>
				<h2><?php echo $row['title']; ?></h2>
			<?php 
            }
		}
	}	
}
?>