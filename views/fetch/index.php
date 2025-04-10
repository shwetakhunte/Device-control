<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Fetch IP Info';
?>

<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'ip_address') ?>
<?= Html::submitButton('Fetch', ['class' => 'btn btn-primary']) ?>
<?php ActiveForm::end(); ?>
