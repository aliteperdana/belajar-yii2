<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Book */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-form">

	<?php// $form = ActiveForm::begin(); ?>

	<?php $form = ActiveForm::begin([
		'options' => [
			'id' => 'formX',
		],
		'action' => ['create'],
		'method' => 'post',
	]); ?>


	<?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
	<?= $form->field($model, 'price')->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
  
<?php
$this->registerJs('
	$(document).on("beforeSubmit","#formX",function(event)     {
		var form = $(this);
		if (form.find(".has-error").length) {
			return false;
		}
		$.ajax({
			url: form.attr("action"),
			type: form.attr("method"),
			data: form.serialize(),
			success: function (response) {
                // kode jika sukses
                document.getElementById("formX").reset();
                alert("Berhasil");

			}
			});
			return false;
			});
');
