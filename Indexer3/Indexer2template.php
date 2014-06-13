<?php
	include (dirname(__FILE__).DIRECTORY_SEPARATOR."DbConnect.php");
	$db = new Database();
	
		if (isset($_POST["path"]))
		{
			$path = $_POST["path"];
			// check which one is the separator and change if necessary.
			if(DIRECTORY_SEPARATOR == "\\")
			{
				$path = str_replace('/',DIRECTORY_SEPARATOR, $path);
			}
			else
			{
				$path = str_replace('\\',DIRECTORY_SEPARATOR,$path);
			}
		}
		else 
		{
			echo (" No path defined ");
			return -1;
		}
		if (!file_exists($path))
		{
			echo ("Invalid Path");
			return -1;
		}

		$global = array();
		if (is_dir($path))
		{
			$db->connect();
			verifyfolders($path, $global);	
			for ($a=0; $a< sizeof($global); $a++)
			{
				$aux = $global[$a];
				$ext = pathinfo($aux, PATHINFO_EXTENSION);	
				if ($ext=="html" || $ext == "htm" ) 
					{
						printfile($global[$a],$db);	
					}
			}
		}
		else if (is_file($path))
		{
			$db->connect();
			printfile($path,$db);
		}
		else
		{
			echo (" Path invalid ");
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

		function printfile($path,&$db){

			if (is_file($path))
			{
				$text=file_get_contents($path);
				$array='';
				$tags = get_meta_tags($path);
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
			
				$filename = pathinfo($path,PATHINFO_FILENAME);
				$db->connect();
				$rs = $db->send_sql("SELECT url FROM files WHERE url='".$path."'");
				if ($rs->num_rows!=0) {
					echo ("URL: ".$path." already indexed <br/>");
					return -1;
				}
				else{
					$ifiles = "INSERT INTO files (name,url) VALUES('".$filename."','".$path."')";
					$rs = $db->send_sql($ifiles);
					$id = $db->inserted_id();
					$map = (array_count_values($array));
					ksort($map);
					$keys = array_keys($map);
					for ($y=0; $y<sizeof($keys);$y++)
					{
						if (strlen($keys[$y]) > 1) 
							{
								$rs = $db->send_sql("SELECT word, id_word FROM words WHERE word='".$keys[$y]."'");
								if ($rs->num_rows!=0) {
									echo ("Word: ".$keys[$y]." already indexed <br/>");
									$id_word_row = $db->next_row($rs);
									$idword = $id_word_row[1];
									$rsfileword = $db->send_sql("INSERT INTO File_word(count, id_file, id_word) VALUES(".$map[$keys[$y]].",".$id.",".$idword.")");
								}
								else{
									$rsword = $db->send_sql("INSERT INTO words (word) VALUES('".$keys[$y]."')");
									$idword = $db->inserted_id();
									$rsfileword = $db->send_sql("INSERT INTO File_word(count, id_file, id_word) VALUES(".$map[$keys[$y]].",".$id.",".$idword.")");
								}
								
							}
					}
					$ks = array_keys($tags);
					if (sizeof($ks)>0)
					{
						for ($i=0; $i<sizeof($ks);$i++){
							$rsmeta = $db->send_sql("INSERT INTO Meta_info (content, id_file, type) VALUES('".$tags[$ks[$i]]."',".$id.",'".$ks[$i]."')");
						}
					}
					echo (" File Indexed with Success !!! <br/>");

				}
			}
		}
?>