<?php
	$filename = "Homework_3_test_page.html";

	$file = loadFile($filename);

	//echo $file;

	$metaTags = get_meta_tags($filename);


	echo "<h3> Meta Information </h3>";

	foreach($metaTags as $key=>$element){
		echo $key." : ".$element."<br/>";
	}
	$noTags = strip_tags($file);

	//echo $noTags."<br>";
	$arrayWords = array();
	
	//$noTags = str_replace(".", "", $noTags);
	//$noTags = str_replace(",", "", $noTags);
	$noTags = str_replace("\"", "", $noTags);
	//$noTags = preg_replace('[[^\w]|[\"\.‰,]]', ' ', $noTags);
	$noTags = preg_replace('/(([^a-z0-9]|&[aeiou]acute;)-?([^a-z0-9]|&[aeiou]acute;))+/i',' ',$noTags);
	$noTags = str_replace("'s","",$noTags);
	//$noTags = preg_replace('/([^a-z0-9]|&[aeiou]acute;)+/i',' ',$noTags);
	//echo $noTags."<br/>";

	$str = strtok($noTags," \n\t");

	while($str !== FALSE){
		$str = strtolower($str);
		if(array_key_exists($str, $arrayWords)) $arrayWords[$str]++;
		else $arrayWords[$str] = 1;
		$str = strtok(" \n\t");
	}
	ksort($arrayWords);

	//print_r($arrayWords);
?>

<ul>
	<?php
		$arrayKeys = array_keys($arrayWords);
		for($i = 0; $i < sizeof($arrayKeys); $i++){
			echo "<li>".$arrayKeys[$i]." : ".$arrayWords[$arrayKeys[$i]]."</li>";
		}
	?>
</ul>

<!-- Functions in PHP -->

<?php

	function loadFile($filename){
		$mode="r";
		$file = "";
		if ($fp=fopen($filename,$mode)) {
			echo "File is opened<br><br>";
			while ($str = fgets($fp, 1000)) {
				//echo $str,"<br>";
				$file .= $str;
			}
		}
		else 
			echo "Could not open file";
		if (fclose($fp)) 
			echo "<br>File closed";

		return $file;
	}

?>