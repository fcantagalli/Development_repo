<!DOCTYPE html>

<html lang="en-US">
    <head>
        <title> Folder Index </title>
        <meta charset="utf-8"/>
    </head>
        
    <body>
        <h2 > <?php echo "Path: ".getcwd()."<br>"  ?> </h2>
		
		<?php
			chdir("/Users/felipe/WebServer/www");
			$files = scandir(getcwd());

			usort($files,'compare');

		?>
		<p> List Folders and Files inside the directory </p>
		<ul>
			<?php
				for($i= 0; $i < sizeof($files); $i++){
						
					echo "<li> ","<a href=\"".$files[$i]."\" >".$files[$i]." </a> </li>";
				}	
				?>
		</ul>
    </body>
</html>

<!-- this part of the file contains php functions -->
<?php
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