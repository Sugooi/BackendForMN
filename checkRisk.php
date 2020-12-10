<?php
// $a=array("hello","there","how","are","you");
// $json = json_encode($a);
// echo $json;
// $ar=json_decode($json, true);
// echo $ar;

include 'utility.php';

$a = new Utils();


if(isset($_GET['infectedkeys'])){
	   
	$ar=$_GET['infectedkeys'];

	$ar=explode(",",$ar);

	// foreach($ar as $value) {
 //    echo $value;
	// }

	$flag=true;

	foreach ($ar as $key) {

		# code...
		$resp=$a->calculate_risk($key);
		if($resp=="found"){
			$flag=false;
			break;
		}
	}

	if($flag){echo"notatrisk";}else{
		echo "atrisk";
	}

}else{
	echo "notValid";
}




?>