<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\BusDetails */

$this->title = 'Create Bus Details';
$this->params['breadcrumbs'][] = ['label' => 'Bus Details', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-details-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
