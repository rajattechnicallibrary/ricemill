<?php 

//logger, make sure the directory or the file pixel.log is writable
function printLog($str)
{
  file_put_contents( 'pixel.log', $str."\n", FILE_APPEND | LOCK_EX );
}
 
$my_file = 'file.txt';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$data = "Date:- ".date('Y-m-d H:i:s')."\n".'Remote Address:-  '.$_SERVER['REMOTE_ADDR']."\n";
fwrite($handle, $data);


//log some info
printLog(date('Y-m-d H:i:s'));
printLog('Remote Address: '.$_SERVER['REMOTE_ADDR']);

if (isset($_GET['a'])) {
    printLog('a: '.$_GET['a']);
}
if (isset($_GET['b'])) {
  printLog('b: '.$_GET['b']);
}
if (isset($_GET['c'])) {
  printLog('c: '.$_GET['c']);
}
 
//output the image
//header('Content-Type: image/gif');
 
// This echo is equivalent to read an image, readfile('pixel.gif')
echo 'Your Remote Address: '.$_SERVER['REMOTE_ADDR']


?>