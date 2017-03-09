
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>   
<?php $form = ActiveForm::begin(['options' => ['class' => 'form-signin']]); ?>               

    <?= $form->field($model, 'username',['labelOptions'=>['class'=>'input_title']])->textInput(['class'=>'form-control','autofocus' => true,'id'=>'inputEmail','placeholder'=>"Username"]) ?>               

    <?= $form->field($model, 'password',['labelOptions'=>['class'=>'input_title']])->passwordInput(['class'=>'form-control','id'=>'inputPassword','placeholder'=>"******"]) ?>              
     
    <?= Html::submitButton('Login', ['class' => 'btn']) ?>
    
<?php ActiveForm::end(); ?>   


    

    
      


