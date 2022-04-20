<?php
function string_between_two_string($str, $starting_word, $ending_word)
{
    $subtring_start = strpos($str, $starting_word);
    $subtring_start += strlen($starting_word);  
    $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;  
    return substr($str, $subtring_start, $size);  
}
$url = 'https://time.com';
$html = file_get_contents($url);
$blocks = explode('class="latest-stories__item"', $html);

$key = 'class="latest-stories__item-headline"';

for($i=0; $i<sizeof($blocks); $i++) 
{
	if(strpos($blocks[$i], $key) == false)//Junk
	{
		continue;
	}
	
	//Parsing
	$f_link = $url;
	$h_link = string_between_two_string($blocks[$i], '<a href="', '">');
	$title = string_between_two_string($blocks[$i], 'class="latest-stories__item-headline">', '</h3>');
	$f_link.=$h_link;
	//Creating array
	$news = array("title" => $title, "link" => $f_link);
	header('Content-type:text/javascript');
	//Array to JSON object
	echo json_encode($news,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES),"\n";
}
?>
