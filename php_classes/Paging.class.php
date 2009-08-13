<?php
class Paging{
	private $q;
	private $pagingRecordstart;
	private $pagingPageSize;
	private $currentPage;
	private $totalPages;
	private $pagingQuery;
	public $pagingResult;
	
	
	# Takes the Query that you want to do paging at and the page size;
	
	public function __construct(Query $q,$pagingPageSize){
		$this->q=$q;		
		$this->pagingPageSize = $pagingPageSize;
		$this->setPreconditions();
	}
	
	private function setPreconditions(){
		// The order is important
		$this->pagingRecordstart = (int) $_GET['recordstart'];
		$this->pagingRecordstart = (isset($_GET['recordstart'])) ? $_GET['recordstart'] : 0;
		$this->setCurrentPage();
		$this->setTotalPages();
	}
	
	public function showPaging($totalpages, $currentpage, $pagesize, $parameter) {

	   // Start at page one
	   $page = 1;
	   // Start at record zero
	   $recordstart = 0;
	   // Initialize $pageLinks
	   $pageLinks = "";
	   while ($page <= $totalpages) {
		  // Link the page if it isn't the current one
		  if ($page != $currentpage) {
		  	 if(isset($_GET['category'])){
			 	$pageLinks .= "<a href=\"".$_SERVER['PHP_SELF']."?$parameter=$recordstart&category=".$_GET['category']."\">$page</a> ";
			 }else{
			 	$pageLinks .= "<a href=\"".$_SERVER['PHP_SELF']."?$parameter=$recordstart\">$page</a> ";
			 }
		  // If the current page, just list the number
		  } else {
			 $pageLinks .= "$page ";
		  }
			 // Move to the next record delimiter
			 $recordstart += $pagesize;
			 $page++;
	   }
	   return $pageLinks;
	}
	
	# Returns the Next button
	
	public function nextShow($lang,$class){

		if($this->q->getNumRows() > ($this->pagingRecordstart + $this->pagingPageSize)) {
			$next = $this->pagingRecordstart + $this->pagingPageSize;
			//special for close-up market
			if(isset($_GET['category'])){
				$url = $_SERVER['PHP_SELF']."?recordstart=$next&category=".$_GET['category']."";
			}else{
				$url = $_SERVER['PHP_SELF']."?recordstart=$next";
			}
			switch ($lang) {
				case "se": return '<span class="'.$class.'"><a href="'.$url.'">N&auml;sta</a></span>';
    			case "en": return '<span class="'.$class.'"><a href="'.$url.'">Next page</a></span>';
			}
		}		
	}
	
	# Returns the Previous button
	
	public function previousShow($lang,$class){
		if($this->pagingRecordstart > 0) {
			$prev = $this->pagingRecordstart - $this->pagingPageSize;
			//special for close-up market
			if(isset($_GET['category'])){
				$url = $_SERVER['PHP_SELF']."?recordstart=$prev&category=".$_GET['category']."";
			}else{
				$url = $_SERVER['PHP_SELF']."?recordstart=$prev";
			}
			switch ($lang) {
				case "se": return '<span class="'.$class.'"><a href="'.$url.'">F&ouml;reg&aring;ende</a></span>';
    			case "en": return '<span class="'.$class.'"><a href="'.$url.'">Previous page</a></span>';
			}
		}
	}
	
	public function where(){
		$this->pagingQuery="SELECT ".$this->q->getAskFor()." FROM ".$this->q->getTable()." 
							WHERE ".$this->q->getField()." = '".$this->q->getValue()."'
							ORDER BY ".$this->q->getOrderBy()." ".$this->q->getOrder()."
							LIMIT ".$this->pagingRecordstart.", ".$this->pagingPageSize." ";
		$this->pagingResult = mysql_query($this->pagingQuery) or die(mysql_error());
	
	}
	
	public function whereCustom(){
		$this->pagingQuery="SELECT ".$this->q->getAskFor()." FROM ".$this->q->getTable()." 
							WHERE ".$this->q->getExpression()."
							ORDER BY ".$this->q->getOrderBy()." ".$this->q->getOrder()."
							LIMIT ".$this->pagingRecordstart.", ".$this->pagingPageSize." ";
		$this->pagingResult = mysql_query($this->pagingQuery) or die(mysql_error());
	}
	
	# This method will be called from the constructor and does the paging query;
	
	public function makePagingQuery(){
		$this->pagingQuery="SELECT ".$this->q->askFor." FROM ".$this->q->getTable()." 
							ORDER BY ".$this->q->orderBy." ".$this->q->order." 
							LIMIT ".$this->pagingRecordstart." , ".$this->pagingPageSize." ";
		$this->pagingResult = mysql_query($this->pagingQuery) or die(mysql_error());
	}
	
	
	# This method will be called from the constructor and does the paging query;
	
	public function leftJoinImage(){
		$this->pagingQuery="SELECT ".$this->q->getAskFor()." FROM ".$this->q->getTable()." 
							LEFT JOIN bilder 
					  		ON ".$this->q->getTable().".image_id = bilder.id
							ORDER BY ".$this->q->getTable().".".$this->q->getOrderBy()." ".$this->q->getOrder()." 
							LIMIT ".$this->pagingRecordstart." , ".$this->pagingPageSize." ";
		$this->pagingResult = mysql_query($this->pagingQuery) or die(mysql_error());
	}
	
	public function whereLeftJoinImageQuery(){
		$this->pagingQuery="SELECT ".$this->q->getAskFor()." FROM ".$this->q->getTable()."
							LEFT JOIN bilder ON ".$this->q->getTable().".image_id = bilder.id
							WHERE ".$this->q->getTable().".".$this->q->getField()." = '".$this->q->getValue()."'
							ORDER BY ".$this->q->getTable().".".$this->q->getOrderBy()." ".$this->q->getOrder()."
							LIMIT ".$this->pagingRecordstart.", ".$this->pagingPageSize." ";
		$this->pagingResult = mysql_query($this->pagingQuery) or die(mysql_error());
	}
		
	# Returns the page links
	
	public function linksShow(){
		return $this->showPaging($this->totalPages, $this->currentPage, $this->pagingPageSize, "recordstart");
	}
	
	
	public function linksShow2($lang,$pages_class,$linkClass){
		if($this->totalPages>1){
			switch ($lang) {
					case "se": return '<span class="'.$pages_class.'">Sidor: </span><span class="'.$linkClass.'">'.$this->linksShow().'</span>';
					case "en": return '<span class="'.$pages_class.'">Pages: </span><span class="'.$linkClass.'">'.$this->linksShow().'</span>';
			}
		
		}
		
	}	
	
	private function setCurrentPage(){
		$this->currentPage = ($this->pagingRecordstart / $this->pagingPageSize) + 1;
	}
	
	private function setTotalPages(){
		$this->totalPages = ceil($this->q->getNumRows() / $this->pagingPageSize);
	}
	
	public function getResult(){
		return $this->pagingResult;
	}
	
	public function displayLinks($lang,$link_class,$pages_class){
		echo $this->linksShow2($lang,$pages_class,$link_class).' '.$this->previousShow($lang,$link_class).' '.$this->nextShow($lang,$link_class);
	}
}
?>
