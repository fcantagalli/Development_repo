<?php
$link="Homework_3_test_page.html"; 
$word="Alicante";
//if (isset($_GET["var1"])){
//	$link=$_GET["var1"];
//}
//if (isset($_GET["var2"])){
//	$word=$_GET["var2"];
//}

$text=file_get_contents($link);
$word = str_replace("\"", "", $word);
$word = str_replace("'s", "", $word);
$word = preg_replace('/[,.;:{}\"!\?\(\)°]/', ' ', $word);
$word = preg_replace('/[^a-zà-úÀ-Ú0-9?\s]-?[^a-zà-ú0-9?\s]+/i',' ',$word);
$word = str_replace("*", "", $word);
$word = str_replace("%", "", $word);

//$source = '<div class="subtitle">PHP is a widely-used general-purpose scripting language for web development.</div>';

$start = '<body>';
$end = '</body>';
$new = "<span style=\"background-color: #FFFF00;\">";

$text = preg_replace('#('.preg_quote($start).')(.*)('.preg_quote($end).')#si', '$1'.parse_content($new).'$3', $text);

function parse_content($content) {
	$words = array('Alicante'); // Let's bold some words!

	foreach($words as $word) {
		$content = str_replace($word, '<strong>'.$word.'</strong>', $content);
	}

	return $content;
}


//$regex = '/(?:<body[^>]*>)()<\/body>/';
//$text = preg_replace($regex,"<span style=\"background-color: #FFFF00;\">".$word."</span>",$text);

/*$text = str_replace($word, "<span style=\"background-color: #FFFF00;\">".$word."</span>", $text);
$word = strtoupper($word);
$text = str_replace($word, "<span style=\"background-color: #FFFF00;\">".$word."</span>", $text);
$word = strtolower($word);
$text = str_replace($word, "<span style=\"background-color: #FFFF00;\">".$word."</span>", $text);
$word = ucfirst($word);
echo ("word: ".$word);
$text = str_replace($word, "<span style=\"background-color: #FFFF00;\">".$word."</span>", $text);
*/
echo ($text);

?>