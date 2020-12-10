<?php


class Mysql
{
	private $conn;

	function __construct()
	{	
		$servername = "sql100.epizy.com";
		$username = "epiz_26851302";
		$password = "BzpNsljo4SFif";

		try {
  		$this->conn = new PDO("mysql:host=$servername;dbname=epiz_26851302_MN", $username, $password);
  		// set the PDO error mode to exception
  		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  		echo "Connected successfully";	
		} catch(PDOException $e) {
  		echo "Connection failed: " . $e->getMessage();
		}


	}

	function save_QRCode(){

		$token=$this->randomToken()

		$hash= password_hash($token, PASSWORD_DEFAULT);

			try {
			$sql = "insert into ActivatedCodes(activatedcodes) values(:qrcode)";

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':qrcode', $hash);
			$stmt->execute();
			return $token;

		} catch (PDOException $e) {
			 //echo "Error: " . $e->getMessage();
			return "unsuccessful"
		}
	}

	function verify_QRCode($qrcode){
		try {

			$sql = 'SELECT activatedcodes FROM ActivatedCodes
				WHERE activatedcodes = :qrcode
				LIMIT 1';

			$stmt = $this->conn->prepare($sql);

			$stmt->bindParam(':qrcode', $qrcode);
			$stmt->execute();
			$arr = $stmt->fetch();

			if (!$arr) return 'invalid';
			// echo $arr['activatedcodes'];
			return 'valid';
			
		} catch (PDOException $e) {
			// echo "Error: " . $e->getMessage();
			return $->getMessage();
		}

	}

	function save_infected_keys($keys){

		foreach ($arr as &$value) {

			try {
			$sql = "insert into InfectedKeys(infectedkeys) values(:value)";

			$stmt = $this->conn->prepare($sql);
			$stmt->bindParam(':value', $value);
			$stmt->execute();
			

		} catch (PDOException $e) {
			 echo "Error: " . $e->getMessage();
			 return false;
		}
    	
		}

		return true;

	}

	function calculate_risk($keys){


		foreach ($arr as &$value) {

			try {
			
				$sql = 'SELECT infectedkeys FROM InfectedKeys
				WHERE infectedkeys = :value
				LIMIT 1';

			$stmt = $this->conn->prepare($sql);

			$stmt->bindParam(':value', $value);
			$stmt->execute();
			$arr = $stmt->fetch();

			if (!$arr) return 'atrisk';
			// echo $arr['activatedcodes'];
			

		} catch (PDOException $e) {
			 echo "Error: " . $e->getMessage();
			 return false;
		}

		return 'notatrisk'
    	
		}

	}

	function randomToken()
	{
		$alphabet    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
		$pass        = array(); //remember to declare $pass as an array
		$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
		for ($i = 0; $i < 8; $i++) {
			$n      = rand(0, $alphaLength);
			$pass[] = $alphabet[$n];
		}
		return implode($pass); //turn the array into a string
	}
}

?> 
