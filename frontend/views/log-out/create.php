<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LogOut */

$this->title = 'Create Log Out';
$this->params['breadcrumbs'][] = ['label' => 'Log Outs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-out-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
