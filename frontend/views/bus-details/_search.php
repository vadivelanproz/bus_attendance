<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\BusDetailsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => ['class' => 'form-horizontal']
    ]); ?>      

    
    <div class="col-md-3 col-sm-3 col-xs-12">
    <?= $form->field($model, 'bus_no')->textInput(['style' => 'text-transform: uppercase']) ?>
     </div>
    <div></br></div>
     <div class="col-md-3 col-sm-3 col-xs-12">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
</div>

    <?php ActiveForm::end(); ?>

