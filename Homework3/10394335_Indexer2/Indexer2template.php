<?php
	include(dirname(__FILE__).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."class.FastTemplate.php");
	$tpl = new FastTemplate(dirname(__FILE__)."/templatesindexer/");
	$tpl->define(array("MainPage" => "Indexer2temp1.html", "List" => "Indexer2temp2.html","List2" => "Indexer2temp3.html", "Meta" => "Indexer2temp4.html"));

		if (isset($_POST["path"])){
			$path = $_POST["path"];
			// check which one is the separator and change if necessary.
			if(DIRECTORY_SEPARATOR == "\\"){
				$path = str_replace('/',DIRECTORY_SEPARATOR, $path);
			}
			else{
				$path = str_replace('\\',DIRECTORY_SEPARATOR,$path);
			}
				$tpl->assign("PATHNOTDEFINED","");
			}
		else {
			$tpl->assign("PATHNOTDEFINED","File Path not defined or defined wrong !!");
		}
		$global = array();
		if (is_dir($path))
		{
			verifyfolders($path, $global);	
			for ($a=0; $a< sizeof($global); $a++){
				$aux = $global[$a];
				$ext = pathinfo($aux, PATHINFO_EXTENSION);
				
				if ($ext=="html" || $ext == "htm" ) printfile($global[$a],$tpl);	
			}
		}
		else 
			{
				printfile($path,$tpl);
			}
		function verifyfolders($path, &$global){

			 $cont=0;

			for ($a=0; $a<sizeof($global); $a++)
			{
				if ($global[$a] == $path) $cont = $cont+1;
			}
			if ($cont ==0) 
				{
					array_push($global, $path);
				}
				else 
					{
						echo (" Path already verified ");
					}
			if (!is_file($path)) 
				{
					$files = scandir($path);
				
					for ($a=0; $a<sizeof($files); $a++)
					{
						if (is_file($path.DIRECTORY_SEPARATOR.$files[$a])) 
							{
								$temp = $path.DIRECTORY_SEPARATOR.$files[$a];
								array_push($global, $temp);
							}
						else if (is_dir($path.DIRECTORY_SEPARATOR.$files[$a])) 
						{
							if ($files[$a] != "." && $files[$a] != "..")
							{
								verifyfolders($path.DIRECTORY_SEPARATOR.$files[$a],$global);
							}
							
						}
						else{
							echo (" Is not a folder, neither a file");
						}
					}
				}
				return $global;
		}
		function printfile($path, &$tpl){
			$tpl->clear("LIST");
			$tpl->clear("META");
			$tpl->clear("KEYS");
			$tpl->clear("MAPVALUES");
			$tpl->clear("METAKEYS");
			$tpl->clear("METAVALUES");
			$tpl->clear("PATH");
			
			if (is_file($path))
			{
				$mode = "r"; $array='';
				if ($opened = fopen($path,$mode)){
					$size = filesize($path);
					$text="";
					$tags = get_meta_tags($path);
					while ($string = fgets($opened,$size)){
						$text.=$string;

					}
					fclose($opened);
					$text = strip_tags($text);
					for ($x=0; $x < sizeof($text);$x++)
					{
						$text = str_replace("\"", "", $text);
						$text = str_replace("'s", "", $text);
						$text = preg_replace('/[,.;:{}\"!\?\(\)°]/', ' ', $text);
						$text = preg_replace('/[^a-zà-úÀ-Ú0-9?\s]-?[^a-zà-ú0-9?\s]+/i',' ',$text);						
					}
					$token = strtok($text, " \n\t");
					$count=0;
					while ($token != false)
					{
						$token = strtolower($token);
						$array[$count] = $token;
						$count++;
						$token = strtok(" \n\t");
					} 
				}

				$tpl->assign("PATH",$path);
				$map = (array_count_values($array));
				ksort($map);
				$keys = array_keys($map);
				for ($y=0; $y<sizeof($keys);$y++)
				{
					if (strlen($keys[$y]) > 1) 
						{
							$tpl->assign("KEYS",$keys[$y]);
							$tpl->assign("MAPVALUES",$map[$keys[$y]]);
							$tpl->parse("LIST",".List2");
						}
				}
				$ks = array_keys($tags);
				if (sizeof($ks)==0)
				{
					$tpl->assign("META","");
				}
				else{
					for ($i=0; $i<sizeof($ks);$i++){
						$tpl->assign("METAKEYS",$ks[$i]);
						$tpl->assign("METAVALUES",$tags[$ks[$i]]);
						$tpl->parse("META",".Meta");
					}
				}
			}
			$tpl->parse("RESULT",".List");
		}
		$tpl->parse("RESULT","MainPage");
		$tpl->FastPrint();			
?>