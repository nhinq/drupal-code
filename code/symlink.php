<?
  $target = $_SERVER["DOCUMENT_ROOT"];
  $link = $target .'/limited';
  symlink($target, $link);
?>
 <?php //unlink( '/home/cPanel_User_Name/public_html/subdomain' ); ?>