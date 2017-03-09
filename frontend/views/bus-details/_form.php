<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BusDetails */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bus-details-form col-md-12 col-sm-12 col-xs-12 col-md-offset-3">

    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal']]);?>
    <div class="form-group">
    <div class="col-md-4 col-sm-4 col-xs-12">
    <?= $form->field($model, 'bus_no')->textInput(['style' => 'text-transform: uppercase']) ?>
    </div>
    </div>

    <div class="form-group">
    <div class="col-md-4 col-sm-4 col-xs-12">
    <?= $form->field($model, 'r_no')->textInput() ?>
    </div>
    </div>

    <div class="form-group">
    <div class="col-md-4 col-sm-4 col-xs-12">
    <?= $form->field($model, 'driver_name')->textInput() ?>
    </div>
    </div> 

    <div class="form-group">
    <div class="col-md-4 col-sm-4 col-xs-12">
    <?= $form->field($model, 'route')->textInput() ?>
    </div>
    </div>

     <div class="form-group">
    <div class="col-md-4 col-sm-4 col-xs-12">
    <?= $form->field($model, 'rf_id')->textInput() ?>
    </div>
    </div>
    
    <div class="form-group">
    <div class="col-md-4 col-sm-4 col-xs-12 ">    
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
         <?= Html::resetButton('Reset', ['class' => 'btn btn-danger']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
