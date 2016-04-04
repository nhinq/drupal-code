<?php
/**
   Get contact from gmail
   - Creat project from my google developer.
   - Enable Gmail API, Contact API.
   - Creat oauth.php in mysite/oauth2callback -> redirect_uri.
   - https://accounts.google.com/o/oauth2/auth?client_id=462884957947-ov722crg0si1ibqgkame0no6ah2bhs9l.apps.googleusercontent.com&redirect_uri=http://dev-njourney.gotpantheon.com/oauth2callback/oauth.php&scope=https://www.google.com/m8/feeds/&response_type=code

*/
define('DRUPAL_ROOT', '..');

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

$client_id='462884957947-ov722crg0si1ibqgkame0no6ah2bhs9l.apps.googleusercontent.com';
$client_secret='In-RMq3mHb2lCu99Y897lZV3';
$redirect_uri='http://dev-njourney.gotpantheon.com/oauth2callback/oauth.php';
$max_results = 1000;
$code = $_GET["code"];

function curl_file_get_contents($url)
{
       $curl = curl_init();
       $userAgent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)';
       curl_setopt($curl,CURLOPT_URL,$url);  //The URL to fetch. This can also be set when initializing      a session with curl_init().
       curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);//TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
       curl_setopt($curl,CURLOPT_CONNECTTIMEOUT,5);   //The number of seconds to wait while trying to connect.
       curl_setopt($curl, CURLOPT_USERAGENT, $userAgent);  //The contents of the "User-Agent: " header to be used in a HTTP request.
       curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);  //To follow any "Location: " header that the server sends as part of the HTTP header.
      curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);  //To automatically set the Referer: field in requests where it follows a Location: redirect.
      curl_setopt($curl, CURLOPT_TIMEOUT, 10);  //The maximum number of seconds to allow cURL functions to execute.
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);  //To stop cURL from verifying the peer's certificate.
      $contents = curl_exec($curl);
      curl_close($curl);
      return $contents;
}


$fields=array(
'code'=> urlencode($code),
'client_id'=> urlencode($client_id),
'client_secret'=> urlencode($client_secret),
'redirect_uri'=> urlencode($redirect_uri),
'grant_type'=> urlencode('authorization_code')
);
$post = '';
foreach($fields as $key=>$value) { $post .= $key.'='.$value.'&'; }
$post = rtrim($post,'&');

$curl = curl_init();
curl_setopt($curl,CURLOPT_URL,'https://accounts.google.com/o/oauth2/token');
curl_setopt($curl,CURLOPT_POST,5);
curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
curl_setopt($curl,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);

$result = curl_exec($curl);
curl_close($curl);
$response = json_decode($result);
$accesstoken = $response->access_token;
$url = 'https://www.google.com/m8/feeds/contacts/default/full?max-results='.$max_results.'&oauth_token='.$accesstoken;
$xmlresponse = curl_file_get_contents($url);
if((strlen(stristr($xmlresponse,'Authorization required'))>0) && (strlen(stristr($xmlresponse,'Error '))>0)) //At times you get Authorization error from Google.
{
      echo "<h2>OOPS !! Something went wrong. Please try reloading the page.</h2>";
      exit();
}
//echo "<h3>Email Addresses:</h3>";
$xml = new SimpleXMLElement($xmlresponse);
$xml->registerXPathNamespace('gd', 'http://schemas.google.com/g/2005');
$result = $xml->xpath('//gd:email');
/*
$addemail = array();
foreach ($result as $title) {
        $addemail[] = $title->attributes()->address;
}
*/
?>
<center>Loading...</center>
<form name="myform" method="post" action="../invite?import=ok">
<?php
$i=0;
foreach ($result as $title) {
?>
<input type="hidden" name="addemail[<?php print $i++; ?>]" value="<?php print $title->attributes()->address; ?>">
<?php
}
?>
<script language="JavaScript">document.myform.submit();</script>
</form>
