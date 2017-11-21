<?php

require('translit.php');
$rawurldecode = rawurldecode( $_SERVER['REQUEST_URI'] );
$name = translit($rawurldecode);
$file1 = preg_replace ('/\//isU' , '-', $name);
$file = rtrim ($file1, '-');
$encoded = md5(md5(trim($file)));
$cachefile = 'cache-engine/cache/cache' . $encoded . '.html';
$cachetime = 18000;
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
  echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
   include($cachefile); exit;
}
ob_start();
?>
