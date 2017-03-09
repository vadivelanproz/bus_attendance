<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LogOut */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="log-out-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'rf_id')->textInput() ?>

    <?= $form->field($model, 'log_date')->textInput() ?>

    <?= $form->field($model, 'dir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
