<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Device $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Devices', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<?= DetailView::widget([
    'model' => $model,
    'attributes' => [
        'id',
        'ip_address',
        'rir',
        'company_network',
        'ping_status' => [
            'attribute' => 'ping_status',
            'value' => function($model) {
                if ($model->ping_status === null) return 'Not Pinged';
                return $model->ping_status ? 'Success' : 'Failed';
            }
        ],
        'ping_output' => [
            'attribute' => 'ping_output',
            'format' => 'raw',
            'value' => function($model) {
                return "<pre>" . Html::encode($model->ping_output) . "</pre>";
            }
        ],
        'dc_network',
        'asn_network',
        'asn_asn_route',
        'location_latitude',
        'location_longitude',
    ],
]) ?>


