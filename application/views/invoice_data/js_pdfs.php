<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
 <head>
   <meta charset="utf-8">
 </head>
 <body>

   <?php 
   // Message
   if(isset($response)){
     echo $response;
   }
   ?>

   <form method='post' action='' enctype="multipart/form-data">
    <select name="centerType" id="" required>
    <option value="">Select Center</option>
    <option value="1">First Center</option>
    <option value="2">Second Center</option>
    </select>
     <input type='file' name='file' >
     <input type='submit' value='Upload' name='upload'>
   </form>

  </body>
</html>