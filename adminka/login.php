<?php		
class UserData {
	// DATA
	public $isLogin	= false;			// true/false
	public $userId;						// Id
	public $userLogin;						// Login
	public $userName;						// Name
	
	// Settings
	public $table_prefix = '';
	public $db_con;

	function UserData($_dbConnect) {
		$this->db_con = $_dbConnect;
		$this->table_prefix = $this->db_con->_db_table_prefix_names;
		//$this->checkIsLogined();
	}
	
	function logOut() {
		$_SESSION['user_logined'] = "";
	}
	
	function checkIsLogined() {
		if( $_SESSION['user_logined'] != null && $_SESSION['user_logined'] != "" ){
			$this->userLogin = $_SESSION['user_logined'];
			
			$bd_table_name = $this->table_prefix.'_users';
			$result = mysql_query("SELECT * FROM ".$bd_table_name." WHERE login='".$this->userLogin."' LIMIT 1;");
			
			$row = mysql_fetch_array($result);
			
			$this->userId = $row["id"];
			$this->userName = $row["name"];
			$this->isLogin = true;
		}
	}
	
	function loginIn($_login, $_pass) {
		$bd_table_name = $this->table_prefix.'_users';
		$result = mysql_query("SELECT * FROM ".$bd_table_name.";");
		while( $row = mysql_fetch_array($result) ){
			if ( $_login == $row['login'] && $_pass == $row['pass'] ){
				$_SESSION['user_logined'] = $row['login'];
				$this->isLogin = true;
			}
		}
	}
	
	function RegisterNew($_login, $_pass) {
	}
	
	/*function sendPasToMail($mail){
		$email = $mail;
		$from = 'monogray@ukr.net';
		$headers  = "Content-type: text/html; charset=windows-1251 \r\n"; 
		$headers .= "From: ".$from."\r\n";
		
		$theme = 'Team Manager. Напоминание пароля';
		
		$bd_table_name = $this->table_prefix.'_users';
		$result = mysql_query("SELECT pass, login FROM $bd_table_name WHERE mail='$email' LIMIT 1;");
		$row = mysql_fetch_array($result);
		
		$mess = 'Ваш логин: '.$row['login'];
		$mess .= '<br/>Ваш пароль: '.$row['pass'];
		
		mail($email, $theme , $mess, $headers); 
	}*/
}
?>
