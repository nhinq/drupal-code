<?php
/*
Subesh Pokhrel
subesh.com.np
Mapping The IP Address to Latitude and Longitude.
The function getRealIpAddr() is taken from roshanbh.com.np
*/
function getRealIpAddr()

{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))
  //check ip from share internet
  {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
  }
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
  //to check ip is pass from proxy
  {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
  }
  else
  {
    $ip=$_SERVER['REMOTE_ADDR'];
  }
  return '118.69.61.189';
}

function IPtoLatLng($ip)
{
	$latlngValue=array();
	$dom = new DOMDocument();
	$ipcheck = ip2long($ip);

    if($ipcheck == -1 || $ipcheck === false){
		echo "ERROR: INVALID IP";
		exit;
	}
	else
		$uri = "http://api.hostip.info/?ip=$ip&position=true";
 
	$dom->load($uri);
	$name=$dom->getElementsByTagNameNS('http://www.opengis.net/gml','name')->item(1)->nodeValue;
	$coordinates=$dom->getElementsByTagNameNS('http://www.opengis.net/gml','coordinates')->item(0)->nodeValue;
	$temp=explode(",",$coordinates);
	$latlngValue['LNG']=$temp[0];
	$latlngValue['LAT']=$temp[1];
	$latlngValue['NAME']=$name;
	return $latlngValue;	
}


/*
 * This routine calculates the distance between two points (given the     
 * latitude/longitude of those points).   
 */
function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
   return ($miles * 1.609344);
  } else if ($unit == "N") {
   return ($miles * 0.8684);
  } else {
   return $miles;
  }
}

function get_nearest_port($nid) {	
	$user = user_load(arg(1));
	$out = '';
	if (!isset($user->field_change_your_home_port['und'][0]['value'])) {
		$IP = getRealIpAddr();
		$latlng = IPtoLatLng('118.69.61.189');
	} else {
		$latlng = getLatLong($user->field_change_your_home_port['und'][0]['value']);
	}
	

		$node = node_load($nid);			
    
		$distances = distance($latlng['LAT'], $latlng['LNG'],  $node->field_latitude['und'][0]['value'], $node->field_longitude['und'][0]['value'], 'M');
  //  $distances = distance($latlng['LAT'], $latlng['LNG'],  25.7968,-80.225945, 'M'); //test Miami
    
    $out .= '<div class="dis-miles">' . round($distances, 2) . ' Miles away</div>';
	
	
	return $out;
}

function getLatLong($code){
 $mapsApiKey = 'AIzaSyDD2Xh35gHfhs45wTTZo2rWbAJ6CJZZ9jU';
 // AIzaSyDymE4Z7w0D57K_K2g8_PNPFaDMQobdmE4 
 $query = "http://maps.google.co.uk/maps/geo?q=".urlencode($code)."&output=json&key=".$mapsApiKey;
 $data = file_get_contents($query);
 // if data returned
 if($data){
  // convert into readable format
  $data = json_decode($data);
  $long = $data->Placemark[0]->Point->coordinates[0];
  $lat = $data->Placemark[0]->Point->coordinates[1];
  return array('LAT'=>$lat,'LNG'=>$long);
 }else{
  return false;
 }
}



function get_nearest() {	
 
	$out = '';
	if (!isset($user->field_change_your_home_port['und'][0]['value'])) {
		$IP = getRealIpAddr();
		$latlng = IPtoLatLng($IP);
	} else {
		$latlng = getLatLong($user->field_change_your_home_port['und'][0]['value']);
	}
	

 			
    
		$distances = distance($latlng['LAT'], $latlng['LNG'],  41.521854, -88.172032, 'M');
  //  $distances = distance($latlng['LAT'], $latlng['LNG'],  25.7968,-80.225945, 'M'); //test Miami
     $out .= 'YOUR<br>';
     $out .= $latlng['LAT'].'lat<br>';
     $out .= $latlng['LNG'].'lng<br>';
     $out .= '<div class="dis-miles">distance is: ' . round($distances, 2) . ' Miles away</div>';
	
	
	return $out;
}
print get_nearest();