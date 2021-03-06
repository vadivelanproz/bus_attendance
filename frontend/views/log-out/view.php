<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LogOut */


$this->params['breadcrumbs'][] = ['label' => 'Log Outs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-out-view">

   

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->log_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->log_id], [
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
            'log_id',
            'rf_id',
            'log_date',
            'dir',
            'timestamp',
        ],
    ]) ?>

</div>
