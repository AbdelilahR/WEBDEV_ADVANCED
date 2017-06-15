<?php 

$format= "?$"."format=json";

$url="http://r41z.ucc.ovgu.de:8000/sap/opu/odata/sap/YXM_SHOWALL_MOVIE_SRV/ItabMovieSet".$format;
$response = file_get_contents($url);
$json=json_decode($response);

echo "<h2>All Movies</h2>";
foreach($json->d->results as $object)
{
	echo " Name: ".$object->Name." | Category: ". $object->Category . " | Price: €" . $object->Price. " | Description:  " . $object->Description." ";
    echo "<br>";
    echo "<br>";
}


$url="http://r41z.ucc.ovgu.de:8000/sap/opu/odata/sap/YXM_SHOWALL_MOVIE_SRV/ItabCategorySet".$format;
$response = file_get_contents($url);
$json=json_decode($response);


echo "<h2>All Category</h2>";
foreach($json->d->results as $object)
{
    
	echo " ".$object->Category;
    echo "<br>";
}

?>