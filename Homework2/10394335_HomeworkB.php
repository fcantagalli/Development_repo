
<!DOCTYPE html>
<html lang="en=US">
	<head>
		<meta charset="utf-8" />
		<title>Script Homework B</title>
	</head>	
	<body>
		<h1>Homework B</h1>
		<?php
			$path = "Homework_3_test_page.html";
			$mode = "r";
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
					$text = preg_replace('/(([^a-z0-9]|&[aeiou]acute;)-?([^a-z0-9]|&[aeiou]acute;))+/i',' ',$text);
					
				}
				$token = strtok($text, " \n\t");
				$array;	$count=0;
				while ($token != false)
				{
					$token = strtolower($token);
					$array[$count] = $token;
					$count++;
					$token = strtok(" \n\t");

				} 
				echo("<h2>Words:</h2>");
			}
		?>
	
			<ul type=disc>
				<?php
				$map = (array_count_values($array));
				ksort($map);
				$keys = array_keys($map);
				for ($y=0; $y<sizeof($keys);$y++)
					{
						echo ("<li>".$keys[$y]." = ".$map[$keys[$y]]."</li>");
					}
				?>

			</ul>
			<?php
				echo ("<h2>Meta Data: </h2>");
				$ks = array_keys($tags);
				for ($i=0; $i<sizeof($ks);$i++){
					echo ($ks[$i]." = ".$tags[$ks[$i]]."<br/>");
				}
			?>
	</body>
</html>