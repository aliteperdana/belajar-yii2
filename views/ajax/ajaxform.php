<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin([
	'options'=>[
		'id' => 'formX',
	],
	'action'=>['create'],
	'method'=>'post',
]);
?>

<?= $form->field($model, 'title')->textInput() ?>
<?= $form->field($model, 'price')->textInput() ?>
<div class="form-group">
	<?= Html::submitButton('Add To List', ['class' => 'btn btn-primary'])  ?>
</div>

<?php ActiveForm::end(); ?>