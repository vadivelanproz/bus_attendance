<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BusDetails */


$this->params['breadcrumbs'][] = ['label' => 'Bus Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->bus_id, 'url' => ['view', 'id' => $model->bus_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="bus-details-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
