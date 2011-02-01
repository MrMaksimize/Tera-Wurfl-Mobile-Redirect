<?php // Include the Tera-WURFL file
// Include the Tera-WURFL file
require_once('tera/TeraWurfl.php');
 

// instantiate the Tera-WURFL object
$wurflObj = new TeraWurfl();
$matched = $wurflObj->getDeviceCapabilitiesFromAgent();
 //
// Get the capabilities of the current client.

$width = $wurflObj->getDeviceCapability("resolution_width");
$height = $wurflObj->getDeviceCapability("resolution_height");
$qwerty = $wurflObj->getDeviceCapability("has_qwerty_keyboard");
//$browserID = $wurflObj->getDeviceCapability("browser_id");
$mobile_browser = $wurflObj->getDeviceCapability("mobile_browser");
$model= $wurflObj->getDeviceCapability("model_name");
$manu = $wurflObj->getDeviceCapability("brand_name");
$release = $wurflObj->getDeviceCapability("release_date");
$mkt_name = $wurflObj->getDeviceCapability("marketing_name");

$log = "track.csv";
$date = date('m-d-Y(H:i:s[T])');


// see if this client is on a wireless device (or if they can't be identified)
if(!$wurflObj->getDeviceCapability("is_wireless_device")){
$redirect = "non-wireless";
$fh = fopen ($log, 'a') or die("can't open file");
$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".$qwerty.",".$height.",".$width.",".$redirect."\n";
fwrite($fh, $stringData);
fclose($fh);

    // Change to the URL you want to redirect to 
   // $URL="http://corndogs.com"; 
	$URL = "http://www.prepayandsave.org/college";
     header ("Location: $URL"); 
}


//see if this client is on a tablet
if($wurflObj->getDeviceCapability("is_tablet")){
$redirect = "tablet";
$fh = fopen ($log, 'a') or die("can't open file");
$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".$qwerty.",".$height.",".$width.",".$redirect."\n";
fwrite($fh, $stringData);
fclose($fh);

    // Change to the URL you want to redirect to 
	 $URL = "http://www.prepayandsave.org/mobile/ss";
     header ("Location: $URL"); 
}



//if device thinks it can do web
else if ($wurflObj->getDeviceCapability("device_claims_web_support")){
 if ($manu == 'RIM'){ //BLACKBERRY BOLDS SUCK AT HANDLING JS
 	$redirect = "bb";
	$fh = fopen ($log, 'a') or die("can't open file");
	$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".		$qwerty.",".$height.",".$width.",".$redirect."\n";
	fwrite($fh, $stringData);
	fclose($fh);
	$URL="http://www.prepayandsave.org/mobile/bb"; 
 	} // kill if RIM
 	
 else if($mobile_browser == 'Microsoft Mobile Explorer'){ //IF OLD WIN PHONE
  	$redirect = "bb";
	$fh = fopen ($log, 'a') or die("can't open file");
	$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".					$qwerty.",".$height.",".$width.",".$redirect."\n";
	fwrite($fh, $stringData);
	fclose($fh);
	$URL="http://www.prepayandsave.org/mobile/bb"; 
 } //KILL IF OLD WIN PHONE
 
 else{
	$redirect = "ss";
	$fh = fopen ($log, 'a') or die("can't open file");
	$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".		$qwerty.",".$height.",".$width.",".$redirect."\n";
	fwrite($fh, $stringData);
	fclose($fh);
	$URL="http://www.prepayandsave.org/mobile/ss"; 
	}//all other devices that can do web
	//and shoot!
	header ("Location: $URL"); 
}

 
// here is the separator for devices that cannot do web;  
 
else if ($qwerty == false){ 
  if ($manu == 'RIM'){
		$redirect = "bb";
		$fh = fopen ($log, 'a') or die("can't open file");
		$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".$qwerty.",".		$height.",".$width.",".$redirect."\n";
		fwrite($fh, $stringData);
		fclose($fh);
		$URL="http://www.prepayandsave.org/mobile/bb"; 
	} // if rim, shoot em to the BB screen
	
	else{
		$redirect = "ft";
		$fh = fopen ($log, 'a') or die("can't open file");
		$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".$qwerty.",".		$height.",".$width.",".$redirect."\n";
		fwrite($fh, $stringData);
		fclose($fh);
		$URL="http://www.prepayandsave.org/mobile/bb"; 

	} //kill features

} 

header ("Location: $URL"); 


else{
$redirect = "bb";
$fh = fopen ($log, 'a') or die("can't open file");
$stringData = $date.",".$manu.",".$model.",".$mobile_browser.",".$mkt_name.",".$release.",".$qwerty.",".$height.",".$width.",".$redirect."\n";
fwrite($fh, $stringData);
fclose($fh);

$URL="http://www.prepayandsave.org/mobile/bb"; 
//$URL="http://corndogs.com/"; 

     header ("Location: $URL"); 


}

?>
