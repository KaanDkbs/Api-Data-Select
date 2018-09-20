<?php
if(isset($_GET['sehir']))
 {$sehir=$_GET['sehir'];}
else
{
  $sehir='istanbul';
}
  $app_id=md5('kaan');
  $url = "http://volkansengul.com/havadurumu/?city=$sehir&app_id=$app_id"; // web Site URL
  $veri =  file_get_contents($url);
  $hava = json_decode($veri);

  $havadurumu=$hava->weather[0]->main;
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
  $city_id=$hava->id;
  echo '<h1>Hava Durumu</h1>';
  echo "<a href=?sehir=ankara>Ankara</a> <a href=?sehir=istanbul>İstanbul</a> <a href=?sehir=canakkale>Çanakkale</a> <a href=?sehir=bursa>Bursa</a> <a href=?sehir=tokat>Tokat</a> </br>";
  $hiz=$hava->wind->speed;
  $ortSıcak= (($hava->main->temp_min+$hava->main->temp_max)/2)-273;
  $sehir=$hava->name;
  echo "ortalama sıcaklık : ".$ortSıcak."<br/>Hava durumu : ".$havadurumu."<br/>Rüzgar Hızı : ".$hiz."<br/>Şehir : ".$sehir." (5 günlük hava durum için <a href=detay.php?city_id=$city_id>tıklayın</a>)";
  
?>  