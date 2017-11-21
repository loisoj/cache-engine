# cache-engine

#top-cache
```
// Подключаем транслит
require('translit.php');
$rawurldecode = rawurldecode( $_SERVER['REQUEST_URI'] );
// Перевод кириллицы в транслит
$name = translit($rawurldecode);
// убираем все / и меняем их на -
$file1 = preg_replace ('/\//isU' , '-', $name);
// удаляем последний -
$file = rtrim ($file1, '-');
// дважды шифруем кешовый файл
$encoded = md5(md5(trim($file)));
$cachefile = 'cache-engine/cache/cache' . $encoded . '.html';
$cachetime = 18000;
// Обслуживается из файла кеша, если время запроса меньше $cachetime
if (file_exists($cachefile) && time() - $cachetime < filemtime($cachefile)) {
  echo "<!-- Cached copy, generated ".date('H:i', filemtime($cachefile))." -->\n";
   include($cachefile); exit;
}
ob_start(); // Запуск буфера вывода

#bottom-cache

// Кешируем содержание в файл
$cached = fopen($cachefile, 'w');
fwrite($cached, ob_get_contents());
fclose($cached);
ob_end_flush(); // Отправялем вывод в браузер
