
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>cesoft tools</title>

    <!-- Bootstrap -->
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php
  //session_set_cookie_params(0, null, null, false, true);
// session_start();
ini_set('display_errors',1);  #TODO turn off before deploy
 
$ACCESS_PWD='cesoft2015!';
$self=$_SERVER['PHP_SELF'];
$_SESSION['is_logged']=true;
 if (!$ACCESS_PWD) {
    $_SESSION['is_logged']=true;
    loadcfg();
 }
 if ($_REQUEST['logoff']){
    $_SESSION = array();
    session_destroy();
    $url=$self;
    if (!$ACCESS_PWD) $url='/';
    header("location: $url");
    exit;
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
function print_login(){
?>
<center>

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
 

 
<div class="container">
 <form role="form" action="#" method="post">
<input type="submit" class="btn btn-default" name="logoff" value="logoff">
</form>
  <?php


function Zip($source, $destination)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }

    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
            }
            else if (is_file($file) === true)
            {
                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
            }
        }
    }
    else if (is_file($source) === true)
    {
        $zip->addFromString(basename($source), file_get_contents($source));
    }

    return $zip->close();
}
?>
<div class="well">
   <h3>Zip</h3>
    <form role="form" action="tools.php" method="post">
      <div class="form-group">
        <label for="URL">Folder zip</label>
        <input type="text" class="form-control" name="folder_zip" id="folder_zip" placeholder="sites">
      </div>
      <div class="form-group">
        <label for="file name">File Zip</label>
        <input type="text" class="form-control"  name="file_zip" id="file_zip" placeholder="sites.zip">
      </div>
    
      <div class="checkbox">
        <label>
          <input name="ok" type="checkbox"> Ok Zip
        </label>
      </div>
      <button type="submit" class="btn btn-default">Zip</button>
      <div class="form-group">
          
        <?php
        if($_POST['folder_zip'] && $_POST['file_zip'] && $_POST['ok']){
          
            Zip('./'.$_POST['folder_zip'].'/', './'.$_POST['file_zip']);
         
        }
        
        ?>
        <label class="sr-only" for="exampleInputEmail2">
        <?php
         if($down > 0){
        echo 'File have been download!';
      }?>
        </label>
 
     </div>
    </form>
   </div>
   
  <div class="well">
   <h3>Download</h3>
    <form role="form" action="tools.php" method="post">
      <div class="form-group">
        <label for="URL">URL</label>
        <input type="text" class="form-control" name="url" id="URL" placeholder="Enter url">
      </div>
      <div class="form-group">
        <label for="file name">File Name</label>
        <input type="text" class="form-control"  name="file_name" id="file_name" placeholder="sites.zip">
      </div>
    
      <div class="checkbox">
        <label>
          <input name="ok" type="checkbox"> Ok download
        </label>
      </div>
      <button type="submit" class="btn btn-default">Download</button>
      <div class="form-group">
          
        <?php
        if($_POST['url'] && $_POST['file_name'] && $_POST['ok']){
          $down = file_put_contents($_POST['file_name'], file_get_contents($_POST['url']));
         
        }
        
        ?>
        <label class="sr-only" for="exampleInputEmail2">
        <?php
         if($down > 0){
        echo 'File have been download!';
      }?>
        </label>
 
     </div>
    </form>
   </div> 
   
   <div class="well">
   <h3>Unzip</h3>
    <form role="form" action="tools.php" method="post">
      
      <div class="form-group">
        <label for="file name">Source</label>
        <input type="text" class="form-control"  name="source" id="file_name" placeholder="sites.zip">
      </div>
      <div class="form-group">
        <label for="URL">Target</label>
        <input type="text" class="form-control" name="target" id="URL" placeholder="ex: sites">
      </div>
      <div class="checkbox">
        <label>
          <input name="ok" type="checkbox"> Ok Unzip
        </label>
      </div>
      <button type="submit" class="btn btn-default">Unzip</button>
      <div class="form-group">
        <label class="sr-only" for="exampleInputEmail2">  
        <?php
         if($_POST['target'] && $_POST['source'] && $_POST['ok']){
         $zip = new ZipArchive;
         $res = $zip->open($_POST['source']);
         if ($res === TRUE) {
             $zip->extractTo($_POST['target']);
             $zip->close();
             echo 'ok';
         } else {
             echo 'failed';
         }
         }
    
    ?> 
   
        </label>
 
     </div>
    </form>
   </div>
   
   <div class="well">
   <h3>Remove Dir</h3>
   
   <?php

/**
 * @author Nguyen
 * @copyright 2013
 */
 if($_POST['dir'] && $_POST['ok']){
  Beer::deleteDir($_POST['dir']);
 }

class Beer { 
  public static function deleteDir($dirPath) {
      if (! is_dir($dirPath)) {
          throw new InvalidArgumentException("$dirPath must be a directory");
      }
      if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
          $dirPath .= '/';
      }
      $files = glob($dirPath . '*', GLOB_MARK);
      foreach ($files as $file) {
          if (is_dir($file)) {
              self::deleteDir($file);
          } else {
              unlink($file);
          }
      }
      rmdir($dirPath);
  }
}
?>

    <form role="form" action="tools.php" method="post">
      <div class="form-group">
        <label for="URL">Dir</label>
        <input type="text" class="form-control" name="dir" id="URL" placeholder="ex: module">
      </div>
      <div class="checkbox">
        <label>
          <input name="ok" type="checkbox"> Ok Remove 
        </label>
      </div>
      <button type="submit" class="btn btn-default">Remove</button>
      <div class="form-group">
        <label class="sr-only" for="exampleInputEmail2">  
      
   
        </label>
 
     </div>
    </form>
   </div>
   
</div>
 
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>

 