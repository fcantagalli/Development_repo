<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8"/>
		<title>Script Homework A</title>
	</head>
	<body>
		<h1>
			<?php
				chdir('/Users/felipe/WebServer/www/');
				$path_folder = getCwd();
				echo ("Path: $path_folder<br/>");
			?>
		</h1>
			<?php
				$files = scandir(getCwd());
				echo("<br/>");
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
			?>
			<h2>List with the Folder's Content</h2>	
				<ul type=circle> 
						<?php
							for ( $x=0; $x<sizeof($files); $x++)
								{
									if (is_file($files[$x])) echo ("<li>File: <a href=\"".$files[$x]."\"> ".$files[$x]." </a></li>");
									else
									{
										echo ("<li>Folder: <a href=\"".$files[$x]."\"> ".$files[$x]." </a></li>");
									}
								}
						?>
				</ul>	
	</body>
</html>

