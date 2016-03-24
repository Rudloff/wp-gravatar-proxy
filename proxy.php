<?php
/**
 * Gravatar Proxy
 * The proxy itself
 * 
 * PHP version 5.4
 * 
 * @category Plugin
 * @package  Gravatar_Proxy
 * @author   Pierre Rudloff <contact@rudloff.pro>
 * @license  GPL http://www.gnu.org/licenses/gpl.html
 * @link     https://rudloff.pro/
 */
$path =  realpath(dirname(__FILE__));
$cacheavatarpath = str_replace("plugins", "cache", $path);
if(!file_exists( $cacheavatarpath )) {
  $oldmask = umask(0);
  mkdir($cacheavatarpath, 0777, true);
  umask($oldmask);
}
$cacheavatarlink = $cacheavatarpath . "/" . $_GET['query'];
if(!file_exists($cacheavatarlink)) {
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://secure.gravatar.com/avatar/'.$_GET['query']);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $out=curl_exec($ch);
  $fp = fopen($cacheavatarlink, 'w');
  fwrite($fp, $out);
  fclose($fp);
  curl_close($ch);
}
header('Content-type: image/png');
readfile($cacheavatarlink);
?>
