

<?php 

/*
public $url; 
public $dossier;
public $page;
public $condition;
public $token_url;
public $autre;
*/

$_lient = array("url"=>"construction","dossier"=>"page","conditon"=>true,"token"=>"jsbdhjkvkdkzkdvcadlk","autre"=>false);

$encode = base64_encode(json_encode(array("url"=>"construction","dossier"=>"page","conditon"=>true,"token"=>"jsbdhjkvkdkzkdvcadlk","autre"=>false))); 
$decode = json_decode(base64_decode($encode),true); 

echo $encode."<br>";
echo $decode["url"]."<br>";
echo $decode["dossier"]."<br>";
echo $decode["condition"]."<br>";
echo $decode["token"]."<br>";
echo $decode["autre"]."<br>";



?>