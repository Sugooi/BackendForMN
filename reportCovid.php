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

	echo $a->save_infected_keys($ar);

	// foreach($ar as $value) {
 //    echo $value;
	// }

}else{
	echo "notValid";
}




?>