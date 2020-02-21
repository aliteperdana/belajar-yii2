<?php
use yii\helpers\Html;
use \yii\widgets\LinkPager;
?>
<h1>DAFTAR PEGAWAI</h1>
<?php
  if ($_GET['page']==1) {
    $no=1;
  }elseif ($no=$_GET['page']>1) {
    $no=$_GET['page']*10;
  }



  echo Html::a('Daftar',['create'],['class'=>'btn btn-primary']);
  echo "<br><br>";
  echo '<table class="table table-bordered table-striped">';
  echo '<tr>';
  echo '<th>NO</th>';
  echo '<th>ID</th>';
  echo '<th>NAMA</th>';
  echo '<th>UMUR</th>';
  echo '<th>JENIS KELAMIN</th>';
  echo '<th>ACTION</th>';
  echo '</tr>';
  foreach ($employees as $key) {
    echo '<tr>';
    echo '<td>'.$no.'</td>';
    echo '<td>'.$key->id.'</td>';
    echo '<td>'.$key->name.'</td>';
    echo '<td>'.$key->age.'</td>';
    echo '<td>'.$key->gender.'</td>';
    echo '<td>';
    echo  Html::a('<i class="glyphicon glyphicon-pencil"></i>',
        ['employee/update','id'=>$key->id]);
    echo '               ';
    echo  Html::a('<i class="glyphicon glyphicon-trash"></i>',
        ['employee/delete','id'=>$key->id],
        ['onclick'=>'return(confirm(Apakah anda yakin?)?true:false)']);
    echo '</td>';
    echo '</tr>';
    $no++;
  }
  echo '</table>';
  // Menampilkan Penomoran halaman
  echo LinkPager::widget([
    'pagination' => $pages
    ]);
?>
