<?php
class DB {
	private $db;
	
	public function __construct(){	
		$conn = mysql_connect(Settings::$db_host, Settings::$db_username, Settings::$db_password) or die(mysql_error());
		$this->db = mysql_select_db(Settings::$db_name) or die(mysql_error());
	}
	
	# Returns a table list
	
	public function tableList(){
		print_r(mysql_list_tables($this->db)); 
	}
}

?>
