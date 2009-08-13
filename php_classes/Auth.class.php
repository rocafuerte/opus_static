<?php 
class Auth{
	private $lang;
	
	public function __construct($lang){
		$this->lang=$lang;
	}
	
	private function loginDisplay(){
		if($this->lang=="se"){
	?>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              Anv&auml;ndarnamn<br />
              <input type="text" name="username">
              <br />
              L&ouml;senord<br />
              <input type="password" name="password">
              <br /><br />
              <input type="submit" name="submit" value="Login">
            </form>
    <?php
		}
	}
	
	private function loginWrong(){
		if($this->lang=="se"){
		?>				
			<p> Fel anv&auml;ndarnamn eller l&ouml;senord<br />
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
			  Anv&auml;ndarnamn<br />
			  <input name="username" type="text" />
			  <br />
			  L&ouml;senord<br />
			  <input name="password" type="password" />
			  <br />
			  <br />
			  <input type="submit" name="submit" value="login" />
			</form>
			</p>
        <?php
		}		
	
	}
	
	public function login($redirect){ 
		if (isset($_POST['submit'])){

			$query = "SELECT username, password, admin_level FROM admin WHERE username='".$_POST['username']."' && password = '".md5($_POST['password'])."'";
			//$u = mysql_result($result,0,"username");
			$result = mysql_query($query) or die(mysql_error());
		
			if((mysql_num_rows($result)>0) && (mysql_result($result,0,"username")==$_POST['username']) && 
				(mysql_result($result,0,"password")==md5($_POST['password'])) ){
				
					$_SESSION['admin_logged']= $_POST['username'];
					$_SESSION['admin_password']= md5($_POST['password']);
					$_SESSION['admin_level'] = mysql_result($result,0,"admin_level");
					//if(isset($_GET['redirect'])) $redirect=$_GET['redirect'];
					
					header("Refresh: 1; URL=".$redirect."");		
					echo 'Om inte l&auml;sare klarar detta s&aring; tryck h&auml;r <a href="'.$redirect.'">klicka h&auml;r</a>';	
			}else{
				$this->loginWrong();
			}
		}else{// Submit not set
			$this->loginDisplay();
		}
	}
	
	public function auth($table,$level,$login_site,$redirect){
		
		$query="SELECT admin_level FROM $table WHERE username='".$_SESSION['admin_logged']."' AND password='".$_SESSION['admin_password']."' ";
		$result = mysql_query($query) or die(mysql_error());
		$results=mysql_num_rows($result);
		
		if($results==1 && $_SESSION['admin_level']>=$level){
			//Do nothing
		}else{
			$redirect = $_SERVER['PHP_SELF'];
			header("Refresh: 1; URL=".$login_site."?redirect=".$redirect."");
			echo 'Om din l&auml;sare inte har st&ouml;d för detta <a href="'.$login_site.'?redirect='.$redirect.'">tryck h&auml;r</a>';
			die();  
		}
	}
	
	public function register(){
		$form = new Form();
		$form->common($this->lang,"");
	}
	
	public function registerAdmin(){
		$form = new Form();
		$form->common($this->lang,"");
	}
	
	public function createdDBTable(){
		$query="";
		$result = mysql_query($query);
	}
	
	public function logout($url){
		session_destroy();
		if($this->lang=="se"){
			echo "Du har loggats ur. V&auml;nligen v&auml;nta...";
		}
		header("Refresh: 1; URL=".$url);
	}
}