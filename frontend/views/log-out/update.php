<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LogOut */

$this->title = 'Update Log Out: ' . $model->log_id;
$this->params['breadcrumbs'][] = ['label' => 'Log Outs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->log_id, 'url' => ['view', 'id' => $model->log_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="log-out-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
