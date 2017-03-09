<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
    

    <?php $form = ActiveForm::begin([
    'options' => ['class' => 'form-horizontal']]);?>
  

    <div class="form-group">
    <div class="col-md-8 col-sm-8 col-xs-12">
    <?= $form->field($model, 'username',['labelOptions'=>['class'=>'control-label col-md-4 col-sm-6 col-xs-12']])->textInput(['class'=>'col-md-4 col-sm-6 col-xs-12']) ?>
    </div>
    </div>

    <div class="form-group">
    <div class="col-md-8 col-sm-8 col-xs-12">
    <?= $form->field($model, 'password_hash',['labelOptions'=>['class'=>'control-label col-md-4 col-sm-6 col-xs-12']])->textInput(['class'=>'col-md-4 col-sm-6 col-xs-12']) ?>
    </div>
    </div> 

    <div class="form-group">
    <div class="col-md-8 col-sm-8 col-xs-12">
    <?= $form->field($model, 'role',['labelOptions'=>['class'=>'control-label col-md-4 col-sm-6 col-xs-12']])->textInput(['class'=>'col-md-4 col-sm-6 col-xs-12']) ?>
    </div>
    </div> 

    <div class="form-group">
    <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">    
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
         <?= Html::resetButton('Reset', ['class' => 'btn btn-danger']) ?>
    </div>
    </div>

  

    <?php ActiveForm::end(); ?>

</div>
