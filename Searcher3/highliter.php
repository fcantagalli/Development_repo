<?php
	$link=""; $word="";
	if (isset($_GET["var1"])){
		$link=$_GET["var1"];					
	}
	if (isset($_GET["var2"])){
		$word=$_GET["var2"];					
	}
	$temp = $word;
	$text=file_get_contents($link);
	$token = strtok($temp, "-$-");
	$array;	$count=0;
	while ($token != false)
	{
		$token = str_replace("%", "", $token);
		$text = str_replace($token, "<span style=\"background-color: #FFFF00;\">".$token."</span>", $text);
		$token = strtoupper($token);
		$text = str_replace($token, "<span style=\"background-color: #FFFF00;\">".$token."</span>", $text);
		$token = strtolower($token);
		$text = str_replace($token, "<span style=\"background-color: #FFFF00;\">".$token."</span>", $text);
		$token = ucfirst($token);
		$text = str_replace($token, "<span style=\"background-color: #FFFF00;\">".$token."</span>", $text);
		$token = strtok("-$-");

	} 
	echo ($text);
?>