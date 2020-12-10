<?php

include 'utility.php';

$a = new Utils();


if(isset($_GET['qrcode'])){
	   
	 $qrcode=$_GET['qrcode'];
	
	 echo $a->verify_QRCode($qrcode);

}else{
	echo "NoQRCode";
}

?>