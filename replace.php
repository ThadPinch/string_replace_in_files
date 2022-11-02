<?php
function listAllFiles($dir) {
  $array = array_diff(scandir($dir), array('.', '..'));
 
  foreach ($array as &$item) {
    $item = $dir . $item;
  }
  unset($item);
  foreach ($array as $item) {
    if (is_dir($item)) {
     $array = array_merge($array, listAllFiles($item . DIRECTORY_SEPARATOR));
    }
  }
  return $array;
}

// Search the contents of a file for a string and replace it with another string
function search_the_file($file, $search, $replace) {
	$file_contents = file_get_contents($file);
	$file_contents = str_replace($search, $replace, $file_contents);
	file_put_contents($file, $file_contents);
}

$strings = array(
	'this' => 'that',
);

$files = listAllFiles('./');
foreach ($files as $file) {
	if (is_file($file) && $file !== 'index.php' && strpos($file, 'git') === false) {
		foreach ($strings as $search => $replace) {
			search_the_file($file, $search, $replace);
		}
	}
}

?>
