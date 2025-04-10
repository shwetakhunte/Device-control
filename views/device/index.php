<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\DeviceSearch $searchModel */
/** @var app\models\Device[] $devices */

$this->title = 'Devices';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="device-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?= Html::a('Create Device', ['create'], ['class' => 'btn btn-success']) ?></p>

    <!-- Search Form -->
    <div class="device-search-form mb-4">
        <?php Pjax::begin(); ?>
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => Url::to(['device/index']),
            'options' => ['data-pjax' => true],
        ]); ?>

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($searchModel, 'ip_address')->textInput(['placeholder' => 'Search IP'])->label(false) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($searchModel, 'hostname')->textInput(['placeholder' => 'Search Hostname'])->label(false) ?>
            </div>
            <div class="col-md-4">
                <div class="form-group mt-1">
                    <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Reset', ['index'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
        <?php Pjax::end(); ?>
    </div>

    <!-- Device Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>IP Address</th>
                <th>Hostname</th>
                <th>Ping Status</th>
                <th>Latitude</th>
                <th>Longitude</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($devices as $device): ?>
                <tr>
                    <td><?= Html::encode($device->id) ?></td>
                    <td><?= Html::encode($device->ip_address) ?></td>
                    <td><?= Html::encode($device->hostname ?: '(not set)') ?></td>
                    <td>
                        <?php
                        if ($device->ping_status === null) {
                            echo 'Not Pinged';
                        } else {
                            echo $device->ping_status ? 'Success' : 'Failed';
                        }
                        ?>
                    </td>
                    <td><?= Html::encode($device->location_latitude) ?></td>
                    <td><?= Html::encode($device->location_longitude) ?></td>
                    <td>
                        <?= Html::a('View', ['view', 'id' => $device->id], ['class' => 'btn btn-sm btn-info']) ?>
                        <?= Html::a('Update', ['update', 'id' => $device->id], ['class' => 'btn btn-sm btn-primary']) ?>
                        <?= Html::a('Delete', ['delete', 'id' => $device->id], [
                            'class' => 'btn btn-sm btn-danger',
                            'data' => ['confirm' => 'Are you sure?', 'method' => 'post'],
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
