<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Fetch IP Info';
?>

<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
<?php elseif (Yii::$app->session->hasFlash('error')): ?>
    <div class="alert alert-danger"><?= Yii::$app->session->getFlash('error') ?></div>
<?php endif; ?>

<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'ip_address')->textInput(['placeholder' => 'Enter IP']) ?>
<div class="form-group">
    <?= Html::submitButton('Fetch', ['class' => 'btn btn-primary']) ?>
</div>
<?php ActiveForm::end(); ?>
