<?php
class Helper{
	static function hasValue($var){
		if(isset($var) && $var!="" && $var!=0) return 1;
		return 0;	
	}
	
	static function hasValueArray($a){
		//print_r($a);
		//echo count($a);
		for($i=0; $i<count($a);$i++) {
			//echo $a[$i];
			if(!isset($a[$i]) || $a[$i]=="" || ($a[$i]=="0")){
				return false;
			}
		}
		
		return true;	
	}
	
	static function givesResult($table,$field,$value){
		$query="SELECT * FROM $table WHERE $field = '$value'";
		$return = mysql_query($query) or die(mysql_error());
		return mysql_num_rows($return);
	}
	
	static function safeSql($text){
		if(get_magic_quotes_gpc()) {
			$text=stripslashes($text);
		}
		return mysql_real_escape_string($text);
	}
	
	static function intValue($i){
		return (int) $i;
	}
	
	static function isInt($i){	
		if (ereg ("^[0-9]*$", $i)) {
			return 1;
		} else {
			return 0;
		}	
	}
	
	static function isText($text){
		if (ereg("^[0-9a-zA-Z@,_ .:!?едц≈ƒ÷]*$", $text)) {
			return 1;
		} else {
			return 0;
		}	
	}
	
	static function isTextArray($a){
		for($i=0; $i<count($a);$i++) {
			if (!ereg("^[0-9a-zA-Z@,_ .:!?едц≈ƒ÷]*$", $a[$i])) {
				return 0;
			} 
		}
		return 1;
	}
	
	static function validateEmail($email){
		$regexp = "^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,6})$";
		if (eregi($regexp, $email)) return 1;
		else return 0;
	}
	
	static function sweMonth($month){
		switch ($month){
			case 1:return "Januari";
			break;
			case 2:return "Februari";
			break;
			case 3:return "Mars";
			break;
			case 4:return "April";
			break;
			case 5:return "Maj";
			break;
			case 6:return "Juni";
			break;
			case 7:return "Juli";
			break;
			case 8:return "Augusti";
			break;
			case 9:return "September";
			break;
			case 10:return "Oktober";
			break;
			case 11:return "November";
			break;
			case 12:return "December";
			break;
		
		}
	}
	
	static function sweDay($day){
		switch ($day){
			case 1:return "M&aring;ndag";
			break;
			case 2:return "Tisdag";
			break;
			case 3:return "Onsdag";
			break;
			case 4:return "Torsdag";
			break;
			case 5:return "Fredag";
			break;
			case 6:return "L&ouml;rdag";
			break;
			case 0:return "S&ouml;ndag";
			break;
		}
	}
}
?>