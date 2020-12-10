<?php

include 'utility.php';


$a = new Utils();


// CHart Type
$cht = "qr";

// CHart Size
$chs = "300x300";

// CHart Link
// the url-encoded string you want to change into a QR code


$chl = $a->save_QRCode();

// CHart Output Encoding (optional)
// default: UTF-8
$choe = "UTF-8";

$qrcode = 'https://chart.googleapis.com/chart?cht=' . $cht . '&chs=' . $chs . '&chl=' . $chl . '&choe=' . $choe;


?>

<img src="<?php echo $qrcode ?>" alt="My QR code">