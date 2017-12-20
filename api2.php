<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

// Include the library
include('simple_html_dom.php');

$url = 'https://en.wikipedia.org/wiki/';

$errors = array();
$error = 0;

if (isset($_GET['search'])) {
	$url .= $_GET['search'];
}
else{
	$error = 1;
	$error[] = "Get No input parameter";
	print_r($errors);
	exit();
}

// Retrieve the DOM from a given URL
$html = file_get_html('https://en.wikipedia.org/wiki/india');

$result = array();

//to find title and abstract from a webpage
$headline = $html->find('h1')->plaintext;
$abstract = ''; 

$i=0;
while(1)
{
	$abstract .= $html->find('p',$i)->plaintext;
	$i++;
	if($html->find('p',$i)->next_sibling()->tag =='div')
		break;
}

$result[] = ['title'=>$headline,'p'=>$abstract];
// print_r($headlines);

// echo "<br>____________________________Abstract Done_________________________________<br>";


//to find content from a webpage
$subHead = array();

foreach($html->find('h2 span.mw-headline') as $header) {
 $subHead[] = $header->plaintext;
}
// print_r($subHead);
// echo '<br><br>=================Header Done==================<br><br>';

$numHead = sizeof($subHead);

for ($i=0; $i < $numHead; $i++) {
	$tmp = $html->find('h2 span.mw-headline',$i)->parent()->next_sibling();
	$txt = $tmp->plaintext;

	if ($html->find('h2 span.mw-headline',$i)->parent()->next_sibling()->next_sibling()->tag == 'p') {
		$txt .= $html->find('h2 span.mw-headline',$i)->parent()->next_sibling()->next_sibling()->plaintext;
		if ($html->find('h2 span.mw-headline',$i)->parent()->next_sibling()->next_sibling()->next_sibling()->tag == 'p') {
			$txt .= $html->find('h2 span.mw-headline',$i)->parent()->next_sibling()->next_sibling()->next_sibling()->plaintext;
		}
	}
	$result[] = ["title"=>$subHead[$i],"p"=>$txt];
	
}

print_r($result);
?>