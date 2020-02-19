<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <h3>Halaman ini berisikan informasi mengenai halam website ini.</h3>        

    <code><?= __FILE__ ?></code>
</div>
