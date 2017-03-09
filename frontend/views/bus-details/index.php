<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use fedemotta\datatables\DataTables;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\BusDetailsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bus Details';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bus-details-index">

    <h1><?= Html::encode($this->title) ?></h1>

     <p>
        <?= Html::a('Create Bus Details', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>

   
    <?= DataTables::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       
         
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'bus_id',
            'bus_no',
            'r_no',
            'driver_name',
            'rf_id',
             'route',

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'clientOptions' => [
        "lengthMenu"=> [[20,-1], [20,Yii::t('app',"All")]],
        "info"=>false,
        "responsive"=>true, 
        "dom"=> 'lTrtip',
        "tableTools"=>[
        "aButtons"=> [  
            [
            "sExtends"=> "copy",
            "sButtonText"=> Yii::t('app',"Copy to clipboard")
            ],[
            "sExtends"=> "csv",
            "sButtonText"=> Yii::t('app',"Save to CSV")
            ],[
            "sExtends"=> "xls",
            "oSelectorOpts"=> ["page"=> 'current']
            ],[
            "sExtends"=> "pdf",
            "sButtonText"=> Yii::t('app',"Save to PDF")
            ],
        ]
        ]
        ],

    ]); ?>
</div>
