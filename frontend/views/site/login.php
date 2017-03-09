<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

   

    <?php $form = ActiveForm::begin(['id' => 'login-form','options' => ['class' => 'form-horizontal']]); ?>

    <div class="form-group">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <?= $form->field($model, 'username',['labelOptions'=>['class'=>'control-label col-md-4 col-sm-6 col-xs-12']])->textInput(['class'=>'col-md-4 col-sm-6 col-xs-12','autofocus' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-8 col-sm-8 col-xs-12">
            <?= $form->field($model, 'password',['labelOptions'=>['class'=>'control-label col-md-4 col-sm-6 col-xs-12']])->passwordInput(['class'=>'col-md-4 col-sm-6 col-xs-12']) ?>
        </div>
    </div>             

    <div class="form-group">
        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-3">
            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
      
</div>
