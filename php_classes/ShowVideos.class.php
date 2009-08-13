<?php
class ShowVideos {

	private $q;
	
	public function __construct(Query $query){
		$this->q = $query;
	
	}
	
	public function mainPage(){
	
		while($row = mysql_fetch_assoc($this->q->result)){
			echo $row['code'].'<br/>';
		}
	
	}
	
	public function videoPreviewPaging(Paging $paging, $cols){
		?>
        <div id="videoShow">
        <?php
		if(!isset($_GET['id'])){
			echo mysql_result($this->q->result,0,"code");
		}else{
			
		}
		?>
        </div>
      
		<table border="0" id="videoPreview">
		<tr>
		<?php
        $col = 1;
		while($row = mysql_fetch_assoc($paging->pagingResult)){
			?>
			<td valign="bottom" >
            
			<?php
			echo '<a href="?id='.$row['rowid'].'" >';
			echo $row['name']."</a><br/>";
            echo $row['code'];
			?>
			
			
			</td>
		<?php
			if($col%$cols==0) {echo "</tr><tr>"; }
			$col++;
		}
		?>
        </table>
        <?php
		
	
	}
	
	public function videoPreview($cols){
		?>
        <div id="videoShow">
        <?php
		if(!isset($_GET['id'])){
			echo mysql_result($this->q->result,0,"code");
		}else{
			echo $_GET['id'];
		}
		?>
        </div>
      
		<table border="0" id="videoPreview">
		<tr>
		<?php
        $col = 1;
		while($row = mysql_fetch_assoc($this->q->result)){
			?>
			<td valign="bottom" >
            
			<?php
			echo '<a href="object_test.php?id=2" >';
			echo $row['name']."</a><br/>";
            echo $row['code'];
			?>
			
			
			</td>
		<?php
			if($col%$cols==0) {echo "</tr><tr>"; }
			$col++;
		}
		?>
        </table>
        <?php
		
	
	}
	

}
?>