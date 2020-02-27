<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$username_created_by=$model->created_by;
if ($user=User::findIdentity($model->created_by)) {
  $username_created_by=$user->username;
}
$username_updated_by=$model->updated_by;
if ($user=User::findIdentity($model->updated_by)) {
  $username_updated_by=$user->username;
}
?>
<div class="category-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'created_at',
            'updated_at',
            [
            'attribute'=>'created_by',
            'value'=>$username_created_by
            ],
            [
              'attribute'=>'updated_by',
              'value'=>$username_updated_by
            ],


        ],
    ]) ?>

</div>
