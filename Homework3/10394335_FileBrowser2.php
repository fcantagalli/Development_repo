<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8"/>
		<title>Script Homework A</title>
	</head>
	<body>
		<h1>
			<?php
				$var1="";
				if (isset($_GET["var1"])){
					$var1=$_GET["var1"];
					chdir($var1);					
				}
				$path_folder = getCwd();
				echo ("Path: ".$path_folder."<br/>");
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
									if (is_file($files[$x])) 
										{
											//echo ("<li>File: <a href=\"10394335_FileBrowser2.php?var1=$path_folder/".$files[$x]."\"> ".$files[$x]." </a></li>");
											echo ("<li>File: ".$files[$x]."</li>");	
										}
									else
									{
										if ($files[$x] != ".")
										{
											if ($files[$x] == "..")
											{
												echo ("<li>Folder: <a href=\"10394335_FileBrowser2.php?var1=".dirname(getcwd())."\"> ".$files[$x]." </a></li>");
												//echo ("<li>Folder: <a href=\"10394335_FileBrowser2.php?var1=dirname(getcwd())/".$files[$x]."\"> ".$files[$x]." </a></li>");
											}
											else
											{
												echo ("<li>Folder: <a href=\"10394335_FileBrowser2.php?var1=$path_folder/".$files[$x]."\"> ".$files[$x]." </a></li>");
											}
										}
										
									}
								}
						?>
				</ul>

	</body>
</html>

