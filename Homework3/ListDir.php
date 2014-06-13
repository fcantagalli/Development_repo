<?php 
	if( isset($_GET["path"]) ){
		chdir($_GET["path"]);
	}	
	include(dirname(__FILE__).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."class.FastTemplate.php");

	$tpl = new FastTemplate(dirname(__FILE__).DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR);

	$tpl->define(array(
		"body" => "body.html",
		"li" => "li.html",
		"li2"=>"li2.html"
		));

	$tpl->assign("PATH",getcwd());
	// fazer o h2 aqui

	$files = scandir(getcwd());
	usort($files,'compare');

	//$tpl->parse("PATH","body");

	for($i= 0; $i < sizeof($files); $i++){
		if(is_dir($files[$i])){
			if($files[$i] != "."){
				if($files[$i] == ".."){
					//echo "<li> ","<a href=\"ListDir.php?path=".dirname(getcwd())."\""."> ".$files[$i]." </a> </li>";
					$tpl->assign("PATHLINK","\"ListDir.php?path=".dirname(getcwd())."\"");
					$tpl->assign("VALUE", $files[$i]);
					$tpl->parse("ROWS",".li");
				}
				else{
					//echo "<li> ","<a href=\"ListDir.php?path=".getcwd()."/".$files[$i]."\""."> ".$files[$i]." </a> </li>";
					$tpl->assign("PATHLINK","\"ListDir.php?path=".getcwd()."/".$files[$i]."\"");
					$tpl->assign("VALUE", $files[$i]);
					$tpl->parse("ROWS",".li");
				}
			}
		}
		else{
			//echo "<li>".$files[$i]."</li>";
			$tpl->assign("VALUE2", $files[$i]);
			$tpl->parse("ROWS",".li2");
		}
		
	}
	$tpl->parse("ROWS","body");
	$tpl->FastPrint();	

//<!-- this part of the file contains php functions -->
	function compare($a, $b) {
		if(is_file($a)){ // $a is a file
			if(is_file($b)){ // $b is a file too
				return strcasecmp($a, $b); // order by name
			}
			else{ // $b is a directory
				return 1;
			}
		}
		else{ // $a is a directory
			if(is_dir($b)){  // $b is a directory
				return strcasecmp($a, $b);
			}
			else{ // $b is a file
				return -1;
			}
		}
		   
	}
?>