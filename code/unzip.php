

<?php



     $zip = new ZipArchive;

     $res = $zip->open('drupalcore.zip');

     if ($res === TRUE) {

         $zip->extractTo('.');

         $zip->close();

         echo 'ok';

     } else {

         echo 'failed';

     }

?> 