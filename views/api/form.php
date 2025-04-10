<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = 'Fetch Device Info';
?>

<h2>Fetch Device Info from API</h2>

<?php $form = ActiveForm::begin([
    'id' => 'fetch-form',
    'action' => Url::to(['api/fetch-data']),
    'method' => 'post',
]); ?>

<?= $form->field(new \yii\base\DynamicModel(['ip_address']), 'ip_address')->textInput(['placeholder' => 'Enter IP']) ?>

<div class="form-group">
    <?= Html::submitButton('Fetch', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>

<div id="result"></div>

<?php
$script = <<<JS
$('#fetch-form').on('beforeSubmit', function(e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        method: 'POST',
        data: $(this).serialize(),
        success: function(res) {
            if (res.status === 'success') {
                $('#result').html('<div class="alert alert-success">'+res.message+'</div>');
            } else {
                $('#result').html('<div class="alert alert-danger">'+res.message+'</div>');
            }
        }
    });
    return false;
});
JS;
$this->registerJs($script);
?>
