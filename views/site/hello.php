<?php
use \yii\helpers\Url;
use \yii\helpers\Html;
echo "Halo ".$nama;
echo "<br> Jenis Kelamin ".$jenisKelamin ;
echo Url::home();
echo Url::to();
echo Url::to(['create']);
echo Url::to(['person/create']);
echo Url::to(['person/create','nama'=>'Alit']);

echo "<br>";
echo "<br>";
echo "<br>";



echo Html::a('Example',"http://google.com/",['target'=>'blank']);
echo "<br>";
echo Html::a('Data Person',['person/index'],['target'=>'blank']);
