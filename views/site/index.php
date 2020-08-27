<?php

/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\models\Source;
use yii\helpers\Url;
use kartik\datetime\DateTimePicker;
$this->title = 'Загрузка ссылок';
?>
<div class="site-index">
    <div class="body-content">
        <div class="index">
            <?php $form = ActiveForm::begin([
                'id' => 'call_data',
                'action' => ['/'],
            ]); ?>

            <?= $form->field($model, 'url')->textInput() ?>
            <?= $form->field($model, 'datetime_life')->widget(DateTimePicker::className(), [
                'name' => 'datetime_life',
                'options' => ['placeholder' => 'Select operating time ...'],
                'convertFormat' => true,
                'pluginOptions' => [
                    'format' => 'dd.MM.yyyy H:i'
                ]
            ]) ?>
            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="table">
        <table class="table">
            <thead>
            <th>Counter</th>
            <th>Короткий url</th>
            <th>Url</th>
            </thead>
            <tbody>
                <?php if(!empty($tableObjects)){ ?>

                    <?php
                    /**
                     * @var Source $sourceModel
                     */
                    foreach ($tableObjects as $sourceModel){ ?>
                        <tr>
                            <td><?= $sourceModel->counter ?></td>
                            <td><?= Url::home(true) . 'file/' .  $sourceModel->token_url ?></td>
                            <td><?= $sourceModel->url ?></td>
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
        </div>

    </div>
</div>
