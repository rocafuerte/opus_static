<?php
class Settings{
  /*
	static $uploaded_images = "media/uploaded_images";	
	static $db_host = "boxmysql4.box.se:3306";
	static $db_username = "du00072312";
	static $db_password = "pXaR36kn";
	static $db_name = "db00002308";
  */
	
	static $db_host = "localhost:8889";
	static $db_username = "root";
	static $db_password = "root";
	static $db_name = "closeup";
	
	static function getUploadedImages(){
		return self::$uploaded_images;
	
	}

}

?>