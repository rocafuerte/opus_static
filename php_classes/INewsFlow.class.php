<?php 
interface INewsFlow{
	public function showPaging($totalpages, $currentpage, $pagesize, $parameter);
	public function nextShow($lang);
	public function previousShow($lang);
	public function linksShow();
}
?>