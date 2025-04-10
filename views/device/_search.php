<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\DeviceSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="device-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ip_address') ?>

    <?= $form->field($model, 'hostname') ?>

    <?= $form->field($model, 'serial') ?>

    <?= $form->field($model, 'ping_status') ?>

    <?php // echo $form->field($model, 'ping_output') ?>

    <?php // echo $form->field($model, 'dc_network') ?>

    <?php // echo $form->field($model, 'asn_network') ?>

    <?php // echo $form->field($model, 'asn_asn_route') ?>

    <?php // echo $form->field($model, 'location_latitude') ?>

    <?php // echo $form->field($model, 'location_longitude') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
