<?php 
if(isset($_GET['city_id']))
{
	$city_id=$_GET['city_id'];
	
}
$app_id=md5('kaan');
$url = "http://volkansengul.com/havadurumu/detay.php?city_id=$city_id&app_id=$app_id";
$veri =  file_get_contents($url);
$hava = json_decode($veri);
echo "<h1>".$hava->city->name." 5 Günlük Hava Durumu</h1>";

$tarih=$hava->list[0]->dt_txt;
echo 'Tarih | Hava Durumu | Sıcaklık | Rüzgar Hızı <br/>';
foreach ($hava->list as $gunluk) {
	$tarih=$gunluk->dt_txt;
	$expTarih=explode(" ",$tarih);
	$tarih=$expTarih[0];
	$tarih=explode("-",$tarih);
	$saat=$expTarih[1];
	$saat=explode(":", $saat);

	$ruzgarHiz=$gunluk->wind->speed;
	$havadurumu=$gunluk->weather[0]->main;

	$ortSıcak=($gunluk->main->temp_min+$hava->list[0]->main->temp_max)/2;
	$ortSıcak=(int) ($ortSıcak - 273);

	if($havadurumu=="Clear")
  	{
    	$havadurumu="Açık";
  	}
  	if($havadurumu=="Clouds")
  	{
   	 $havadurumu="Bulutlu";
  	}
  	if($havadurumu=="Sunny")
  	{
    	$havadurumu="Güneşli";
  	}
  	if($havadurumu=="Rain")
  	{
    	$havadurumu="Yağmurlu";
  	}
   	if($havadurumu=="Snowy")
  	{
    	$havadurumu="Karlı";
  	}
  	if($havadurumu=="Windy")
  	{
    	$havadurumu="Rüzgarlı";
  	}
	echo $tarih[2].".".$tarih[1].".".$tarih[0]." ".$saat[0].".".$saat[1]." - ".$havadurumu." - ".$ortSıcak." - ".$ruzgarHiz."<br/>";
}
?>