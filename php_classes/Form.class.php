<?php
class Form{
	private $fieldArray;
	public function __construct(){
	
	}
	
	public function firstNameField($class){
		return '<input name="first_name" type="text" class="'.$class.'"/>';
	}
	
	public function textField($name,$value,$class){
		return '<input name="'.$name.'" class="'.$class.'" value="'.$value.'" />';
	}
	
	public function lastNameField($class){
		return '<input name="last_name" type="text"class="'.$class.'"/>';
	}
	
	public function adressField($class){
		return '<input name="adress" type="text"class="'.$class.'"/>';
	}
	
	public function coField($class){
		return '<input name="co" type="text" class="'.$class.'"/>';
	}
	
	public function cityField($class){
		return '<input name="city" type="text" class="'.$class.'"/>';
	}
	
	public function zipField($class){
		return '<input name="zip" type="text" maxlength="5" class="'.$class.'"/>';
	}
	
	public function countryField($class){
		return '<input name="country" type="text" class="'.$class.'"/>';
	}
	
	public function emailField($class){
		return '<input name="email" type="text" class="'.$class.'"/>';
	}
	
	public function verificationField($class){
		return '<input name="scramble" type="text" class="'.$class.'"/>';
	}
	
	public function submitButton($class,$value){
		return '<input name="action" type="submit" value="'.$value.'" class="'.$class.'"/>';
	}
	
	public function verification(){
		return '<img src="scrambleImg.php"/>';
	}
	
	public function common($lang,$class){
		if($lang=="se"){
			echo '<strong>Namn</strong><br/>'.$this->firstNameField($class).'<br/><br/>';
			echo '<strong>Efternamn</strong><br/>'.$this->lastNameField($class).'<br/><br/>';
			echo '<strong>Adress</strong><br/>'.$this->adressField($class).'<br/><br/>';
			echo '<strong>c/o</strong><br/>'.$this->coField($class).'<br/><br/>';
			echo '<strong>Postnummer</strong><br/>'.$this->zipField($class).'<br/><br/>';
			echo '<strong>Postort</strong><br/>'.$this->cityField($class).'<br/><br/>';
			echo '<strong>Land</strong><br/>'.$this->countryField($class).'<br/><br/>';
			echo '<strong>E-mail</strong><br/>'.$this->emailField($class).'<br/><br/>';
			echo '<strong>Verifieringskod</strong><br/>'.$this->verification().'<br/><br/>';
			echo '<strong>Skirv in verifieringskoden</strong><br/>'.$this->verificationField($class).'<br/><br/>';
		}
	}
	
	public function validateCommon($table){
		$posts = array($_POST['first_name'],$_POST['last_name'],$_POST['scramble'],$_POST['email'],$_POST['adress'],$_POST['city'],$_POST['country'],$_POST['zip']);
		if(!Helper::hasValueArray($posts)){
			echo "Du har inte fyllt i alla fält.";
			return 0;
		}
		else if(!$this->validateEmail($_POST['email'])){
			echo "Du har angivit en felaktig e-mailadress.";
			return 0; 
		}
		else if($_POST['scramble'] != $_SESSION['nonce']){
			echo "Du har inte angivit rätt verifieringskod.";
			return 0;
		}
		else if(!Helper::isInt($_POST['zip'])){
			echo "Du har angivit ett felaktikt postnummer.";
			return 0; 
		}
		else if(!Helper::isText($_POST['first_name'])||!Helper::isText($_POST['last_name'])||!Helper::isText($_POST['adress'])||!Helper::isText($_POST['city'])||!Helper::isText($_POST['country'])||!Helper::isText($_POST['scramble'])){
			echo "Du har anv&auml;nt otill&aring;tna tecken.";
			return 0; 
		}
		else{
			return 1;
		}
		
	}
	
	private function validateEmail($email){
		$regexp = "^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,6})$";
		if (eregi($regexp, $email)) return 1;
		else return 0;
	}
	
	private function safeSql($text){
		if(get_magic_quotes_gpc()) {
			$text=stripslashes($text);
		}
		return mysql_real_escape_string($text);
	}
	
	public function insertCommon($table){
		$first_name=$this->safeSql($_POST['first_name']);
		$last_name=$this->safeSql($_POST['last_name']);
		$adress=$this->safeSql($_POST['adress']);
		$email=$this->safeSql($_POST['email']);
		$country=$this->safeSql($_POST['country']);
		$zip=$this->safeSql($_POST['zip']);
		$city=$this->safeSql($_POST['city']);
			
		$query="INSERT INTO $table SET 			
				adress='$adress',
				first_name='$first_name',
				last_name='$last_name',
				city='$city',
				country='$country',
				zip='$zip',
				email='$email'";
		$result = mysql_query($query) or die(mysql_error());
	
	}
}
?>