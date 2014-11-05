<?

	$arr = array (
		"d"=>"Doris",
		"c"=>"Carola",
		"b"=>"Burga",
		"e"=>"Elvira",
		"an"=>"Anna",
		"am"=>"Amanda"
		);
	arsort($arr);
	echo "ARSORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	asort($arr);
	echo "ASORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	krsort($arr);
	echo "KRSORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	ksort($arr);
	echo "KSORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	uasort($arr, 'compare');
	echo "UASORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	uksort($arr, 'compare');
	echo "UKSORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	usort($arr, 'compare');
	echo "USORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	rsort($arr);
	echo "RSORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	sort($arr);
	echo "SORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";
	arsort($arr);
	echo "ARSORT<BR>";
	foreach ($arr as $key=>$elem) {
  		echo "$key=>$elem ";
	}
	echo "<BR><BR>";


	function compare($a, $b) {
		if ($a==$b)
		   return 0;
		elseif ($a < $b)
		   return 1;
		else
		   return -1;
	}


?>
