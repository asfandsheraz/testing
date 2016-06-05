<?php
$xmlDoc=new DOMDocument();
$xmlDoc->load("links.xml");

$x=$xmlDoc->getElementsByTagName('link');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
if (strlen($q)>0) {
  $hint="";
  for($i=0; $i<($x->length); $i++) {
    $y=$x->item($i)->getElementsByTagName('title');
    if ($y->item(0)->nodeType==1) {
      //find a link matching the search text
      if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q)) {
        if ($hint=="") {
          $hint= "<ul style='list-style:none;'><li><a onClick=\"mycall('".$y->item(0)->childNodes->item(0)->nodeValue."')\"h>". 
          $y->item(0)->childNodes->item(0)->nodeValue . "</a></li>";
        } else {
          $hint=$hint . "<li><a onClick=\"mycall('".$y->item(0)->childNodes->item(0)->nodeValue."')\">". 
          $y->item(0)->childNodes->item(0)->nodeValue . "</a></li>";
        }
		
      }
    }
  }
  $hint=$hint . "</ul>";
}

// Set output to "no suggestion" if no hint was found
// or to the correct values
if ($hint=="") {
  $response="no suggestion";
} else {
  $response=$hint;
}

//output the response
echo $response;
?>