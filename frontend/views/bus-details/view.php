<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\BusDetails */


$this->params['breadcrumbs'][] = ['label' => 'Bus Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-details-view">

  

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->bus_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->bus_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [         
            'bus_no',
            'r_no',
            'driver_name',
            'rf_id',
            'route',
        ],
    ]) ?>

</div>
