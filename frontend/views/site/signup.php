<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>
    <div class="site-signup col-md-12 col-sm-12 col-xs-12 col-md-offset-3">
  
    <?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal ']]); ?>                
    <div class="form-group">
        <div class="col-md-4 col-sm-4 col-xs-12">
        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'password')->passwordInput() ?>
         </div>
    </div>
    <div class="form-group">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <?= $form->field($model, 'retype_password')->passwordInput() ?>
        </div>
    </div>   

    
    <div class="form-group">
        <div class="col-md-4 col-sm-4 col-xs-12">
           <?= $form->field($model, 'role',['labelOptions'=>['class'=>'control-label col-md-4 col-sm-6 col-xs-12']])->radioList(array('User'=>'User','Admin'=>'Admin'),['class'=>'control-label col-md-1 col-sm-6 col-xs-12']); ?>  </div>
          
        </div>

    <div class="form-group">
        <div class="col-md-4 col-sm-8 col-xs-12 ">
            <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-danger']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
      
</div>
