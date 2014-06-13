<?php
	include(dirname(__FILE__).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."class.FastTemplate.php");
	include (dirname(__FILE__).DIRECTORY_SEPARATOR."DbConnect.php");
	$db = new Database();
	$tpl = new FastTemplate(dirname(__FILE__).DIRECTORY_SEPARATOR."templates".DIRECTORY_SEPARATOR);
	$tpl->define(array("MainPage" => "searcher3temp1.html", "Table" => "searcher3temp2.html","TH" => "searcher3temp3.html", "TRfile" => "searcher3temp4.html", "TD" => "searcher3temp5.html", "URL" => "searcher3temp6.html"));

		if (isset($_POST["words"])){
			$text = $_POST["words"];

		}
		else {
			echo("Words doesnt exist");
		}
		if (strlen($text)==0)
		{
			echo ("Words doesn't exist");
			return -1;
		}
		$array='';
		$text = strip_tags($text);
		for ($x=0; $x < sizeof($text);$x++)
		{
			$text = str_replace("\"", "", $text);
			$text = str_replace("'s", "", $text);
			$text = preg_replace('/[,.;:{}\"!\?\(\)°]/', ' ', $text);
			$text = preg_replace('/[^a-zà-úÀ-Ú0-9?\s]-?[^a-zà-ú0-9?\s]+/i',' ',$text);						
			$text = str_replace("*", "%", $text);
		}
		$rs='';
		$token = strtok($text, " \n\t");
		$array;	$count=0;
		while ($token != false)
		{
			$token = strtolower($token);
			$array[$count] = $token;
			$count++;
			$token = strtok(" \n\t");

		} 
				if(isset($_POST['fullsearch']) && !isset($_POST['metatagssearch']))
			{
				//just full search
				$type="full";
				$q=doSQL($array,$type);
				$db->connect();
				$rs = $db->send_sql($q);
				iprint($rs,$db,$type,$tpl,$text);
				
			
			}
			else if (!isset($_POST['fullsearch']) && isset($_POST['metatagssearch']))
			{
				//just meta tags search
				$type="meta";
				$q=doSQL($array,$type);
				$db->connect();
				$rs = $db->send_sql($q);
				iprint($rs,$db,$type,$tpl,$text);
			}
			else if (isset($_POST['fullsearch']) && isset($_POST['metatagssearch']))
			{
				//both
				$type="both";
				$q=doSQL($array,$type);
				$db->connect();
				$rs = $db->send_sql($q);
				iprint($rs,$db,$type,$tpl,$text);
			}
			else
			{
				//none of them - I am assuming equals in the full search
				$type="full";
				$q=doSQL($array,$type);
				$db->connect();
				$rs = $db->send_sql($q);
				iprint($rs,$db,$type,$tpl,$text);
			}
		
		function doSQL(&$array,&$type)
		{
			$q="";
			if ($type=="full" || $type=="none")
			{
				$end = " ORDER BY File_word.count DESC";
				$q= "SELECT files.name,files.url,words.word,File_word.count FROM words INNER JOIN File_word ON words.id_word=File_word.id_word INNER JOIN files ON File_word.id_file=files.id_file WHERE words.word LIKE '";
				
				$q .= $array[0]."'";

				for ($a=1; $a<sizeof($array); $a++)
				{
					$q.=" OR words.word LIKE '".$array[$a]."'";
				}
				$q .=$end;
			}
			if ($type=="meta")
			{
				$q = "SELECT files.name,files.url, Meta_info.content, Meta_info.type FROM files INNER JOIN Meta_info ON files.id_file=Meta_info.id_file WHERE Meta_info.content LIKE '";
				
				$q .= $array[0]."'";

				for ($a=1; $a<sizeof($array); $a++)
				{
					$q.=" OR Meta_info.content LIKE '".$array[$a]."'";
				}
			}
			if ($type=="both")
			{

				$q="SELECT files.name,files.url,words.word,File_word.count as bibi FROM words INNER JOIN File_word ON words.id_word=File_word.id_word INNER JOIN files ON File_word.id_file=files.id_file WHERE words.word LIKE '";

				$q .= $array[0]."'";
				for ($a=1; $a<sizeof($array); $a++)
				{
					$q.=" OR words.word LIKE '".$array[$a]."'";
				}
				$q .= " UNION SELECT files.name,files.url, Meta_info.content, Meta_info.type as bibi FROM files INNER JOIN Meta_info ON files.id_file=Meta_info.id_file WHERE Meta_info.content LIKE '";
				$q .= $array[0]."'";

				for ($a=1; $a<sizeof($array); $a++)
				{
					$q.=" OR Meta_info.content LIKE '".$array[$a]."'";
				}

				$q.=" ORDER BY bibi DESC";
				
			}
		
			return $q;

		}
		function iprint(&$rs,&$db,$type,&$tpl,&$text)
		{
			if (!$db->is_result_empty($rs))
			{
				if ($type=="full" || $type=="none")
				{
					$tpl->assign("THCONTENT","Name");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","URL");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","Word");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","Count");	
					$tpl->parse("HEADERS",".TH");
				}
				else if ($type=="meta")
				{
					$tpl->assign("THCONTENT","Name");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","URL");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","Content");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","Type");	
					$tpl->parse("HEADERS",".TH");
				}
				else if ($type=="both")
				{
					$tpl->assign("THCONTENT","Name");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","URL");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","Word/Content");
					$tpl->parse("HEADERS",".TH");
					$tpl->assign("THCONTENT","Count/Type");	
					$tpl->parse("HEADERS",".TH");
				}

				while($row = $db->next_row($rs))
				{
					if ($type=="full" || $type=="none")
					{
						$name = $row[0];
						$url = $row[1];
						$url = "file://".$url;
						$palavras = str_replace(" ", "-$-", $text);
						$url2 = "highliter.php?var1=".$row[1]."&var2=".$palavras;
						$word = $row[2];
						$count = $row[3];

						$tpl->assign("CONTENT",$name);
						$tpl->parse("TRCONTENT",".TD");
						$tpl->assign("LINK",$url2);
						$tpl->assign("NAME",$url);

						$tpl->parse("CONTENT",".URL");
						$tpl->parse("TRCONTENT",".TD");

						$tpl->assign("CONTENT",$word);
						$tpl->parse("TRCONTENT",".TD");
						$tpl->assign("CONTENT",$count);	
						$tpl->parse("TRCONTENT",".TD");
					}
					else if ($type=="meta")
					{
						$name = $row[0];
						$url = $row[1];
						$url = "file://".$url;
						$palavras = str_replace(" ", "-$-", $text);
						$url2 = "highliter.php?var1=".$row[1]."&var2=".$palavras;
						$content = $row[2];
						$type = $row[3];
						$tpl->assign("CONTENT",$name);
						$tpl->parse("TRCONTENT",".TD");

						$tpl->assign("LINK",$url2);
						$tpl->assign("NAME",$url);
						$tpl->parse("CONTENT",".URL");
						$tpl->parse("TRCONTENT",".TD");
						$tpl->assign("CONTENT",$content);
						$tpl->parse("TRCONTENT",".TD");
						$tpl->assign("CONTENT",$type);	
						$tpl->parse("TRCONTENT",".TD");
					}
					else if ($type=="both")
					{
						$name = $row[0];
						$url = $row[1];
						$url = "file://".$url;
						$palavras = str_replace(" ", "-$-", $text);
						$url2 = "highliter.php?var1=".$row[1]."&var2=".$palavras;
						$word = $row[2];
						$count = $row[3];
						$tpl->assign("CONTENT",$name);
						$tpl->parse("TRCONTENT",".TD");
						$tpl->assign("LINK",$url2);
						$tpl->assign("NAME",$url);
						$tpl->parse("CONTENT",".URL");
						$tpl->parse("TRCONTENT",".TD");
						$tpl->assign("CONTENT",$word);
						$tpl->parse("TRCONTENT",".TD");
						$tpl->assign("CONTENT",$count);	
						$tpl->parse("TRCONTENT",".TD");
					}
				$tpl->parse("LIST",".TRfile");
				$tpl->clear("TRCONTENT");
				$tpl->clear("CONTENT");
			}//end of while
			$tpl->parse("RESULT",".Table");
			$tpl->parse("RESULT","MainPage");
			$tpl->FastPrint();
			}
			else
			{
				echo ("The word searched was not found");
			}

			
		}


?>