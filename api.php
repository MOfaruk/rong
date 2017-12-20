<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include the library
include('simple_html_dom.php');

 
// Retrieve the DOM from a given URL
$html = file_get_html('https://en.wikipedia.org/wiki/Computer_forensics');
//$html = file_get_html('https://en.wikipedia.org/w/index.php?title=Computer_forensics&printable=yes');
/*
//to find h1 headers from a webpage
$headlines = array();
$headlines[] = $html->find('h1',0)->plaintext;

$i=0;
while(1)
{
	$headlines[] = $html->find('p',$i)->plaintext;
	$i++;
	if($html->find('p',$i)->next_sibling()->tag =='div')
		break;
}
print_r($headlines);

echo "<br>____________________________Abstract Done_________________________________<br>";
*/

//to find content from a webpage
$subHead = array();
$subCon = array();
foreach($html->find('h2 span.mw-headline') as $header) {
 $subHead[] = $header->plaintext;
}
print_r(json_encode($subHead));
echo '<br><br>=================Header Done==================<br><br>';

$numHead = sizeof($subHead);

for ($i=0; $i < $numHead; $i++) {
	$tmp = $html->find('h2 span.mw-headline',$i)->parent()->next_sibling();
	while (1) {
	 	$subCon[] = $tmp->plaintext;
	 	$tmp = $tmp->next_sibling();
	 	if ($tmp->next_sibling()->tag == 'h2') {
	 		break;
	 	}
	 } 
	
}

print_r($subCon);
echo '<br><br>.....................content.................................<br>';









echo '<br><br>=+++++++++++++++++++++++++++++++++++<br><br>';
//to find abstract from a webpage
$abs = array();
foreach($html->find('.mw-headline') as $header) {
 $abs[] = $header->plaintext;
}
print_r($abs);

echo '<br><br>===================================<br><br>';


//to find content from a webpage
$con = $html->find('.mw-headline',0)->parent()->next_sibling();
$i=1;
while ($i <= 10) {
	$i++;
	echo $con->tag;
	$con = $con->next_sibling();
}





/*/ Find all "A" tags and print their HREFs
foreach($html->find('a') as $e) 
    echo $e->href . '<br>';

// Retrieve all images and print their SRCs
foreach($html->find('img') as $e)
    echo $e->src . '<br>';

// Find all images, print their text with the "<>" included
foreach($html->find('img') as $e)
    echo $e->outertext . '<br>';

// Find the DIV tag with an id of "myId"
foreach($html->find('div#myId') as $e)
    echo $e->innertext . '<br>';

// Find all SPAN tags that have a class of "myClass"
foreach($html->find('span.myClass') as $e)
    echo $e->outertext . '<br>';

// Find all TD tags with "align=center"
foreach($html->find('td[align=center]') as $e)
    echo $e->innertext . '<br>';
    
// Extract all text from a given cell
echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';
*/
?>