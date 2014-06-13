<?php
	include(dirname(__FILE__).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."class.FastTemplate.php");
	$tpl = new FastTemplate(dirname(__FILE__).DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR);
	$tpl->define(array("MainPage" => "FileBrowser2temp1.html", "List" => "FileBrowser2temp2.html","List2" => "FileBrowser2temp3.html"));

	
	$var1="";
	if (isset($_GET["var1"])){
		$var1=$_GET["var1"];
		if (is_dir($var1)) {
			chdir($var1);
		}
		else{
			echo ("Wrong Folder Path");
			return -1;	
		}					
	}
		$path_folder = getCwd();
		$tpl->assign("PATHVALUE",$path_folder);
		
	$files = scandir(getCwd());
	function compare($a,$b){
		if ( (is_dir($a) && is_dir ($b)) || (is_file($a) && is_file($b)))
		{
			return strcasecmp($a, $b);
		} 
		else
		{
			if (is_dir($a) && is_file($b)) return -1;
			else return 1;							
		}
					
	}
	usort($files,"compare");
    for ( $x=0; $x<sizeof($files); $x++)
	{
		if (is_file($files[$x])) 
		{
			$tpl->assign("VALUE2",$files[$x]);
			$tpl->parse("LIST",".List2");
		}
		else
		{
			if ($files[$x] != ".")
			{
				if ($files[$x] == "..")
				{
					$tpl->assign("FILE", "\"FileBrowser2template.php?var1=".dirname(getcwd())."\"");
					$tpl->assign("VALUE",$files[$x]);
					$tpl->parse("LIST",".List");
					
				}
				else
				{
					$tpl->assign("FILE", "\"FileBrowser2template.php?var1=$path_folder/".$files[$x]."\"");
					$tpl->assign("VALUE",$files[$x]);
					$tpl->parse("LIST",".List");
				}
			}

		}	
	}
	$tpl->parse("LIST","MainPage");
	$tpl->FastPrint();
?>
