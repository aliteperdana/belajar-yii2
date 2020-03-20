<?php 
	// use yii;
	use yii\bootstrap\ActiveForm;
	use yii\helpers\Html;
?>

	<?php 
	$form = ActiveForm::begin([
	    'action' => ['komentar'],
	    'options' => [
	        'class' => 'comment-form'
	    ]
	]); 
	?>
	    <?= $form->field($model, 'nama'); ?>
	    <?= $form->field($model, 'pesan'); ?>

	    <?= Html::submitButton("Submit", ['class' => " btn btn-block btn-primary"]); ?>
<?php ActiveForm::end(); ?>


<?php
$this->registerJS('
	 $(document).ready(function($) {
		 $(".comment-form").submit(function(event) {
			 event.preventDefault(); // stopping submitting
			 var data = $(this).serializeArray();
			 var url = $(this).attr(action);
				 $.ajax({
				 url: url,
				 type: "post",
				 data: data
			 })
			 .done(function(response) {
				 if (response.data.success == true) {
					 alert("Wow you commented");
				 }
			 })
			 .fail(function() {
				 console.log("error");
			 });

		 });
	 });
');


// $this->registerJS('

// 	$(document).ready(function($) {
// 		 $(".comment-form").submit(function(event) {
// 			 event.preventDefault(); // stopping submitting
// 			 var data = $(this).serializeArray();
// 			 var url = $(this).attr(action);
// 				 $.ajax({
// 				 url: url,
// 				 type: "post",
// 				 dataType: json,
// 				 data: data
// 			 })
// 			 .done(function(response) {
// 				 if (response.data.success == true) {
// 					 alert("Wow you commented");
// 				 }
// 			 })
// 			 .fail(function() {
// 				 console.log("error");
// 			 });

// 		 });
// 	 });

// ');