<?php
use yii\helpers\Html;
?>
<h1>DAFTAR PEGAWAI</h1>
<?php
  echo '<table class="table table-bordered table-striped">';
  echo '<tr>';
  echo '<th>ID</th>';
  echo '<th>NAMA</th>';
  echo '<th>UMUR</th>';
  echo '<th>JENIS KELAMIN</th>';
  echo '<th>ACTION</th>';
  echo '</tr>';
  foreach ($employees as $key) {
    echo '<tr>';
    echo '<td>'.$key->id.'</td>';
    echo '<td>'.$key->name.'</td>';
    echo '<td>'.$key->age.'</td>';
    echo '<td>'.$key->gender.'</td>';
    echo '<td>';
    echo  Html::a('<i class="glyphicon glyphicon-pencil"></i>',
        ['employee/update','id'=>$key->id]);
    echo '</td>';
    echo '</tr>';
  }
  echo '</table>';
?>
