<?php
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Device Dashboard';
?>

<h1><?= $this->title ?></h1>

<div class="row">
    <div class="col-md-4">
        <div class="alert alert-info">Total Devices: <strong id="totalDevices">0</strong></div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-success">Ping Success: <strong id="pingSuccess">0</strong></div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-danger">Ping Failed: <strong id="pingFailed">0</strong></div>
    </div>
</div>

<?php
$statsUrl = Url::to(['device/device-stats']);
$script = <<< JS
function refreshStats() {
    console.log("Fetching stats from: {$statsUrl}");
    $.getJSON("{$statsUrl}", function(data) {
        console.log("Received stats:", data);
        $('#totalDevices').text(data.total);
        $('#pingSuccess').text(data.ping_success);
        $('#pingFailed').text(data.ping_failed);
    }).fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error fetching stats:", textStatus, errorThrown);
    });
}
setInterval(refreshStats, 3000);
refreshStats();
JS;
$this->registerJs($script);
?>

<?= Html::a('Add New Device', ['create'], ['class' => 'btn btn-success mx-3']) ?>
<?= Html::a('Fetch Device via IP', ['fetch-form'], ['class' => 'btn btn-info']) ?>
