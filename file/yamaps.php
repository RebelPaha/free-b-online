<?php
$geocode = file_get_contents('http://geocode-maps.yandex.ru/1.x/?geocode='. urlencode('Херсон') .'&key=AHw5xk8BAAAAfGesBQMAybpBVLZALLQrRgEBzbSomGc4QM8AAAAAAAAAAADfVm6NtO8kP3fPbig_F7rsomV_5Q==');
$xml = new SimpleXMLElement($geocode);

$xml->registerXPathNamespace('ymaps', 'http://maps.yandex.ru/ymaps/1.x');
$xml->registerXPathNamespace('gml', 'http://www.opengis.net/gml');

$result = $xml->xpath('/ymaps:ymaps/ymaps:GeoObjectCollection/gml:featureMember/ymaps:GeoObject/gml:Point/gml:pos');
$coord=str_replace(" ",",",$result[0]);
?>
<img src="http://static-maps.yandex.ru/1.x/?ll=<? echo $coord;?>&spn=0.016457,0.00619&l=map&size=300,190&key=AHw5xk8BAAAAfGesBQMAybpBVLZALLQrRgEBzbSomGc4QM8AAAAAAAAAAADfVm6NtO8kP3fPbig_F7rsomV_5Q==">

 