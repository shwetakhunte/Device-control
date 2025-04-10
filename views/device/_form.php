<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Device $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ip_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'hostname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'serial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ping_status')->textInput() ?>

    <?= $form->field($model, 'ping_output')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dc_network')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asn_network')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'asn_asn_route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location_latitude')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'location_longitude')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
